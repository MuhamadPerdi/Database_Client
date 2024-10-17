@extends('layouts.apps')

@section('title', 'Monitoring')

@section('header', 'Monitoring')

@section('breadcrumb')
<div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
<div class="breadcrumb-item">Monitoring</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
<div class="card">
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    @if(Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
        </div>
    @endif
    <div class="card-body">
        <div style="float: left">
            <h3 class="card-title">Monitoring</h3>
          </div>
        <div style="float: right;">
            <a href="{{ route('monitorings.create') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i> Tambah
            </a>
        </div>
        <div style="float: right; margin-right: 10px;">
          <a href="{{ route('monitoring.export.csv') }}" class="btn btn-info mb-3">
              <i class="fas fa-file-csv"></i> Export CSV
          </a>
      </div>

        <div style="float: right; margin-right: 10px;">
          <a href="{{ route('monitoring.export.excel') }}" class="btn btn-success mb-3">
              <i class="fas fa-file-excel"></i> Export Excel
          </a>
      </div>
          <div class="table-responsive">
            <table class="table table-bordered" id="table">
              <thead>
                <tr>
                  <th>No</th>
                                <th>Nama Client</th>
                                <th>Projek</th>
                                <th>Bidang</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Domain</th>
                                <th>Keterangan</th>
                                <th width="280px">Action</th>
                </tr>
              </thead>
              <tbody>
                @php
                $iteration = 1; // Mulai nomor urut dari 1
            @endphp
            
            @foreach ($monitorings as $key => $monitoring)
                <tr>
                  <td>{{ $key +1 }}</td>
                  <td>{{ $monitoring->name }}</td>
                  <td>{{ $monitoring->projek->name }}</td>
                  <td>{{ $monitoring->bidang }}</td>
                  <td>{{ \Carbon\Carbon::parse($monitoring->mulai)->isoFormat('D MMMM Y') }}</td>
                  <td>{{ \Carbon\Carbon::parse($monitoring->selesai)->isoFormat('D MMMM Y') }}</td>
                  <td>{{ $monitoring->domain }}</td>
                  <td> 
                    @if($monitoring->keterangan->name == 'Belum Selesai')
                    <span class="badge badge-pill badge-danger ">{{ $monitoring->keterangan->name }}</span>
                @elseif($monitoring->keterangan->name == 'Selesai')
                <span class="badge badge-pill badge-success ">{{ $monitoring->keterangan->name }}</span>
                @endif
            </td>
                  <td class="align-middle">
                    <a href="{{ route('monitorings.edit', $monitoring->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <button onclick="confirmDelete('{{ route('monitorings.destroy', $monitoring->id) }}')" class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i> Hapus
                    </button>
                </td>
                
                </tr>
                @php
                    $iteration++; // Tingkatkan nomor urut
                @endphp
            @endforeach
            
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('scripts')

<script src="{{ asset('assets/js/delete.js')}}"></script>
<script>

  $(document).ready(function() {
      $('#table').DataTable();
  });
</script>

 
 

 



</script>
@endpush
