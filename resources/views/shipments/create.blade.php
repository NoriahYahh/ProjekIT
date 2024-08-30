@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Shipment</h1>
    <form action="{{ route('shipments.store', $activity->id) }}" method="POST">
        @csrf

        <input type="hidden" name="id" value="{{ session('id') }}">

        <style>
            .section-two .short-input,
            .section-two .short-select {
                max-width: 200px;
                /* Lebar sesuai kebutuhan */
            }

            .section-two .form-inline {
                display: flex;
                flex-wrap: wrap;
                gap: 15px;
            }

            .section-two .form-group {
                flex: 1;
            }

            /* Flexbox untuk elemen-elemen input yang bersebelahan */
            .date-inputs {
                display: flex;
                justify-content: space-between;
            }

            .date-inputs .form-group {
                flex: 1;
                margin-right: 10px;
                /* Jarak antar input */
            }

            .date-inputs .form-group:last-child {
                margin-right: 0;
                /* Menghapus margin kanan pada elemen terakhir */
            }

            .short-input,
            .short-select {
                max-width: 200px;
                /* Lebar sesuai kebutuhan */
            }

            /* Flexbox untuk form-group dalam satu baris */
            .inline-group {
                display: flex;
                justify-content: space-between;
            }

            .inline-group .form-group {
                flex: 1;
                margin-right: 10px;
                /* Jarak antar elemen */
            }

            .inline-group .form-group:last-child {
                margin-right: 0;
                /* Menghapus margin kanan pada elemen terakhir */
            }

            .inline-group .form-control {
                width: 100%;
                /* Memastikan input mengambil seluruh lebar yang tersedia */
            }

            .short-input,
            .short-select {
                max-width: 100%;
                /* Menghilangkan batasan lebar untuk elemen dalam inline-group */
            }
        </style>

        <div class="form-group">
            <label for="type">Type</label>
            <select name="type" id="type" class="form-control" required>
                <option value="">Pilih Tipe</option>
                <option value="domestik">Domestik</option>
                <option value="international">Internasional</option>
            </select>
        </div>

        <div class="inline-group">
            <div class="form-group">
                <label for="company">BUYER</label>
                <select name="company_id" id="company" class="form-control" required>
                    <option value="">Pilih BUYER</option>
                </select>
            </div>

            <div class="form-group">
                <label for="dt">DESTINATION</label>
                <input type="text" class="form-control" id="dt" name="dt" required>
            </div>
        </div>





        <div class="form-group">
            <label for="mv">MV</label>
            <input type="text" class="form-control" id="mv" name="mv">
        </div>

        <div class="form-group">
            <label for="bg">Barge</label>
            <input type="text" class="form-control" id="bg" name="bg">
        </div>


        <div class="form-group">
            <label for="sv">SURVEYOR</label>
            <select class="form-control" id="sv" name="sv" required>
                <option value="">Pilih SURVEYOR</option>
                @foreach($surveyors as $surveyor)
                <option value="{{ $surveyor->name }}">{{ $surveyor->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="date-inputs">
            <div class="form-group">
                <label for="arrival_date">Commance</label>
                <input type="date" class="form-control" id="arrival_date" name="arrival_date" required>
            </div>

            <div class="form-group">
                <label for="departure_date">Completed</label>
                <input type="date" class="form-control" id="departure_date" name="departure_date" required>
            </div>
        </div>

        <div class="form-group">
            <label for="tg">B/L</label>
            <input type="text" class="form-control" id="tg" name="tg" required readonly>
        </div>

        <div class="form-group">
            <label for="gar">GAR</label>
            <select class="form-control" id="gar" name="gar" required>
                <option value="3400">3400</option>
                <option value="3800">3800</option>
                <option value="4200">4200</option>
                <option value="5600">5600</option>
                <option value="6400">6400</option>
            </select>
        </div>

        <div class="section-two">
            <div class="form-inline">
                <div class="form-group">
                    <label for="sp">STOWAGE PLAN</label>
                    <input type="text" class="form-control form-control-sm short-input" id="sp" name="sp" required>
                </div>
                <div class="form-group">
                    <label for="fv">FIGURE VESSEL</label>
                    <input type="text" class="form-control form-control-sm short-input" id="fv" name="fv" required>
                </div>
                <div class="form-group">
                    <label for="fd">FINAL DRAFT</label>
                    <input type="text" class="form-control form-control-sm short-input" id="fd" name="fd" required>
                </div>
                <div class="form-group">
                    <label for="bf">BARGE FIGURE</label>
                    <input type="text" class="form-control form-control-sm short-input" id="bf" name="bf" required>
                </div>
                <div class="form-group">
                    <label for="rc">R/C BARGE</label>
                    <input type="text" class="form-control form-control-sm short-input" id="rc" name="rc" required>
                </div>
                <div class="form-group">
                    <label for="ss">SHORTAGE/SURPLUS</label>
                    <input type="text" class="form-control form-control-sm short-input" id="ss" name="ss" required>
                </div>
            </div>
        </div>



        <div class="form-group">
            <label for="cargo">Cargo</label>
            <select class="form-control" id="cargo" name="cargo" required>
                <option value="Block 2">Block 2</option>
                <option value="Block 3">Block 3</option>
                <option value="Block 4">Block 4</option>
            </select>
        </div>


        <div style="margin-top: 10px;">
            <button type="submit" class="btn btn-primary">Lanjutkan</button>
            <a href="{{ route('activities.show', ['id' => $activity->id]) }}" class="btn btn-secondary">Batal</a>
        </div>

    </form>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#type').change(function() {
            var type = $(this).val();

            // Mengisi daftar perusahaan sesuai dengan tipe
            var companySelect = $('#company');
            companySelect.empty();
            companySelect.append('<option value="">Pilih BUYER</option>');

            //
            if (type) {
                $.ajax({
                    url: "{{ route('shipments.getCompanies') }}",
                    type: 'GET',
                    data: {
                        type: type
                    },
                    dataType: 'json',
                    success: function(companies) {
                        if (companies.error) {
                            console.error(companies.error);
                        } else {
                            $.each(companies, function(index, companyName) {
                                companySelect.append('<option value="' + index + '">' + companyName + '</option>');
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Request failed with status: ' + xhr.status + ', Error: ' + error);
                    }
                });
            }
        });

        // Update B/L field based on departure_date
        $('#departure_date').change(function() {
            var selectedDate = $(this).val();
            $('#tg').val(selectedDate);
        });
    });
</script>
@endsection