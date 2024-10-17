@extends('layouts.apps')
@section('title', 'Status Client')

@section('header', 'Status Client')

@section('breadcrumb')
<div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
<div class="breadcrumb-item">Status Client</div>
@endsection
@section('content')
<div class="container">
    <h3>Status Client</h3>
    <a href="{{ route('status.create') }}" class="btn btn-primary mb-3">Add New Status</a>

    <table class="table table-bordered" id="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Jumlah Data</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($status as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->status }}</td>
                    <td> {{ $item->client_count }}</td>
                    <td>
                        <a href="{{ route('status.edit', $item->id) }}" class="btn btn-warning btn-sm"> <i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('status.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">  <i class="fas fa-trash-alt"></i> Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
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
