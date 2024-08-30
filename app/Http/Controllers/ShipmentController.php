<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\DomesticCompany;
use App\Models\Surveyor;
use App\Models\InternationalCompany;
use App\Models\Activity;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function index()
    {
        $shipments = Shipment::with(['company', 'activity'])->get();
        return view('shipments.index', compact('shipments'));
    }

    public function create(Activity $activity)
    {
        $surveyors = Surveyor::all();
        $activities = Activity::all();
        $id = session('id'); // Atau ambil ID dari sumber lain

        return view('shipments.create', compact('surveyors', 'activity', 'id'));
    }


    public function store(Request $request, Activity $activity)
    {
        // Validasi input
        $validatedData = $request->validate([
            'gar' => 'required|string|max:255',
            'type' => 'required|string|in:domestik,international',
            'mv' => 'nullable|string|max:255',
            'bg' => 'nullable|string|max:255',
            'sp' => 'required|string|max:255',
            'fv' => 'required|string|max:255',
            'fd' => 'required|string|max:255',
            'bf' => 'required|string|max:255',
            'rc' => 'required|string|max:255',
            'ss' => 'required|string|max:255',
            'arrival_date' => 'required|date',
            'departure_date' => 'required|date|after_or_equal:arrival_date',
            'cargo' => 'required|string|max:255',
            'company_id' => 'required|integer',
            'dt' => 'required|string|max:255',
            'tg' => 'required|string|max:255',
            'sv' => 'required|string|max:255',
        ]);
    
        // Simpan shipment dan hubungkan dengan activity
        $shipment = $activity->shipments()->create($validatedData);
    
        // Redirect ke halaman pembuatan Report of Analysis dengan shipment_id
        return redirect()->route('roa.create', ['activity' => $activity->id])
                         ->with('success', 'Shipment berhasil disimpan. Silakan lanjutkan dengan mengisi Report of Analysis.');
    }

    public function edit(Shipment $shipment)
    {
        $surveyors = Surveyor::all();
        $activity = $shipment->activity; // Mendapatkan aktivitas terkait dari shipment
        $id = session('id'); // Atau ambil ID dari sumber lain

        return view('shipments.edit', compact('shipment', 'surveyors', 'activity', 'id'));
    }

    public function update(Request $request, Shipment $shipment)
    {
        $request->validate([
            'gar' => 'required|string|max:255',
            'type' => 'required|string|in:domestik,international',
            'mv' => 'nullable|string|max:255',
            'bg' => 'nullable|string|max:255',
            'sp' => 'required|string|max:255',
            'fv' => 'required|string|max:255',
            'fd' => 'required|string|max:255',
            'bf' => 'required|string|max:255',
            'rc' => 'required|string|max:255',
            'ss' => 'required|string|max:255',
            'arrival_date' => 'required|date',
            'departure_date' => 'required|date|after_or_equal:arrival_date',
            'cargo' => 'required|string|max:255',
            'company_id' => 'required|integer',
            'dt' => 'required|string|max:255',
            'tg' => 'required|string|max:255',
            'sv' => 'required|string|max:255',
        ]);

        $shipment->update([
            'gar' => $request->gar,
            'type' => $request->type,
            'mv' => $request->mv,
            'bg' => $request->bg,
            'sp' => $request->sp,
            'fv' => $request->fv,
            'fd' => $request->fd,
            'bf' => $request->bf,
            'rc' => $request->rc,
            'ss' => $request->ss,
            'arrival_date' => $request->arrival_date,
            'departure_date' => $request->departure_date,
            'cargo' => $request->cargo,
            'company_id' => $request->company_id,
            'dt' => $request->dt,
            'tg' => $request->tg,
            'sv' => $request->sv,
        ]);

        return redirect()->route('activities.show', $shipment->activity_id)->with('success', 'Shipment berhasil diperbarui.');
    }

    public function destroy(Shipment $shipment)
    {
        $shipment->delete();

        return redirect()->route('activities.show', $shipment->activity_id)->with('success', 'Shipment berhasil dihapus.');
    }


    public function getCompanies(Request $request)
    {
        $type = $request->query('type');

        if (!in_array($type, ['domestik', 'international'])) {
            return response()->json(['error' => 'Invalid type'], 400);
        }

        $companies = $type === 'domestik'
            ? DomesticCompany::pluck('name', 'id')
            : InternationalCompany::pluck('name', 'id');

        return response()->json($companies);
    }
}
