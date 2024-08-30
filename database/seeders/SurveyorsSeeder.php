<?php

// database/seeders/SurveyorsSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SurveyorsSeeder extends Seeder
{
    public function run()
    {
        $surveyors = [
            'CCIC',
            'SURVEYOR INDONESIA',
            'ANINDYA',
            'COTECNA',
            'CARSURIN',
            'IOL',
            'GEOSERVICE',
            'SUCOFINDO'
        ];

        foreach ($surveyors as $surveyor) {
            DB::table('surveyors')->updateOrInsert(['name' => $surveyor]);
        }
    }
}

