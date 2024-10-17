@extends('layouts.apps')
@section('title', 'Projek Monitoring')

@section('header', 'Projek Monitoring')

@section('breadcrumb')
<div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
<div class="breadcrumb-item">Projek Monitoring</div>
@endsection
@section('content')
<div class="container">
    <h3>Projek Monitoring</h3>
    <a href="{{ route('projek.create') }}" class="btn btn-primary mb-3">Add New Projek</a>

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
            @foreach($projek as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td> {{ $item->monitoring_count }}</td>
                    <td>
                        <a href="{{ route('projek.edit', $item->id) }}" class="btn btn-warning btn-sm"> <i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('projek.destroy', $item->id) }}" method="POST" style="display:inline;">
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
