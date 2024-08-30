@extends('layouts.app')

@section('content')
<div class="container">

    <h1> Daftar Buyer Domestik</h1>
    <div class="d-flex align-items-center mb-3">
        <!-- Tombol Kembali -->
        <a href="{{ url('dashboards') }}" class="btn btn-link p-0 me-2">
            <i class="fas fa-arrow-left" style="font-size: 1.5rem; color: #d3d3d3;"></i>
        </a>
        <!-- Tombol Tambah -->
        <a href="{{ route('domestic_companies.create') }}" class="btn btn-primary">Tambah</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Buyer</th>
                <th class="text-end"> </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($companies as $index => $company)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $company->name }}</td>
                <td class="text-end">
                    <!-- Tombol Edit -->
                    <a href="{{ route('domestic_companies.edit', $company->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <!-- Form Hapus -->
                    <form action="{{ route('domestic_companies.destroy', $company->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus buyer ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link p-0">
                            <i class="fas fa-times" style="color: #d3d3d3;"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@endsection