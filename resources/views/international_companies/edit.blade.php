@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Perusahaan Internasional</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('international_companies.update', $company->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nama Perusahaan</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $company->name) }}" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Update</button>
    </form>
</div>
@endsection