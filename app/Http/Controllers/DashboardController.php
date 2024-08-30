<?php

namespace App\Http\Controllers;

use App\Models\Shipment;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $shipments = Shipment::all();
        return view('dashboard.index', compact('shipments')); // Pastikan path view ini sesuai dengan lokasi file index.blade.php

        // Contoh pengumpulan data untuk chart
            $garData = $shipments->pluck('gar');
            $edData = $shipments->pluck('type');
            $buyerData = $shipments->pluck('company.name');
            $surveyorData = $shipments->pluck('surveyors.name');

        // Data untuk chart
            $garChartData = $garData->countBy()->toArray();
            $edChartData = $edData->countBy()->toArray();
            $buyerChartData = $buyerData->countBy()->toArray();
            $surveyorChartData = $surveyorData->countBy()->toArray();

         return view('dashboard', compact('shipments', 'garChartData', 'edChartData', 'buyerChartData', 'surveyorChartData'));
        }
    }

