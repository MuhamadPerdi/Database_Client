@extends('layouts.apps')

@section('title', 'Dashboard')

@section('header', 'Dashboard')

@section('content')
    <div class="row">
        @can('client')
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-database"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Client</h4>
                    </div>
                    <div class="card-body">
                        {{ $clientCount }}
                    </div>
                </div>
            </div>
        </div>
        @endcan
        @can('monitoring')
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Monitoring</h4>
                    </div>
                    <div class="card-body">
                        {{ $monitoringCount }}
                    </div>
                </div>
            </div>
        </div>
        @endcan
        @can('useradmin')
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-users"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total User</h4>
                </div>
                <div class="card-body">
                    {{ $userCount }}
                </div>
            </div>
        </div>
    </div>
    @endcan
</div>
<div class="row">
    @can('useradmin')
<div class="col-md-7">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Latest Monitoring Posts</h4>
            <a href="{{ route('monitorings.index') }}" class="btn btn-primary btn-sm">View All</a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Client</th>
                        <th>Projek</th>
                        <th>Selesai</th>
                        <th>Keterangan</th>
                        <th>Di Buat Oleh</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($latestMonitoring as $item)
                        <tr>
                            <td>{{ $item->name}}</td>
                            <td>{{ $item->projek->name}}</td>
                            <td>{{ \Carbon\Carbon::parse($item->selesai)->isoFormat('D MMMM Y') }}</td>
                            <td> 
                            @if($item->keterangan->name == 'Belum Selesai')
                            <span class="badge badge-pill badge-danger ">{{ $item->keterangan->name }}</span>
                        @elseif($item->keterangan->name == 'Selesai')
                        <span class="badge badge-pill badge-success ">{{ $item->keterangan->name }}</span>
                        @endif
                    </td>
                            <td>{{$item->user?->name ?? 'Unknown '}}</td>
                            
                            {{-- <td>{{ $item->}}</td> --}}
                            {{-- <td>
                                <form action="{{ route('client.destroy') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endcan
<div class="col-md-5">
    <div class="card">
        <div class="card-header">Jumlah Projek Monitoring</div>
        <div class="card-body">
            <canvas id="projekChart"></canvas>
        </div>
    </div>
</div>
</div>
<div class="row">
    @can('useradmin')
<div class="col-md-7">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Latest Client Posts</h4>
            <a href="{{ route('clients.index') }}" class="btn btn-primary btn-sm">View All</a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Client</th>
                        <th>Tanggal</th>
                        <th>Jenis</th>
                        <th>Status</th>
                        <th>Di Buat Oleh</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($latestClient as $item)
                        <tr>
                            <td>{{ $item->name}}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMMM Y') }}</td>
                            <td>{{ $item->jenis->jenis}}</td>
                            <td> 
                            @if($item->status->status == 'Belum Selesai')
                            <span class="badge badge-pill badge-danger ">{{ $item->status->status }}</span>
                        @elseif($item->status->status == 'Selesai')
                        <span class="badge badge-pill badge-success ">{{ $item->status->status }}</span>
                        @elseif($item->status->status == 'Progress')
                        <span class="badge badge-pill badge-warning ">{{ $item->status->status }}</span>
                        @endif
                    </td>
                            <td>{{$item->user?->name ?? 'Unknown '}}</td>
                            
                            {{-- <td>{{ $item->}}</td> --}}
                            {{-- <td>
                                <form action="{{ route('client.destroy') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endcan
<div class="col-md-5">
    <div class="card">
        <div class="card-header">Jumlah Jenis Client</div>
        <div class="card-body">
            <canvas id="clientTypeChart"></canvas>
        </div>
    </div>
</div>
</div>

    <div class="row">
        <!-- Chart for Client Counts by Type -->
           
      
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Jumlah Status Client</div>
                <div class="card-body">
                    <canvas id="clientStatusChart"></canvas>
                </div>
            </div>
        </div>


        <!-- Chart for Monitoring Counts by Keterangan -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Jumlah Keterangan Monitoring</div>
                <div class="card-body">
                    <canvas id="keteranganChart"></canvas>
                </div>
            </div>
        </div>
    </div>

   
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Client Counts by Type
        new Chart(document.getElementById('clientTypeChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: @json($jenisLabels),
                datasets: [{
                    label: 'Jumlah Jenis Client',
                    data: @json($jenisData),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Client Counts by Status
        new Chart(document.getElementById('clientStatusChart').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: @json($statusLabels),
                datasets: [{
                    label: 'Jumlah Status Client',
                    data: @json($statusData),
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });

        // Monitoring Counts by Projek
        new Chart(document.getElementById('projekChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: @json($projekLabels),
                datasets: [{
                    label: 'Jumlah Projek Monitoring',
                    data: @json($projekData),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Monitoring Counts by Keterangan
        new Chart(document.getElementById('keteranganChart').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: @json($keteranganLabels),
                datasets: [{
                    label: 'Jumlah Keterangan Monitoring ',
                    data: @json($keteranganData),
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
    });
    </script>
@endpush
