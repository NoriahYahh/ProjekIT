@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="mt-4">{{ \Carbon\Carbon::parse($activity->activity_date)->format('F Y') }}</h3>
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="d-flex align-items-center mb-3">
            <!-- Tombol Kembali -->
            <a href="{{ route('activities.index') }}" class="btn btn-link p-0 me-2">
                <i class="fas fa-arrow-left" style="font-size: 1.5rem; color: #d3d3d3;"></i>
            </a>
            <div>
                <a href="{{ route('shipments.create', $activity->id) }}" class="btn btn-primary mr-2">Tambah Data {{ \Carbon\Carbon::parse($activity->activity_date)->format('F') }}</a>
                <a href="{{ route('export', $activity->id) }}" class="btn btn-success">Download Excel</a>
            </div>
        </div>
        <form method="GET" action="{{ route('activities.show', $activity->id) }}" class="d-md-inline-block form-inline ml-auto">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search for MV, Barge, Surveyor, or Buyer..." aria-label="Search" value="{{ request('search') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>

    <!-- Tampilkan alert jika pencarian tidak menemukan hasil -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
    </div>
    @endif

    <!-- Tampilkan alert jika ada -->
    @if(session('alert'))
    <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
        {{ session('alert') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
    </div>
    @endif
    <h4>Shipment</h4>
    @if ($activity->shipments->isEmpty())
    <div class="alert alert-warning mt-4" role="alert">
        Belum ada data yang ditambahkan.
    </div>
    @else
    <div class="table-responsive mt-4">
        <table class="table table-bordered text-center table-hover">
            <thead class="thead-dark thead-custom">
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
                    <th>Commence</th>
                    <th>Completed</th>
                    <th>Duration (Day)</th>
                </tr>
            </thead>

            <tbody>
                @foreach($shipments as $shipment)
                <tr>
                    <td>{{ $shipment->gar }}</td>
                    <td>{{ $shipment->type }}</td>
                    <td>{{ $shipment->mv ?? '-' }}</td>
                    <td>{{ $shipment->bg ?? '-' }}</td>
                    <td>{{ $shipment->sp }}</td>
                    <td>{{ $shipment->fv }}</td>
                    <td>{{ $shipment->fd }}</td>
                    <td>{{ $shipment->bf }}</td>
                    <td>{{ $shipment->rc }}</td>
                    <td>{{ $shipment->ss }}</td>
                    <td>{{ \Carbon\Carbon::parse($shipment->arrival_date)->format('Y-m-d') }}</td>
                    <td>{{ \Carbon\Carbon::parse($shipment->departure_date)->format('Y-m-d') }}</td>
                    <td>{{ $shipment->duration ?? 'N/A' }}</td>
                    <td>{{ $shipment->cargo }}</td>
                    <td>{{ $shipment->company ? $shipment->company->name : '-' }}</td>
                    <td>{{ $shipment->dt }}</td>
                    <td>{{ $shipment->tg }}</td>
                    <td>{{ $shipment->sv }}</td>
                    <td>
                        <div class="d-flex justify-content-center align-items-center">
                            <a href="{{ route('shipments.edit', $shipment->id) }}" class="btn btn-warning btn-sm mr-3" style="margin-right: 10px;">Edit</a>
                            <form action="{{ route('shipments.destroy', $shipment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link p-0" onclick="return confirm('Apakah Anda yakin ingin menghapus?')" title="Delete">
                                    <i class="fas fa-times" style="color: #d3d3d3;"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    <h4>Report of Analysis </h4>
    <!-- Tampilkan tabel jika ada data ROA -->
    @if ($activity->roas->isNotEmpty())
    <div class="table-responsive mt-4">
        <table class="table table-bordered text-center table-hover">
            <thead class="thead-dark thead-custom">
                <tr>
                    <th colspan="1">TM</th>
                    <th colspan="1">IM</th>
                    <th colspan="1">ASH</th>
                    <th colspan="1">ASH</th>
                    <th colspan="1">VM</th>
                    <th colspan="1">FC</th>
                    <th colspan="1">TS</th>
                    <th colspan="3">CV</th>
                    <th rowspan="2">Analisis Standar</th>
                    <th rowspan="2">Actions</th>
                </tr>
                <tr>
                    <th> % Arb </th>
                    <th> % Adb </th>
                    <th> % Adb </th>
                    <th> % db </th>
                    <th> % Adb </th>
                    <th> % Adb </th>
                    <th> % Adb </th>
                    <th> Adb </th>
                    <th> Arb </th>
                    <th> Daf </th>

                </tr>
            </thead>


            <tbody>
                @foreach($roas as $roa)
                <tr>
                    <td>{{ $roa->tm }}</td>
                    <td>{{ $roa->im }}</td>
                    <td>{{ $roa->ash }}</td>
                    <td>{{ $roa->ash2 }}</td>
                    <td>{{ $roa->vm }}</td>
                    <td>{{ $roa->fc }}</td>
                    <td>{{ $roa->ts }}</td>
                    <td>{{ $roa->Adb }}</td>
                    <td>{{ $roa->Arb }}</td>
                    <td>{{ $roa->Daf }}</td>
                    <td>{{ $roa->Analisis_Standar}}</td>
                    <td>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="alert alert-warning mt-4" role="alert">
        Belum ada data ROA yang ditambahkan.
    </div>
    @endif

    <h4>Certificate of Analysis</h4>
    <a href="{{ route('coas.create', $activity->id) }}" class="btn btn-primary mr-2">+ COA</a>
    @if ($activity->coas->isNotEmpty())
    <div class="table-responsive mt-4">
        <table class="table table-bordered text-center table-hover">
            <thead class="thead-dark thead-custom">
                <tr>
                    <th rowspan="3">COA NUMBER</th>
                    <th colspan="11">CERTIFICATE OF ANALYSIS</th>
                    <th rowspan="3">Actions</th>
                </tr>
                <tr>
                    <th>TM</th>
                    <th>IM</th>
                    <th>Ash (%Adb)</th>
                    <th>Ash (%db)</th>
                    <th>VM (%Adb)</th>
                    <th>FC (%Adb)</th>
                    <th>TS (%Adb)</th>
                    <th>TS (%db)</th>
                    <th colspan="3">CV</th>
                </tr>
                <tr>
                    <th>% Arb</th>
                    <th>% Adb</th>
                    <th>% Adb</th>
                    <th>% db</th>
                    <th>% Adb</th>
                    <th>% Adb</th>
                    <th>% Adb</th>
                    <th>% db</th>
                    <th>Adb</th>
                    <th>Arb</th>
                    <th>Daf</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activity->coas as $coa)
                <tr>
                    <td>{{ $coa->number }}</td>
                    <td>{{ $coa->tm2 }}</td>
                    <td>{{ $coa->im2 }}</td>
                    <td>{{ $coa->ash1 }}</td>
                    <td>{{ $coa->ash3 }}</td>
                    <td>{{ $coa->vm2 }}</td>
                    <td>{{ $coa->fc2 }}</td>
                    <td>{{ $coa->ts3 }}</td>
                    <td>{{ $coa->ts2 }}</td>
                    <td>{{ $coa->adb }}</td>
                    <td>{{ $coa->arb }}</td>
                    <td>{{ $coa->daf }}</td>
                    <td>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="alert alert-warning mt-4" role="alert">
        Belum ada data COA yang ditambahkan.
    </div>
    @endif

    <h4>Ash Analysis</h4>
    @if ($activity->ashanls->isNotEmpty())
    <div class="table-responsive mt-4">
        <table class="table table-bordered text-center table-hover">
            <thead class="thead-dark thead-custom">
                <tr>
                    <th colspan="1">NCV</th>
                    <th colspan="12">Ash Analysis</th>
                    <th rowspan="4">Fouling Factor</th>
                    <th rowspan="4">Slagging Factor</th>
                    <th rowspan="4">Actions</th>
                </tr>
                <tr>
                    <th>Cal/g</th>
                    <th>SiO2</th>
                    <th>Ai2O3</th>
                    <th>Fe2O3</th>
                    <th>CaO</th>
                    <th>MgO</th>
                    <th>Na2O</th>
                    <th>K2O</th>
                    <th>TiO2</th>
                    <th>SO3</th>
                    <th>Mn3O4</th>
                    <th>P2O5</th>
                    <th>Und.</th>
                </tr>
                <tr>
                    <th>(ar)</th>
                    <th>%</th>
                    <th>%</th>
                    <th>%</th>
                    <th>%</th>
                    <th>%</th>
                    <th>% </th>
                    <th>%</th>
                    <th>%</th>
                    <th>%</th>
                    <th>%</th>
                    <th>%</th>
                    <th>%</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activity->ashanls as $ashanl)
                <tr>
                    <td>{{ $ashanl->cal }}</td>
                    <td>{{ $ashanl->si }}</td>
                    <td>{{ $ashanl->ai }}</td>
                    <td>{{ $ashanl->fe }}</td>
                    <td>{{ $ashanl->ca }}</td>
                    <td>{{ $ashanl->mg }}</td>
                    <td>{{ $ashanl->na }}</td>
                    <td>{{ $ashanl->k2 }}</td>
                    <td>{{ $ashanl->ti }}</td>
                    <td>{{ $ashanl->so }}</td>
                    <td>{{ $ashanl->mn }}</td>
                    <td>{{ $ashanl->p2 }}</td>
                    <td>{{ $ashanl->un }}</td>
                    <td>{{ $ashanl->fofa }}</td>
                    <td>{{ $ashanl->slafa }}</td>
                    <td>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="alert alert-warning mt-4" role="alert">
        Belum ada data Ash Analysis yang ditambahkan.
    </div>
    @endif


</div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap Bundle with Popper -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>


<style>
    .thead-dark th {
        background-color: #9a9a9a;
        color: white;
    }

    .thead-custom th {
        vertical-align: middle;
    }

    .alert-dismissible .close {
        position: absolute;
        top: 0;
        right: 0;
        padding: 0.75rem 1.25rem;
        margin: 0;
        background: none;
        border: none;
        color: #d3d3d3;
    }

    .alert-dismissible .close i {
        font-size: 1.5rem;
        /* Adjust size if necessary */
        vertical-align: middle;
    }

    .alert-dismissible .close:hover {
        color: #000;
        /* Optional: Change color on hover */
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        line-height: 1.5;
        border-radius: 0.2rem;
    }
</style>
@endsection