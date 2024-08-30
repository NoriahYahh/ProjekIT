<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Activity;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::all();
        return view('activities.index', compact('activities'));
    }

    public function create()
    {
        return view('activities.create');
    }

    public function store(Request $request)
{
    $activityDate = $request->activity_date . '-01'; // Menyimpan tanggal sebagai YYYY-MM-01

    // Validasi duplikasi nama kegiatan pada tanggal yang sama
    $existingName = Activity::where('name', $request->name)
        ->where('activity_date', $activityDate)
        ->exists();

    // Validasi duplikasi waktu kegiatan pada nama yang berbeda
    $existingDate = Activity::where('activity_date', $activityDate)
        ->where('name', '!=', $request->name)
        ->exists();

    // Validasi nama kegiatan yang sudah ada untuk waktu yang berbeda
    $existingNameDifferentDate = Activity::where('name', $request->name)
        ->where('activity_date', '!=', $activityDate)
        ->exists();

    if ($existingName && $existingDate) {
        return redirect()->back()->withErrors([
            'name' => 'Nama kegiatan sudah ada untuk waktu yang sama.',
            'activity_date' => 'Waktu kegiatan sudah ada untuk nama yang berbeda.',
        ])->withInput();
    }

    if ($existingName) {
        return redirect()->back()->withErrors([
            'name' => 'Nama kegiatan sudah ada untuk waktu yang sama.',
        ])->withInput();
    }

    if ($existingDate) {
        return redirect()->back()->withErrors([
            'activity_date' => 'Waktu kegiatan sudah ada untuk nama yang berbeda.',
        ])->withInput();
    }

    if ($existingNameDifferentDate) {
        return redirect()->back()->withErrors([
            'name' => 'Nama kegiatan sudah ada untuk waktu yang berbeda.',
        ])->withInput();
    }

    // Jika tidak ada duplikasi, buat kegiatan baru
    $activity = Activity::create([
        'name' => $request->name,
        'activity_date' => $activityDate, // Menyimpan tanggal sebagai YYYY-MM-01
    ]);

    return redirect()->route('activities.show', $activity->id);
}








public function show($id)
{
    $activity = Activity::findOrFail($id);

    // Menangani pencarian
    $query = $activity->shipments();

    // Ambil nilai pencarian dari request
    $search = request('search');

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('mv', 'like', "%$search%")
                ->orWhere('bg', 'like', "%$search%")
                ->orWhere('sv', 'like', "%$search%");
        });
    }

    $shipments = $query->get();

    // Jika pencarian tidak menemukan hasil, tambahkan alert ke session
    if ($search && $shipments->isEmpty()) {
        return redirect()->route('activities.show', $id)
            ->with('alert', "Tidak ditemukan hasil pencarian untuk kata kunci '$search'.");
    }
    $roas = $activity->roas; 
    $coas = $activity->coas; 
    $ashanls = $activity->ashanls; 

    return view('activities.show', compact('activity', 'shipments', 'roas', 'coas', 'ashanls'));
}




    // ActivityController.php
    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();

        return redirect()->route('activities.index')->with('success', 'Kegiatan berhasil dihapus.');
    }
}
