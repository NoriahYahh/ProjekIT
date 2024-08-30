<?php

namespace App\Http\Controllers;

use App\Models\Coa;
use Illuminate\Http\Request;
use App\Models\Activity;

class CoaController extends Controller
{
    public function index()
    {
        $coas = Coa::with('activity')->get();
        return view('coas.index', compact('coas'));
    }

    public function create(Activity $activity)
    {
        $activities = Activity::all();
        $id = session('id'); // Atau ambil ID dari sumber lain
        return view('coas.create', compact('activity', 'id'));
    }

    public function store(Request $request, Activity $activity)
    {
        $validatedData = $request->validate([
            'number' => 'required|string|max:255',
            'tm2' => 'required|string|max:255',
            'im2' => 'required|string|max:255',
            'ash1' => 'required|string|max:255',
            'ash3' => 'required|string|max:255',
            'vm2' => 'required|string|max:255',
            'fc2' => 'required|string|max:255',
            'ts3' => 'required|string|max:255',
            'ts2' => 'required|string|max:255',
            'adb' => 'required|string|max:255',
            'arb' => 'required|string|max:255',
            'daf' => 'required|string|max:255',
        ]);

        $coa = $activity->coas()->create($validatedData);
        return redirect()->route('ashanls.create', ['activity' => $activity->id])
        ->with('success', 'Berhasil disimpan. Silakan lanjutkan dengan mengisi Ash Analysis.');
    }

    public function edit(Coa $coa)
    {
        return view('coas.edit', compact('coa'));
    }

    public function update(Request $request, Coa $coa)
    {
        $request->validate([
            'activity_id' => 'required|exists:activities,id',
            'number' => 'required|string|max:255',
            'tm2' => 'required|string|max:255',
            'im2' => 'required|string|max:255',
            'ash1' => 'required|string|max:255',
            'ash3' => 'required|string|max:255',
            'vm2' => 'required|string|max:255',
            'fc2' => 'required|string|max:255',
            'ts3' => 'required|string|max:255',
            'ts2' => 'required|string|max:255',
            'adb' => 'required|string|max:255',
            'arb' => 'required|string|max:255',
            'daf' => 'required|string|max:255',
        ]);

        $coa->update($request->all());
        return redirect()->route('coas.index')->with('success', 'Coa updated successfully.');
    }

    public function destroy(Coa $coa)
    {
        $coa->delete();
        return redirect()->route('coas.index')->with('success', 'Coa deleted successfully.');
    }
}
