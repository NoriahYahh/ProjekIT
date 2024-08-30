<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InternationalCompany;

class InternationalCompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = [
            'ADANI',
            'ADITYA BIRLA GLOBAL TRADING SINGAPORE PTE. LTD.',
            'ANHUI TECHNOLOGY IMP. AND EXP. CO., LTD',
            'BARY CHEMICAL PTE. LTD',
            'BARY COMMODITIES PTE LTD',
            'BROOKLYN ENTERPRISE PTE. LTD',
            'BST (HK) LIMITED',
            'CARAVEL CARBON LIMITED',
            'CCS (CHINA COMMODITIES SOLUTION (HK). LTD)',
            'CEDC (CEBU ENERGY DEVELOPMENT CORPORATION)',
            'CENTURY COMMODITIES SOLUTION. PTE. LTD',
            'CFPC (SINGAPORE) PTE LTD',
            'CHINA COAL SOLUTION SINGAPORE',
            'CITIC',
            'CNBM INTERNATIONAL CORPORATION',
            'DONGGUAN CITY HUIHUANG ENERGY CO., LTD',
            'EAST PROFIT',
            'EQUENTIA NATURAL RESOURCES PTE. LTD',
            'EXPRESS WELL RESOURCES',
            'FLAME ASIA RESOURCES',
            'GANDHAR OIL',
            'GS GLOBAL CORP',
            'HBK',
            'HONGKONG TOPWAY TRADING CO., LIMITED',
            'HUA DIAN',
            'HUAXING',
            'IMR METALLURGICAL RESOURCES AG',
            'JSW INTERNATIONAL TRADECORP PTE LTD',
            'KILO RICHTER INTERNATIONAL PTE, LTD',
            'KITAI RESOURCES',
            'LUCKY ELECTRIK POWER COMPANY. LTD',
            'MARUBENI',
            'MASINLOC POWER PARTNERS Co. Ltd',
            'NEW AN YANG INTERNATIONAL TRADE Co. LIMITED',
            'SAN MIGUEL CORPORATION',
            'SCCC (SIAM CITY CEMENT TRADING COMPANY LIMITED)',
            'SCPC (SMC CONSOLIDATED POWER CORPORATION)',
            'SHANXI KINGSTAR INTERNATIONAL TRADE CO., LTD',
            'STARPORT TRADING DEVELOPMENT LIMITED',
            'SUMEC INTERNATIONAL TECHNOLOGY CO, LTD.',
            'TATA INTERNATIONAL',
            'TPC (TOLEDO POWER COMPANY)',
            'TRAFIGURA ASIA TRADING PTE. LTD',
            'TSINGSHAN',
            'WHW (WELL HARVEST WINNING ALUMINA REFINERY)',
            'XIAMEN XIANGYUE',
            'ZHEJIANG MATERIAL',
            'ZHUHAI PORT HOLDING (HONGKONG) CO LTD',
            'ZJMI ENVIRONMENTAL ENERGY CO, LTD',
            'CHINA BAI GUI INTERNATIONAL TRADE LIMITED',
        
            'TES',
        ];

        foreach ($companies as $company) {
            InternationalCompany::create(['name' => trim($company)]);
        }
    }
}
