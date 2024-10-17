@extends('layouts.apps')

@section('title', 'Clients')

@section('header', 'Clients')
@section('breadcrumb')
<div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
<div class="breadcrumb-item">Client</div>
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
              <h6 class="card-title">Monitoring</h6>
          </div>
        
          <div style="float: right;">
              <a href="{{ route('clients.create') }}" class="btn btn-primary mb-3">
                  <i class="fas fa-plus"></i> Tambah
              </a>
          </div>
          <div style="float: right; margin-right: 10px;">
            <a href="{{ route('client.export.csv') }}" class="btn btn-info mb-3">
                <i class="fas fa-file-csv"></i> Export CSV
            </a>
        </div>

          <div style="float: right; margin-right: 10px;">
            <a href="{{ route('client.export.excel') }}" class="btn btn-success mb-3">
                <i class="fas fa-file-excel"></i> Export Excel
            </a>
        </div>
          <div class="table-responsive">
            <table class="table table-bordered" id="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Client</th>
                  <th>Tanggal</th>
                  <th>Jenis</th>
                  <th>Kebutuhan</th>
                  <th>No Telp</th>
                  <th>Alamat</th>
                  <th>Sumber</th>
                  <th>Keterangan</th>
                  <th>Status</th>
                  <th width="280px">Action</th>
                </tr>
              </thead>
              <tbody>
                @if ($clients->count())
                @foreach ($clients as $key => $client)
                <tr>
                    <td class="align-middle">{{ $key + 1 }}</td>
                    <td class="align-middle">{{ $client->name }}</td>
                    <td class="align-middle">{{ \Carbon\Carbon::parse($client->tanggal)->isoFormat('D MMMM Y') }}</td>
                    <td class="align-middle">{{ $client->jenis->jenis }}</td>
                    <td class="align-middle">{{ $client->kebutuhan }}</td>
                    <td class="align-middle">{{ $client->no_telp }}</td>
                    <td class="align-middle">{{ $client->alamat }}</td>
                    <td class="align-middle">{{ $client->sumber }}</td>
                    <td class="align-middle">{{ $client->keterangan }}</td>
                    
                    <td class="align-middle"> 
                      @if($client->status->status == 'Belum Selesai')
                      <span class="badge badge-pill badge-danger ">{{ $client->status->status }}</span>
                  @elseif($client->status->status == 'Selesai')
                  <span class="badge badge-pill badge-success ">{{ $client->status->status }}</span>
                  @elseif($client->status->status == 'Progress')
                  <span class="badge badge-pill badge-warning ">{{ $client->status->status }}</span>
                  @endif
              </td>
                    <td class="align-middle">
                        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button onclick="confirmDelete('{{ route('clients.destroy', $client->id) }}')" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </td>
                </tr>
            @endforeach
            @else
            
      @endif
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
@endpush
