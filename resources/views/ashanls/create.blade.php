@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Ash Analysis</h1>
    <form action="{{ route('ashanls.store', $activity->id) }}" method="POST">
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
            <label for="cal">Cal/g</label>
            <input type="number" class="form-control" id="cal" name="cal" placeholder="Masukkan cal/g" required>
        </div>
        <div class="form-group">
            <label for="si">SiO2</label>
            <input type="number" class="form-control" id="si" name="si" placeholder="Masukkan SiO2" step="any" required oninput="calculateValues()">
        </div>
        <div class="form-group">
            <label for="ai">Ai2O3</label>
            <input type="number" class="form-control" id="ai" name="ai" placeholder="Masukkan Ai2O3" step="any" required oninput="calculateValues()">
        </div>

        <div class="form-row-inline">
            <div class="form-group">
                <label for="fe">Fe2O3</label>
                <input type="number" class="form-control" id="fe" name="fe" placeholder="Masukkan Fe2O3" step="any" required oninput="calculateValues()">
            </div>
            <div class="form-group">
                <label for="ca">CaO</label>
                <input type="number" class="form-control" id="ca" name="ca" placeholder="CaO (%)" step="any" required oninput="calculateValues()">
            </div>
        </div>

        <div class="form-group">
            <label for="mg">MgO</label>
            <input type="number" class="form-control" id="mg" name="mg" placeholder="Masukkan MgO" step="any" required oninput="calculateValues()">
        </div>

        <div class="form-group">
            <label for="na">Na2O</label>
            <input type="number" class="form-control" id="na" name="na" placeholder="Masukkan Na2O" step="any" required oninput="calculateValues()">
        </div>

        <div class="form-group">
            <label for="k2">K2O</label>
            <input type="number" class="form-control" id="k2" name="k2" placeholder="Masukkan K2O" step="any" required oninput="calculateValues()">
        </div>

        <div class="form-group">
            <label for="ti">TiO2</label>
            <input type="number" class="form-control" id="ti" name="ti" placeholder="Masukkan TiO2" required oninput="calculateValues()">
        </div>

        <h2>CV</h2>
        <div class="form-row-inline">
            <div class="form-group">
                <label for="so">SO3</label>
                <input type="number" class="form-control" id="so" name="so" placeholder="Masukkan SO3" step="any" required oninput="calculateValues()">
            </div>
            <div class="form-group">
                <label for="mn">Mn3O4</label>
                <input type="number" class="form-control" id="mn" name="mn" placeholder="Masukkan Mn3O4" step="any" required oninput="calculateValues()">
            </div>
            <div class="form-group">
                <label for="p2">P2O5</label>
                <input type="number" class="form-control" id="p2" name="p2" placeholder="Masukkan P2O5" step="any" required oninput="calculateValues()">
            </div>
            <div class="form-group">
                <label for="un">Und.</label>
                <input type="text" class="form-control" id="un" name="un" placeholder="Und." required readonly>
            </div>
            <div class="form-group">
                <label for="fofa">Fouling Factor</label>
                <input type="text" class="form-control" id="fofa" name="fofa" placeholder="Fouling Factor" readonly>
            </div>
            <div class="form-group">
                <label for="slafa">Slagging Factor</label>
                <input type="text" class="form-control" id="slafa" name="slafa" placeholder="Slagging Factor" required>
            </div>
        </div>
        <div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            // Fungsi untuk menghitung nilai
            function calculateValues() {
                // Ambil nilai dari semua input terkait
                const si = parseFloat(document.getElementById('si').value) || 0;
                const ai = parseFloat(document.getElementById('ai').value) || 0;
                const fe = parseFloat(document.getElementById('fe').value) || 0;
                const ca = parseFloat(document.getElementById('ca').value) || 0;
                const mg = parseFloat(document.getElementById('mg').value) || 0;
                const na = parseFloat(document.getElementById('na').value) || 0;
                const k2 = parseFloat(document.getElementById('k2').value) || 0;
                const ti = parseFloat(document.getElementById('ti').value) || 0;
                const so = parseFloat(document.getElementById('so').value) || 0;
                const mn = parseFloat(document.getElementById('mn').value) || 0;
                const p2 = parseFloat(document.getElementById('p2').value) || 0;
                const ts2 = parseFloat(localStorage.getItem('ts2Value')) || 0; // Ambil nilai ts2 dari localStorage

                // Hitung nilai untuk UN (jika diperlukan)
                const countUN = [si, ai, fe, ca, mg, na, k2, ti, so, mn, p2].filter(value => value !== 0).length;
                let unValue = "-";
                if (countUN >= 11) {
                    unValue = (si + ai + fe + ca + mg + na + k2 + ti + so + mn + p2) - 100;
                }
                document.getElementById('un').value = unValue;

                // Hitung nilai untuk FOFA
                const countFOFA = [si, ai, fe, ca, mg, na, k2, ti].filter(value => value !== 0).length;
                let fofaValue = "0";
                if (countFOFA >= 8) {
                    const sumFeToK2 = fe + ca + mg + na + k2;
                    const sumSiAiTi = si + ai + ti;
                    if (sumSiAiTi !== 0) {
                        fofaValue = (sumFeToK2 / sumSiAiTi) * na;
                    }
                }
                document.getElementById('fofa').value = fofaValue;

                // Hitung nilai untuk Slagging Factor
                const countFOFAForSlafa = [si, ai, fe, ca, mg, na, k2, ti].filter(value => value !== 0).length;
                let slafaValue = "0";
                if (countFOFAForSlafa >= 8) {
                    const sumFeToK2 = fe + ca + mg + na + k2;
                    const sumSiAiTi = si + ai + ti;
                    if (sumSiAiTi !== 0) {
                        slafaValue = (sumFeToK2 / sumSiAiTi) * ts2;
                    }
                }
                document.getElementById('slafa').value = slafaValue;
            }

            // Tambahkan event listener untuk menghitung nilai saat input berubah
            document.querySelectorAll('input').forEach(input => {
                input.addEventListener('input', calculateValues);
            });

            // Panggil calculateValues saat halaman dimuat
            calculateValues();
        });
    </script>
    @endsection