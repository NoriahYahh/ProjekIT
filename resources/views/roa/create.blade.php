@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Report Of Analysis</h1>
    <form action="{{ route('roa.store', $activity->id) }}" method="POST">
        @csrf

        <input type="hidden" name="activity_id" value="{{ $activity->id }}">

        <style>
            .form-group {
                margin-bottom: 15px;
                /* Space between form elements */
            }

            .form-control {
                width: 100%;
                /* Ensure inputs take full width */
            }

            .btn {
                margin-top: 10px;
            }

            .form-row-inline {
                display: flex;
                gap: 15px;
                /* Space between form elements */
            }

            .form-row-inline .form-group {
                flex: 1;
                /* Make each form-group take equal width */
            }

            .date-inputs {
                display: flex;
                justify-content: space-between;
            }

            .date-inputs .form-group {
                flex: 1;
                margin-right: 10px;
            }

            .date-inputs .form-group:last-child {
                margin-right: 0;
            }
        </style>

        <div class="form-group">
            <label for="tm">TM</label>
            <input type="text" class="form-control" id="tm" name="tm" placeholder="Masukkan TM" required>
        </div>
        <div class="form-group">
            <label for="im">IM</label>
            <input type="number" class="form-control" id="im" name="im" placeholder="Masukkan IM" required>
        </div>

        <div class="form-row-inline">
            <div class="form-group">
                <label for="ash">ASH</label>
                <input type="number" class="form-control" id="ash" name="ash" placeholder="Masukkan ASH" required>
            </div>
            <div class="form-group">
                <label for="ash2">ASH2</label>
                <input type="text" class="form-control" id="ash2" name="ash2" placeholder="ASH2" readonly>
            </div>
        </div>

        <div class="form-group">
            <label for="vm">VM</label>
            <input type="number" class="form-control" id="vm" name="vm" placeholder="Masukkan VM">
        </div>

        <div class="form-group">
            <label for="fc">FC</label>
            <input type="text" class="form-control" id="fc" name="fc" placeholder="FC" readonly>
        </div>

        <div class="form-group">
            <label for="ts">TS</label>
            <input type="text" class="form-control" id="ts" name="ts" placeholder="Masukkan TS" required>
        </div>

        <h2>CV</h2>
        <div class="form-row-inline">
            <div class="form-group">
                <label for="Adb">ADB</label>
                <input type="text" class="form-control" id="Adb" name="Adb" placeholder="Masukkan ADB" required>
            </div>
            <div class="form-group">
                <label for="Arb">ARB</label>
                <input type="text" class="form-control" id="Arb" name="Arb" placeholder="ARB" readonly>
            </div>
            <div class="form-group">
                <label for="Daf">DAF</label>
                <input type="text" class="form-control" id="Daf" name="Daf" placeholder="DAF" readonly>
            </div>
        </div>

        <!-- Dropdown for Analisis Standar -->
        <div class="form-group">
            <label for="Analisis_Standar">ANALYSIS STANDART</label>
            <select class="form-control" id="Analisis_Standar" name="Analisis_Standar" required>
                <option value="">Pilih Analisis Standar</option>
                <option value="ASMT">ASMT</option>
                <option value="ISO">ISO</option>
            </select>
        </div>

        <div>
            <button type="submit" class="btn btn-success">Simpan</button>
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
                document.getElementById('ash2').value = ash2.toFixed(3); // Display 3 decimal places
            } else {
                document.getElementById('ash2').value = '';
            }

            // Calculate FC
            const fc = (100 - (im + ash + vm)).toFixed(3); // Display 3 decimal places
            document.getElementById('fc').value = fc;

            // Calculate ARB
            if (100 - im !== 0) {
                const arb = ((100 - tm) / (100 - im)) * adb;
                document.getElementById('Arb').value = arb.toFixed(3); // Display 3 decimal places
            } else {
                document.getElementById('Arb').value = '';
            }

            // Calculate DAF
            if (100 - im - ash !== 0) {
                const daf = (100 / (100 - im - ash)) * adb;
                document.getElementById('Daf').value = daf.toFixed(3); // Display 3 decimal places
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