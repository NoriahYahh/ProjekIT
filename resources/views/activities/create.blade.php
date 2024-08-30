@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-white" style="background-color: #8B0000;">
                        <h2 class="mb-0">Buat Rekap</h2>
                    </div>

                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('activities.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nama Rekap:</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="activity_date">Waktu Rekap (Bulan dan Tahun):</label>
                                <input type="month" name="activity_date" id="activity_date" class="form-control" value="{{ old('activity_date') }}" required>
                            </div>

                            <div class="form-group text-right" style="margin-top: 20px;">
                                <button type="submit" class="btn btn-success">Lanjutkan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
