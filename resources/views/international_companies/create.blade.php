@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Buyer Export Baru</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('international_companies.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nama Buyer</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Simpan</button>
    </form>
</div>
@endsection
