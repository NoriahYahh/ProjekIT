@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">BUYER Domestik</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('domestic_companies.index') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">BUYER Export</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('international_companies.index') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Surveyor</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('surveyors.index') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">Danger Card</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('domestic_companies.index') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Shipments Table -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Shipments
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <h1>Shipments</h1>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>GAR</th>
                        <th>E/D</th>
                        <th>BUYER</th>
                        <th>MV</th>
                        <th>BG</th>
                        <th>Arrival Date</th>
                        <th>Departure Date</th>
                        <th>Duration (days)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shipments as $shipment)
                    <tr>
                        <td>{{ $shipment->gar }}</td>
                        <td>{{ $shipment->type }}</td>
                        <td>{{ $shipment->company ? $shipment->company->name : 'N/A' }}</td>
                        <td>{{ $shipment->mv ? $shipment->mv : '-' }}</td>
                        <td>{{ $shipment->bg ? $shipment->bg : '-' }}</td>
                        <td>{{ $shipment->arrival_date }}</td>
                        <td>{{ $shipment->departure_date }}</td>
                        <td>{{ $shipment->duration }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Existing Charts -->
    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Chart GAR
                </div>
                <div class="card-body">
                    <canvas id="myAreaChart" width="100%" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Chart E/D
                </div>
                <div class="card-body">
                    <canvas id="myBarChart" width="100%" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Doughnut Charts -->
    <div class="row">
        <div class="col-xl-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-pie me-1"></i>
                    Doughnut Chart Untuk BUYER
                </div>
                <div class="card-body">
                    <canvas id="myDoughnutChart1" width="100%" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-pie me-1"></i>
                    Doughnut Chart SURVEYOR
                </div>
                <div class="card-body">
                    <canvas id="myDoughnutChart2" width="100%" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-pie me-1"></i>
                    Doughnut Chart 3
                </div>
                <div class="card-body">
                    <canvas id="myDoughnutChart3" width="100%" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Menambahkan Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Chart untuk Area GAR
        var ctxArea = document.getElementById('myAreaChart').getContext('2d');
        var myAreaChart = new Chart(ctxArea, {
            type: 'line', // Jenis chart area
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Monthly Sales',
                    data: [12, 19, 3, 5, 2, 3, 7],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                maintainAspectRatio: false // Menjaga proporsi agar sesuai dengan ukuran canvas
            }
        });

        // Chart untuk Bar E/D
        var ctxBar = document.getElementById('myBarChart').getContext('2d');
        var myBarChart = new Chart(ctxBar, {
            type: 'bar', // Jenis chart bar
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Monthly Sales',
                    data: [12, 19, 3, 5, 2, 3, 7],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                maintainAspectRatio: false // Menjaga proporsi agar sesuai dengan ukuran canvas
            }
        });

        // Doughnut Chart 1
        var ctxDoughnut1 = document.getElementById('myDoughnutChart1').getContext('2d');
        var myDoughnutChart1 = new Chart(ctxDoughnut1, {
            type: 'doughnut',
            data: {
                labels: ['Red', 'Blue', 'Yellow'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false // Menjaga proporsi agar sesuai dengan ukuran canvas
            }
        });

        // Doughnut Chart 2
        var ctxDoughnut2 = document.getElementById('myDoughnutChart2').getContext('2d');
        var myDoughnutChart2 = new Chart(ctxDoughnut2, {
            type: 'doughnut',
            data: {
                labels: ['Red', 'Blue', 'Yellow'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false // Menjaga proporsi agar sesuai dengan ukuran canvas
            }
        });

        // Doughnut Chart 3
        var ctxDoughnut3 = document.getElementById('myDoughnutChart3').getContext('2d');
        var myDoughnutChart3 = new Chart(ctxDoughnut3, {
            type: 'doughnut',
            data: {
                labels: ['Red', 'Blue', 'Yellow'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false // Menjaga proporsi agar sesuai dengan ukuran canvas
            }
        });
    });
</script>
@endsection
