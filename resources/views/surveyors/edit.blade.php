@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Surveyor</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('surveyors.update', $surveyor->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nama Surveyor</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $surveyor->name) }}" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Update</button>
    </form>
</div>
@endsection
