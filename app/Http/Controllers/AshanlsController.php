<?php

namespace App\Http\Controllers;

use App\Models\Ashanls;
use App\Models\Activity;
use Illuminate\Http\Request;

class AshanlsController extends Controller
{
    public function index()
    {
        
        $ashanls = Ashanls::with('activity')->get();
        return view('ashanls.index', compact('ashanls'));
    }

    public function create(Activity $activity)
    {
        $activities = Activity::all();
        $id = session('id');
        return view('ashanls.create', compact('activity', 'id'));
    }

    public function store(Request $request, Activity $activity)
    {
        $validatedData = $request->validate([
            'cal' => 'required|string',
            'si' => 'required|string',
            'ai' => 'required|string',
            'fe' => 'required|string',
            'ca' => 'required|string',
            'mg' => 'required|string',
            'na' => 'required|string',
            'k2' => 'required|string',
            'ti' => 'required|string',
            'so' => 'required|string',
            'mn' => 'required|string',
            'p2' => 'required|string',
            'un' => 'required|string',
            'fofa' => 'required|string',
            'slafa' => 'required|string',
        ]);

        $ashanls = $activity->ashanls()->create($validatedData);
        return redirect()->route('activities.show', $activity->id)->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(Ashanls $ashanls)
    {
        $activities = Activity::all();
        return view('ashanls.edit', compact('ashanls', 'activities'));
    }

    public function update(Request $request, Ashanls $ashanls)
    {
        $validatedData = $request->validate([
            'activity_id' => 'required|exists:activities,id',
            'cal' => 'required|string',
            'si' => 'required|string',
            'ai' => 'required|string',
            'fe' => 'required|string',
            'ca' => 'required|string',
            'mg' => 'required|string',
            'na' => 'required|string',
            'k2' => 'required|string',
            'ti' => 'required|string',
            'so' => 'required|string',
            'mn' => 'required|string',
            'p2' => 'required|string',
            'un' => 'required|string',
            'fofa' => 'required|string',
            'slafa' => 'required|string',
        ]);

        $ashanls->update($validatedData);

        return redirect()->route('ashanls.index')->with('success', 'Ash Analysis data updated successfully.');
    }

    public function destroy(Ashanls $ashanls)
    {
        $ashanls->delete();
        return redirect()->route('ashanls.index')->with('success', 'Ash Analysis data deleted successfully.');
    }
}
