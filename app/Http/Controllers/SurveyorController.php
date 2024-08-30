<?php

namespace App\Http\Controllers;

use App\Models\Surveyor;
use Illuminate\Http\Request;

class SurveyorController extends Controller
{
    // Menampilkan halaman form tambah surveyor
    public function create()
    {
        return view('surveyors.create');
    }

    // Menyimpan surveyor baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:surveyors,name',
        ], [
            'name.unique' => 'Nama surveyor sudah ada.'
        ]);

        Surveyor::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('surveyors.index')->with('success', 'Surveyor berhasil ditambahkan!');
    }

    // Menampilkan daftar surveyor
    public function index()
    {
        $surveyors = Surveyor::all();
        return view('surveyors.index', compact('surveyors'));
    }

    // Menampilkan halaman form edit surveyor
    public function edit($id)
    {
        $surveyor = Surveyor::findOrFail($id);
        return view('surveyors.edit', compact('surveyor'));
    }

    // Memperbarui data surveyor
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:surveyors,name,' . $id,
        ], [
            'name.unique' => 'Nama surveyor sudah ada.'
        ]);

        $surveyor = Surveyor::findOrFail($id);
        $surveyor->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('surveyors.index')->with('success', 'Surveyor berhasil diperbarui!');
    }

    // Menghapus surveyor dari database
    public function destroy($id)
    {
        $surveyor = Surveyor::findOrFail($id);
        $surveyor->delete();

        return redirect()->route('surveyors.index')->with('success', 'Surveyor berhasil dihapus!');
    }
}
