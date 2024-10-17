@extends('layouts.apps')

@section('title', 'Daftar Role')
 @section('header', 'Daftar Role')
 @section('breadcrumb')
<div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
<div class="breadcrumb-item">Daftar Role</div>
 @endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div style="float: left">
                    <h6 class="card-title">Daftar Role</h6>
                  </div>
                <div style="float: right;">
                    <a href="{{ route('fitur.create') }}" class="btn btn-primary mb-3">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                </div>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
            <tr>
                <td>{{ $role->name }}</td>
                <td>
                    <a href="{{ route('fitur.edit', $role->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i>Edit</a>
                    <form action="{{ route('fitur.destroy', $role->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus role ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i>Hapus</button>
                    </form>
                </td>
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
