@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white" style="background-color: #8B0000;">
                    <h2 class="mb-0">Daftar Rekap</h2>
                </div>

                <div class="card-body">
                    @if ($activities->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        Belum ada rekap yang dibuat.
                    </div>
                    @else
                    <ul class="list-group">
                        @foreach($activities as $activity)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('activities.show', $activity->id) }}" class="text-decoration-none">
                                {{ $activity->name }}
                            </a>
                            <span class="text-muted">
                                ({{ \Carbon\Carbon::parse($activity->activity_date)->format('F Y') }})
                            </span>

                            <!-- Hapus Formulir -->
                            <form action="{{ route('activities.destroy', $activity->id) }}" method="POST" >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link p-0" onclick="return confirm('Apakah Anda yakin ingin menghapus?')" title="Delete">
                                    <i class="fas fa-times" style="color: #d3d3d3;"></i>
                                </button>
                            </form>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>

                <div class="card-footer text-right">
                    <a href="{{ route('activities.create') }}" class="btn btn-success">Buat Rekap</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection