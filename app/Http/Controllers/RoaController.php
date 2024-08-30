<?php

namespace App\Http\Controllers;

use App\Models\ROA;
use App\Models\Activity;
use Illuminate\Http\Request;

class RoaController extends Controller
{
    public function index()
    {
        // Memuat ROA beserta aktivitas yang terkait
        $roas = ROA::with('activity')->get();
        return view('roa.index', compact('roas'));
    }

    public function show($id)
    {
        // Memuat ROA dan aktivitas terkait dengan ID
        $roa = ROA::with('activity')->findOrFail($id);
        return view('roa.show', compact('roa'));
    }

    public function create(Activity $activity)
    {
        $id = session('id'); // Atau ambil ID dari sumber lain
        // Menampilkan form untuk membuat ROA baru
        return view('roa.create', compact('activity', 'id'));
    }

    public function store(Request $request, Activity $activity)
    {
        $validatedData = $request->validate([
            'tm' => 'required|string|max:255',
            'im' => 'required|string|max:255',
            'ash' => 'required|string|max:255',
            'ash2' => 'nullable|string|max:255',
            'vm' => 'required|string|max:255',
            'fc' => 'nullable|string|max:255',
            'ts' => 'required|string|max:255',
            'Adb' => 'required|string|max:255',
            'Arb' => 'nullable|string|max:255',
            'Daf' => 'nullable|string|max:255',
            'Analisis_Standar' => 'required|string|max:255',
        ]);
    
        $roas = $activity->roas()->create($validatedData);


        return redirect()->route('activities.show', $activity->id)->with('success', 'Data berhasil ditambahkan.');
    }
    

    public function edit(ROA $roa)
    {
        // Mendapatkan aktivitas terkait dari ROA untuk form edit
        $activity = $roa->activity;
        return view('roa.edit', compact('roa', 'activity'));
    }

    public function update(Request $request, ROA $roa)
    {
        // Validasi input dari form edit
        $request->validate([
            'tm' => 'required|string',
            'im' => 'required|numeric',
            'ash' => 'required|numeric',
            'ash2' => 'nullable|numeric',
            'vm' => 'nullable|numeric',
            'fc' => 'nullable|numeric',
            'ts' => 'required|string',
            'Adb' => 'required|numeric',
            'Arb' => 'nullable|numeric',
            'Daf' => 'nullable|numeric',
            'Analisis_Standar' => 'required|string',
        ]);

        // Perbarui data ROA
        $roa->update([
            'tm' => $request->tm,
            'im' => $request->im,
            'ash' => $request->ash,
            'ash2' => $request->ash2,
            'vm' => $request->vm,
            'fc' => $request->fc,
            'ts' => $request->ts,
            'Adb' => $request->Adb,
            'Arb' => $request->Arb,
            'Daf' => $request->Daf,
            'Analisis_Standar' => $request->Analisis_Standar,
        ]);

        return redirect()->route('activities.show', $roa->activity_id)
                         ->with('success', 'Report of Analysis berhasil diperbarui.');
    }

    public function destroy(ROA $roa)
    {
        // Hapus ROA
        $roa->delete();

        return redirect()->route('activities.show', $roa->activity_id)
                         ->with('success', 'Report of Analysis berhasil dihapus.');
    }
}
