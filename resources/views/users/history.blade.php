@extends('layouts.apps')

@section('title', 'Histori')

@section('header', 'Histori CRUD')
@section('breadcrumb')
<div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
<div class="breadcrumb-item">Histori</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Histori CRUD</h6>
                <div class="table-responsive">
                    <table class="table table-bordered" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                            <th>Aksi</th>
                            <th>Model</th>
                            <th>Nama Model</th>
                            <th>Nama Pengguna</th>
                            <th>Perubahan</th>
                            <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($history as $index => $item)
                                <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->action }}</td>
                            <td>{{ class_basename($item->model_type) }}</td>
                            <td>{{ $item->model_name }}</td>
                            <td>{{ $item->user_name }}</td>
                            <td>{{ $item->changes }}</td> <!-- Tampilkan perubahan -->
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('D MMMM Y, HH:mm') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')

<script>
  $(document).ready(function() {
      $('#table').DataTable();
  });
</script>
@endpush
