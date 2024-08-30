@extends('layouts.app')

@section('content')
<h2>Daftar Kegiatan</h2>
@if ($activities->isEmpty())
<p>Tidak ada kegiatan yang ditemukan.</p>
@else
@foreach($activities as $activity)
<div>
    <a href="{{ route('activities.show', $activity->id) }}">{{ $activity->name }}</a>
    ({{ \Carbon\Carbon::parse($activity->activity_date)->format('F Y') }})
</div>
@endforeach
@endif
@endsection