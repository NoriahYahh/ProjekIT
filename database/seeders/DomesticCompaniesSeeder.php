<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DomesticCompany;

class DomesticCompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = [
            'BARA INDAH SINERGI',
            'BAT (BARAANUGERAH ANEKA TRITUNGGAL)',
            'CIKARANG LISTRINDO',
            'HALMAHERA JAYA FERONIKEL',
            'INDOCEMENT TUNGGAL PRAKARSA',
            'KEN (KALDERA ENERGI NUSANTARA)',
            'LBE (LESTARI BANTEN ENERGI)',
            'LOMBOK ENERGI DYNAMIC',
            'MSP (MEGAH SURYA PERTIWI)',
            'OKTASAN BARUNA PERSADA',
            'PINE ENERGY',
            'PJB UP PAITON',
            'PLN ENERGI PRIMER INDONESIA',
            'PLN NUSANTARA POWER',
            'PLNBB (PLN BATUBARA)',
            'PLNBBN (PLN BATUBARA NIAGA)',
            'SEMEN INDONESIA',
            'SEMEN TONASA',
            'OBSIDIAN STAINLESS STEEL',
        
            'PT.BCD Coal',
        
            'APA',
        
            'TES',
        
            'TES',
        ];

        foreach ($companies as $company) {
            DomesticCompany::create(['name' => trim($company)]);
        }
    }
}


