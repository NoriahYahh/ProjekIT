<?php

namespace App\Http\Controllers;

use App\Models\InternationalCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class InternationalCompanyController extends Controller
{
    public function index()
    {
        $companies = InternationalCompany::all();
        return view('international_companies.index', compact('companies'));
    }

    public function create()
    {
        return view('international_companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:international_companies,name',
        ], [
            'name.unique' => 'Nama Buyer sudah ada.'
        ]);

        $company = InternationalCompany::create(['name' => trim($request->name)]);

        $this->addCompanyToSeeder($company->name);

        return redirect()->route('international_companies.index')
            ->with('success', 'Buyer berhasil ditambahkan.');
    }

    private function addCompanyToSeeder($companyName)
    {
        $seederPath = database_path('seeders/InternationalCompaniesSeeder.php');
        $seederContent = File::get($seederPath);

        if (strpos($seederContent, $companyName) === false) {
            $newEntry = "\n            '" . addslashes($companyName) . "',";
            $seederContent = str_replace(
                "];",
                $newEntry . "\n        ];",
                $seederContent
            );

            File::put($seederPath, $seederContent);
        }
    }

    public function show($id)
    {
        $company = InternationalCompany::find($id);
        if (!$company) {
            abort(404);
        }
        return view('international_companies.show', compact('company'));
    }

    public function edit($id)
    {
        $company = InternationalCompany::find($id);
        if (!$company) {
            abort(404);
        }
        return view('international_companies.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:international_companies,name,' . $id,
        ], [
            'name.unique' => 'Nama Buyer sudah ada.'
        ]);

        $company = InternationalCompany::find($id);
        if (!$company) {
            abort(404);
        }

        $company->update(['name' => trim($request->name)]);

        return redirect()->route('international_companies.index')
            ->with('success', 'Buyer berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $company = InternationalCompany::find($id);
        if (!$company) {
            abort(404);
        }

        $company->delete();

        return redirect()->route('international_companies.index')
            ->with('success', 'Buyer berhasil dihapus.');
    }
}
