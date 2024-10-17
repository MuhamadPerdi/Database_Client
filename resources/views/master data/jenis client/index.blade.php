@extends('layouts.apps')
@section('title', 'Jenis Client')

@section('header', 'Jenis Client')

@section('breadcrumb')
<div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
<div class="breadcrumb-item">Jenis Client</div>
@endsection
@section('content')
<div class="container">
    <h3>Jenis Client</h3>
    <a href="{{ route('jenis.create') }}" class="btn btn-primary mb-3">Add New Jenis</a>

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
            @foreach($jenisOptions as $key => $jenis)
                <tr>
                    <td class="align-middle">{{ $key + 1 }}</td>
                    <td class="align-middle">{{ $jenis->jenis }}</td>
                   <td class="align-middle"> {{ $jenis->client_count }} </td>
                    <td class="align-middle">
                        <a href="{{ route('jenis.edit', $jenis->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i>Edit</a>
                        <form action="{{ route('jenis.destroy', $jenis->id) }}" method="POST" style="display:inline;">
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
