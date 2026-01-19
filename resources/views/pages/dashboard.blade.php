@extends('layouts.master')
@section('title', 'DASHBOARD')
@section('page-title', 'DASHBOARD')
@section('breadcrumb', 'DASHBOARD')

@section('content')
    {{-- Top Summary Cards --}}
    <div class="row g-4 mb-8">
        <div class="col-12 col-sm-6 col-lg-3">
            <a href="{{ route('mahasiswa.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100 dashboard-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="card-body p-5 d-flex flex-column justify-content-between">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <h6 class="text-white-50 fw-semibold mb-2" style="font-size: 0.875rem; letter-spacing: 0.5px;">TOTAL MAHASISWA</h6>
                                <h2 class="text-white fw-bold mb-0" style="font-size: 2.5rem; line-height: 1.2;">{{ number_format($data['totalMahasiswa']) }}</h2>
                            </div>
                            <div class="bg-white bg-opacity-20 rounded-circle p-3">
                                <i class="ki-duotone ki-people text-white" style="font-size: 2rem;">
                                    <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                                    <span class="path4"></span><span class="path5"></span>
                                </i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <a href="{{ route('mahasiswa.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100 dashboard-card" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                    <div class="card-body p-5 d-flex flex-column justify-content-between">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <h6 class="text-white-50 fw-semibold mb-2" style="font-size: 0.875rem; letter-spacing: 0.5px;">MAHASISWA AKTIF</h6>
                                <h2 class="text-white fw-bold mb-0" style="font-size: 2.5rem; line-height: 1.2;">{{ number_format($data['mahasiswaAktif']) }}</h2>
                            </div>
                            <div class="bg-white bg-opacity-20 rounded-circle p-3">
                                <i class="ki-duotone ki-check-circle text-white" style="font-size: 2rem;">
                                    <span class="path1"></span><span class="path2"></span>
                                </i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <a href="{{ route('alumni.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100 dashboard-card" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
                    <div class="card-body p-5 d-flex flex-column justify-content-between">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <h6 class="text-white-50 fw-semibold mb-2" style="font-size: 0.875rem; letter-spacing: 0.5px;">LULUS</h6>
                                <h2 class="text-white fw-bold mb-0" style="font-size: 2.5rem; line-height: 1.2;">{{ number_format($data['mahasiswaLulus']) }}</h2>
                            </div>
                            <div class="bg-white bg-opacity-20 rounded-circle p-3">
                                <i class="ki-duotone ki-medal text-white" style="font-size: 2rem;">
                                    <span class="path1"></span><span class="path2"></span>
                                </i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <a href="{{ route('mahasiswa.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100 dashboard-card" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                    <div class="card-body p-5 d-flex flex-column justify-content-between">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <h6 class="text-white-50 fw-semibold mb-2" style="font-size: 0.875rem; letter-spacing: 0.5px;">CUTI / MENGUNDURKAN DIRI</h6>
                                <h2 class="text-white fw-bold mb-0" style="font-size: 2.5rem; line-height: 1.2;">{{ number_format($data['mahasiswaCutiMengundurkan']) }}</h2>
                            </div>
                            <div class="bg-white bg-opacity-20 rounded-circle p-3">
                                <i class="ki-duotone ki-pause-circle text-white" style="font-size: 2rem;">
                                    <span class="path1"></span><span class="path2"></span>
                                </i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    {{-- Academic Progress Visualization --}}
    <div class="row g-4 mb-8">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header border-0 bg-white pt-6">
                    <h3 class="card-title fw-bold text-gray-800 mb-0">Progress Akademik Mahasiswa Aktif</h3>
                    <p class="text-muted mb-0 mt-2" style="font-size: 0.875rem;">Tingkat penyelesaian Prakerin, Seminar, dan Sidang</p>
                </div>
                <div class="card-body p-6">
                    <div class="row g-4">
                        {{-- Prakerin Progress --}}
                        <div class="col-12 col-md-4">
                            <div class="d-flex flex-column h-100">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="fw-semibold text-gray-700 mb-0">Prakerin</h5>
                                    <span class="badge badge-light-primary fs-6">
                                        @php
                                            $totalPrakerin = $data['prakerinSudah'] + $data['prakerinBelum'];
                                            $percentPrakerin = $totalPrakerin > 0 ? round(($data['prakerinSudah'] / $totalPrakerin) * 100) : 0;
                                        @endphp
                                        {{ $percentPrakerin }}%
                                    </span>
                                </div>
                                <div class="progress mb-3" style="height: 12px; border-radius: 6px;">
                                    <div class="progress-bar bg-primary" role="progressbar" 
                                         style="width: {{ $percentPrakerin }}%; border-radius: 6px;" 
                                         aria-valuenow="{{ $percentPrakerin }}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex justify-content-between text-muted" style="font-size: 0.875rem;">
                                    <span><i class="ki-duotone ki-check-circle text-success me-1"><span class="path1"></span><span class="path2"></span></i> Sudah: {{ $data['prakerinSudah'] }}</span>
                                    <span><i class="ki-duotone ki-clock text-warning me-1"><span class="path1"></span><span class="path2"></span></i> Belum: {{ $data['prakerinBelum'] }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Seminar Progress --}}
                        <div class="col-12 col-md-4">
                            <div class="d-flex flex-column h-100">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="fw-semibold text-gray-700 mb-0">Seminar</h5>
                                    <span class="badge badge-light-info fs-6">
                                        @php
                                            $totalSeminar = $data['seminarSudah'] + $data['seminarBelum'];
                                            $percentSeminar = $totalSeminar > 0 ? round(($data['seminarSudah'] / $totalSeminar) * 100) : 0;
                                        @endphp
                                        {{ $percentSeminar }}%
                                    </span>
                                </div>
                                <div class="progress mb-3" style="height: 12px; border-radius: 6px;">
                                    <div class="progress-bar bg-info" role="progressbar" 
                                         style="width: {{ $percentSeminar }}%; border-radius: 6px;" 
                                         aria-valuenow="{{ $percentSeminar }}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex justify-content-between text-muted" style="font-size: 0.875rem;">
                                    <span><i class="ki-duotone ki-check-circle text-success me-1"><span class="path1"></span><span class="path2"></span></i> Sudah: {{ $data['seminarSudah'] }}</span>
                                    <span><i class="ki-duotone ki-clock text-warning me-1"><span class="path1"></span><span class="path2"></span></i> Belum: {{ $data['seminarBelum'] }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Sidang Progress --}}
                        <div class="col-12 col-md-4">
                            <div class="d-flex flex-column h-100">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="fw-semibold text-gray-700 mb-0">Sidang</h5>
                                    <span class="badge badge-light-success fs-6">
                                        @php
                                            $totalSidang = $data['sidangSudah'] + $data['sidangBelum'];
                                            $percentSidang = $totalSidang > 0 ? round(($data['sidangSudah'] / $totalSidang) * 100) : 0;
                                        @endphp
                                        {{ $percentSidang }}%
                                    </span>
                                </div>
                                <div class="progress mb-3" style="height: 12px; border-radius: 6px;">
                                    <div class="progress-bar bg-success" role="progressbar" 
                                         style="width: {{ $percentSidang }}%; border-radius: 6px;" 
                                         aria-valuenow="{{ $percentSidang }}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex justify-content-between text-muted" style="font-size: 0.875rem;">
                                    <span><i class="ki-duotone ki-check-circle text-success me-1"><span class="path1"></span><span class="path2"></span></i> Sudah: {{ $data['sidangSudah'] }}</span>
                                    <span><i class="ki-duotone ki-clock text-warning me-1"><span class="path1"></span><span class="path2"></span></i> Belum: {{ $data['sidangBelum'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Alumni Employment Overview & Job vs Major Comparison --}}
    <div class="row g-4 mb-8">
        {{-- Alumni Employment Pie Chart --}}
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header border-0 bg-white pt-6">
                    <h3 class="card-title fw-bold text-gray-800 mb-0">Status Pekerjaan Alumni</h3>
                    <p class="text-muted mb-0 mt-2" style="font-size: 0.875rem;">Distribusi status pekerjaan alumni</p>
                </div>
                <div class="card-body p-6">
                    <div id="alumni_employment_chart" style="height: 300px; width: 100%;"></div>
                    <div class="mt-4 d-flex flex-wrap justify-content-center gap-4">
                        @php
                            $totalAlumniEmployment = $data['alumniBekerja'] + $data['alumniBelumBekerja'] + $data['alumniTidakBekerja'];
                            $percentBekerja = $totalAlumniEmployment > 0 ? round(($data['alumniBekerja'] / $totalAlumniEmployment) * 100) : 0;
                            $percentBelumBekerja = $totalAlumniEmployment > 0 ? round(($data['alumniBelumBekerja'] / $totalAlumniEmployment) * 100) : 0;
                            $percentTidakBekerja = $totalAlumniEmployment > 0 ? round(($data['alumniTidakBekerja'] / $totalAlumniEmployment) * 100) : 0;
                        @endphp
                        <div class="text-center">
                            <div class="fw-bold text-gray-800" style="font-size: 1.5rem;">{{ $percentBekerja }}%</div>
                            <div class="text-muted" style="font-size: 0.875rem;">Bekerja ({{ $data['alumniBekerja'] }})</div>
                        </div>
                        <div class="text-center">
                            <div class="fw-bold text-gray-800" style="font-size: 1.5rem;">{{ $percentBelumBekerja }}%</div>
                            <div class="text-muted" style="font-size: 0.875rem;">Belum Bekerja ({{ $data['alumniBelumBekerja'] }})</div>
                        </div>
                        <div class="text-center">
                            <div class="fw-bold text-gray-800" style="font-size: 1.5rem;">{{ $percentTidakBekerja }}%</div>
                            <div class="text-muted" style="font-size: 0.875rem;">Tidak Bekerja ({{ $data['alumniTidakBekerja'] }})</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Job vs Major Comparison --}}
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header border-0 bg-white pt-6">
                    <h3 class="card-title fw-bold text-gray-800 mb-0">Pekerjaan vs Jurusan</h3>
                    <p class="text-muted mb-0 mt-2" style="font-size: 0.875rem;">Perbandingan pekerjaan sesuai jurusan</p>
                </div>
                <div class="card-body p-6">
                    <div id="job_major_chart" style="height: 300px; width: 100%;"></div>
                    <div class="mt-4 d-flex flex-wrap justify-content-center gap-4">
                        @php
                            $totalWorking = $data['alumniSesuaiJurusan'] + $data['alumniTidakSesuaiJurusan'];
                            $percentSesuai = $totalWorking > 0 ? round(($data['alumniSesuaiJurusan'] / $totalWorking) * 100) : 0;
                            $percentTidakSesuai = $totalWorking > 0 ? round(($data['alumniTidakSesuaiJurusan'] / $totalWorking) * 100) : 0;
                        @endphp
                        <div class="text-center">
                            <div class="fw-bold text-success" style="font-size: 1.5rem;">{{ $percentSesuai }}%</div>
                            <div class="text-muted" style="font-size: 0.875rem;">Sesuai Jurusan ({{ $data['alumniSesuaiJurusan'] }})</div>
                        </div>
                        <div class="text-center">
                            <div class="fw-bold text-warning" style="font-size: 1.5rem;">{{ $percentTidakSesuai }}%</div>
                            <div class="text-muted" style="font-size: 0.875rem;">Tidak Sesuai ({{ $data['alumniTidakSesuaiJurusan'] }})</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .dashboard-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            cursor: pointer;
        }
        .dashboard-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
        }
        @media (max-width: 768px) {
            .dashboard-card h2 {
                font-size: 2rem !important;
            }
            .dashboard-card .card-body {
                padding: 1.5rem !important;
            }
        }
    </style>
@endsection

@push('addon-script')
    <script src="//www.google.com/jsapi"></script>
    <script>
        google.load('visualization', '1', {
            packages: ['corechart']
        });

        google.setOnLoadCallback(function() {
            // Alumni Employment Chart (Donut)
            var employmentData = new google.visualization.DataTable();
            employmentData.addColumn('string', 'Status');
            employmentData.addColumn('number', 'Jumlah');
            employmentData.addRows([
                ['Bekerja', {{ $data['alumniBekerja'] }}],
                ['Belum Bekerja', {{ $data['alumniBelumBekerja'] }}],
                ['Tidak Bekerja', {{ $data['alumniTidakBekerja'] }}]
            ]);

            var employmentOptions = {
                pieHole: 0.5,
                colors: ['#10b981', '#3b82f6', '#f59e0b'],
                chartArea: { left: 20, top: 20, width: '80%', height: '80%' },
                legend: { position: 'bottom', textStyle: { fontSize: 12 } },
                tooltip: { textStyle: { fontSize: 12 } }
            };

            var employmentChart = new google.visualization.PieChart(document.getElementById('alumni_employment_chart'));
            employmentChart.draw(employmentData, employmentOptions);

            // Job vs Major Chart (Bar)
            var jobMajorData = new google.visualization.DataTable();
            jobMajorData.addColumn('string', 'Status');
            jobMajorData.addColumn('number', 'Jumlah');
            jobMajorData.addRows([
                ['Sesuai Jurusan', {{ $data['alumniSesuaiJurusan'] }}],
                ['Tidak Sesuai', {{ $data['alumniTidakSesuaiJurusan'] }}]
            ]);

            var jobMajorOptions = {
                colors: ['#10b981', '#f59e0b'],
                chartArea: { left: 60, top: 20, width: '75%', height: '75%' },
                legend: { position: 'none' },
                hAxis: { textStyle: { fontSize: 12 } },
                vAxis: { textStyle: { fontSize: 12 } },
                tooltip: { textStyle: { fontSize: 12 } }
            };

            var jobMajorChart = new google.visualization.ColumnChart(document.getElementById('job_major_chart'));
            jobMajorChart.draw(jobMajorData, jobMajorOptions);

            // Responsive charts
            window.addEventListener('resize', function() {
                employmentChart.draw(employmentData, employmentOptions);
                jobMajorChart.draw(jobMajorData, jobMajorOptions);
            });
        });
    </script>
@endpush
