@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Shipments</h1>
    <div class="mb-3">
        <a href="{{ route('shipments.create') }}" class="btn btn-primary">Tambah Shipment</a>
        <a href="{{ route('export') }}" class="btn btn-success">Download Excel</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table class="table table-bordered text-center">
        <thead class="thead-custom">
            <tr>
                <th colspan="2">SHIPMENT</th>
                <th rowspan="2">MV</th>
                <th rowspan="2">BARGE</th>
                <th rowspan="2">STOWAGE PLAN</th>
                <th rowspan="2">FIGURE VESSEL</th>
                <th rowspan="2">FINAL DRAFT</th>
                <th colspan="3">RETURN CARGO</th>
                <th colspan="3">LOADING TIME</th>
                <th rowspan="2">CARGO</th>
                <th rowspan="2">BUYER</th>
                <th rowspan="2">DESTINATION</th>
                <th rowspan="2">B/L</th>
                <th rowspan="2">SURVEYOR</th>
                <th rowspan="2">Actions</th>
            </tr>
            <tr>
                <th>GAR</th>
                <th>E/D</th>
                <th>BARGE FIGURE (R/C)</th>
                <th>R/C BARGE</th>
                <th>SHORTAGE/SURPLUS</th>
                <th>Commance</th>
                <th>Completed</th>
                <th>Duration (Day)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($shipments as $shipment)
            <tr>
                <td>{{ $shipment->gar }}</td>
                <td>{{ $shipment->type }}</td>
                <td>{{ $shipment->mv ? $shipment->mv : '-' }}</td>
                <td>{{ $shipment->bg ? $shipment->bg : '-' }}</td>
                <td>{{ $shipment->sp }}</td>
                <td>{{ $shipment->fv }}</td>
                <td>{{ $shipment->fd }}</td>
                <td>{{ $shipment->bf }}</td>
                <td>{{ $shipment->rc }}</td>
                <td>{{ $shipment->ss }}</td>
                <td>{{ \Carbon\Carbon::parse($shipment->arrival_date)->format('Y-m-d') }}</td>
                <td>{{ \Carbon\Carbon::parse($shipment->departure_date)->format('Y-m-d') }}</td>
                <td>{{ $shipment->duration }}</td>
                <td>{{ $shipment->cargo }}</td>
                <td>{{ $shipment->company ? $shipment->company->name : 'N/A' }}</td>
                <td>{{ $shipment->dt }}</td>
                <td>{{ $shipment->tg }}</td>
                <td>{{ $shipment->sv }}</td>
                <td>
                    <a href="{{ route('shipments.edit', $shipment->id) }}" class="btn btn-warning">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<style>
    .thead-custom th {
        vertical-align: middle;
    }
</style>
@endsection