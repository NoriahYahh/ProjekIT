<?php

namespace App\Http\Controllers;

use App\Models\DomesticCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DomesticCompanyController extends Controller
{
    public function index()
    {
        $companies = DomesticCompany::all();
        return view('domestic_companies.index', compact('companies'));
    }

    public function create()
    {
        return view('domestic_companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:domestic_companies,name',
        ], [
            'name.unique' => 'Nama Buyer sudah ada.'
        ]);

        $company = DomesticCompany::create(['name' => trim($request->name)]);

        // Tambahkan perusahaan baru ke seeder
        $this->addCompanyToSeeder($company->name);

        return redirect()->route('domestic_companies.index')
            ->with('success', 'Buyer berhasil ditambahkan.');
    }

    private function addCompanyToSeeder($companyName)
    {
        $seederPath = database_path('seeders/DomesticCompaniesSeeder.php');

        // Membaca isi file seeder
        $seederContent = File::get($seederPath);

        // Cari posisi array dan tambahkan perusahaan baru
        $newEntry = "\n            '" . addslashes($companyName) . "',";
        $seederContent = str_replace(
            "];",
            $newEntry . "\n        ];",
            $seederContent
        );

        // Menulis ulang file seeder dengan perusahaan baru
        File::put($seederPath, $seederContent);
    }

    public function show($id)
    {
        $company = DomesticCompany::findOrFail($id);
        return view('domestic_companies.show', compact('company'));
    }

    public function edit($id)
    {
        $company = DomesticCompany::findOrFail($id);
        return view('domestic_companies.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $company = DomesticCompany::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:domestic_companies,name,' . $company->id,
        ]);

        $company->update([
            'name' => trim($request->name),
        ]);

        return redirect()->route('domestic_companies.index')
            ->with('success', 'Buyer berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $company = DomesticCompany::findOrFail($id);
        $company->delete();

        return redirect()->route('domestic_companies.index')
            ->with('success', 'Buyer berhasil dihapus.');
    }
}
