@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
    <h4 class="fw-bold mb-4">Dashboard</h4>

    <div class="row g-3 mb-4">


        <div class="col-md-3 col-sm-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">

                    <div class="p-3">
                        <i class="bi bi-people-fill fs-4 text-danger"></i>
                    </div>

                    <div>
                        <div class="small text-muted">Total Users</div>
                        <div class="fs-4 fw-bold text-danger">{{ $totalUsers }}</div>
                    </div>

                </div>
            </div>
        </div>


        <div class="col-md-3 col-sm-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">

                    <div class="p-3">
                        <i class="bi bi-journal-text fs-4 text-dark"></i>
                    </div>

                    <div>
                        <div class="small text-muted">Total Students</div>
                        <div class="fs-4 fw-bold text-dark">{{ $totalStudents }}</div>
                    </div>

                </div>
            </div>
        </div>


        <div class="col-md-3 col-sm-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">

                    <div class="p-3">
                        <i class="bi bi-gender-male fs-4 text-primary"></i>
                    </div>

                    <div>
                        <div class="small text-muted">Male Students</div>
                        <div class="fs-4 fw-bold text-primary">{{ $maleStudents }}</div>
                    </div>

                </div>
            </div>
        </div>


        <div class="col-md-3 col-sm-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">

                    <div class="p-3">
                        <i class="bi bi-gender-female fs-4 text-danger"></i>
                    </div>

                    <div>
                        <div class="small text-muted">Female Students</div>
                        <div class="fs-4 fw-bold text-danger">{{ $femaleStudents }}</div>
                    </div>

                </div>
            </div>
        </div>

    </div>


    <div class="row g-3">

        <div class="col-lg-6 col-md-12">
            <div class="card border-0 shadow-sm p-3 h-100">
                <h6 class="fw-bold mb-3">Students by Program</h6>
                <div style="height:260px">
                    <canvas id="programChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12">
            <div class="card border-0 shadow-sm p-3 h-100">
                <h6 class="fw-bold mb-3">Students by Gender</h6>
                <div style="height:260px">
                    <canvas id="genderChart"></canvas>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
       new Chart(document.getElementById('programChart'), {
            type: 'line',
            data: {
                labels: @json($studentsByProgram->keys()->values()),
                datasets: [{
                    label: 'Students',
                    data: @json($studentsByProgram->values()),
                    borderColor: '#1d4ed8',
                    backgroundColor: 'rgba(29, 78, 216, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#1d4ed8',
                    pointBorderColor: '#fff',
                    pointRadius: 5,
                    pointHoverRadius: 7,
                }]
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });

        new Chart(document.getElementById('genderChart'), {
            type: 'pie',
            data: {
                labels: ['Male', 'Female'],
                datasets: [{
                    data: [{{ $maleStudents }}, {{ $femaleStudents }}],
                    backgroundColor: ['#1d4ed8', '#be185d'],
                }]
            },
            options: {
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 } } } }
            }
        });
    </script>
@endpush