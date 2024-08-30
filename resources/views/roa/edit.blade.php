@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit ROA</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('roa.update', $roa->id) }}" method="POST">
        @csrf
        @method('PUT')
        <style>
            .form-group {
                margin-bottom: 15px;
            }

            .form-control {
                width: 100%;
            }

            .btn {
                margin-top: 10px;
            }

            .form-row-inline {
                display: flex;
                gap: 15px;
            }

            .form-row-inline .form-group {
                flex: 1;
            }
        </style>

        <div class="form-group">
            <label for="tm">TM</label>
            <input type="number" step="0.001" class="form-control" id="tm" name="tm" value="{{ $roa->tm }}" placeholder="Masukkan TM" required>
        </div>
        <div class="form-group">
            <label for="im">IM</label>
            <input type="number" step="0.001" class="form-control" id="im" name="im" value="{{ $roa->im }}" placeholder="Masukkan IM" required>
        </div>

        <div class="form-row-inline">
            <div class="form-group">
                <label for="ash">ASH</label>
                <input type="number" step="0.001" class="form-control" id="ash" name="ash" value="{{ $roa->ash }}" placeholder="Masukkan ASH" required>
            </div>
            <div class="form-group">
                <label for="ash2">ASH</label>
                <input type="number" step="0.001" class="form-control" id="ash2" name="ash2" value="{{ $roa->ash2 }}" readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="vm">VM</label>
            <input type="number" step="0.001" class="form-control" id="vm" name="vm" value="{{ $roa->vm }}" placeholder="Masukkan VM">
        </div>

        <div class="form-group">
            <label for="fc">FC</label>
            <input type="number" step="0.001" class="form-control" id="fc" name="fc" value="{{ $roa->fc }}" placeholder="Masukkan FC" readonly>
        </div>
        <div class="form-group">
            <label for="ts">TS</label>
            <input type="number" step="0.001" class="form-control" id="ts" name="ts" value="{{ $roa->ts }}" placeholder="Masukkan TS" required>
        </div>
        <h2>CV</h2>
        <div class="form-row-inline">
            <div class="form-group">
                <label for="Adb">ADB</label>
                <input type="number" step="0.001" class="form-control" id="Adb" name="Adb" value="{{ $roa->Adb }}" placeholder="Masukkan ADB" required>
            </div>
            <div class="form-group">
                <label for="Arb">ARB</label>
                <input type="number" step="0.001" class="form-control" id="Arb" name="Arb" value="{{ $roa->Arb }}" placeholder="Masukkan ARB" readonly>
            </div>
            <div class="form-group">
                <label for="Daf">DAF</label>
                <input type="number" step="0.001" class="form-control" id="Daf" name="Daf" value="{{ $roa->Daf }}" placeholder="Masukkan DAF" readonly>
            </div>
        </div>

        <div class="form-group">
            <label for="Analisis_Standar">ANALYSIS STANDARD</label>
            <select class="form-control" id="Analisis_Standar" name="Analisis_Standar" required>
                <option value="ASMT" {{ $roa->Analisis_Standar == 'ASMT' ? 'selected' : '' }}>ASMT</option>
                <option value="ISO" {{ $roa->Analisis_Standar == 'ISO' ? 'selected' : '' }}>ISO</option>
            </select>
        </div>
        <div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('roa.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<script>
   document.addEventListener('DOMContentLoaded', function() {
        function updateFields() {
            const im = parseFloat(document.getElementById('im').value) || 0;
            const ash = parseFloat(document.getElementById('ash').value) || 0;
            const vm = parseFloat(document.getElementById('vm').value) || 0;
            const tm = parseFloat(document.getElementById('tm').value) || 0;
            const adb = parseFloat(document.getElementById('Adb').value) || 0;

            // Calculate ASH2
            if (im < 100) {
                const ash2 = (100 / (100 - im)) * (ash || 0);
                document.getElementById('ash2').value = ash2.toFixed(3); // Menampilkan 3 angka desimal
            } else {
                document.getElementById('ash2').value = '';
            }

            // Calculate FC
            const fc = (100 - (im + ash + vm)).toFixed(3); // Menampilkan 3 angka desimal
            document.getElementById('fc').value = fc;

            // Calculate ARB
            if (100 - im !== 0) {
                const arb = ((100 - tm) / (100 - im)) * adb;
                document.getElementById('Arb').value = arb.toFixed(3); // Menampilkan 3 angka desimal
            } else {
                document.getElementById('Arb').value = '';
            }

            // Calculate DAF
            if (100 - im - ash !== 0) {
                const daf = (100 / (100 - im - ash)) * adb;
                document.getElementById('Daf').value = daf.toFixed(3); // Menampilkan 3 angka desimal
            } else {
                document.getElementById('Daf').value = '';
            }
        }

        // Adding event listeners to inputs
        document.getElementById('im').addEventListener('input', updateFields);
        document.getElementById('ash').addEventListener('input', updateFields);
        document.getElementById('vm').addEventListener('input', updateFields);
        document.getElementById('tm').addEventListener('input', updateFields);
        document.getElementById('Adb').addEventListener('input', updateFields);
    });
</script>

@endsection