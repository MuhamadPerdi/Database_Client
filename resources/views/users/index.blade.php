@extends('layouts.apps')

@section('title', 'User Admin')
@section('header', 'User Admin')

@section('breadcrumb')
 <div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
 <div class="breadcrumb-item">User Admin</div>
@endsection

@section('content')
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true"></span>
  </button>
</div>
@endif

<div class="row">
  <div class="col-md-2 col-12 mb-3">
    <a href="{{ route('users.create') }}" class="btn btn-primary waves-effect waves-light">
      <i class="fas fa-plus" aria-hidden="true"></i>Tambah
    </a>
  </div>
  <div class="col-md-10 col-12 mb-3">
    <form method="get">
      <div class="card">
        <div class="card-header">
          <i class="fas fa-search" aria-hidden="true"></i> Pencarian
        </div>
        <div class="card-body">
          <div class="row">
            <div class="form-group col-md-4">
              <label>ID USER</label>
              <input type="text" name="id" placeholder="Masukan id user" class="form-control">
            </div>
            <div class="form-group col-md-4">
              <label>Nama</label>
              <input type="text" name="name" placeholder="Masukan nama user" class="form-control">
            </div>
            <div class="form-group col-md-4">
              <label>Otoritas Fitur</label>
              <input type="text" name="authorities" placeholder="Masukan otoritas fitur" class="form-control">
            </div>
            <div class="form-group mb-0 col-md-6">
              <div class="form-check form-check-inline">
                <input type="checkbox" name="active" value="yes" class="form-check-input" id="active_label" checked="">
                <label class="form-check-label" for="active_label">User yang aktif</label>
              </div>
            </div>
            <div class="col-md-12 pt-3">
              {{-- <a href="{{ route('users.index') }}" class="btn btn-danger">Hapus Pencarian</a> --}}
              <button type="submit" class="btn btn-info float-right">Cari Data</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
  <div class="col-12 mb-3">
    <div class="card">
      <div class="card-body p-0 table-responsive">
        <table class="table">
          <thead class="table-light bordered">
            <tr>
              <th style="width: 10px">No</th>
              <th>Nama</th>
              <th>Otoritas Fitur</th>
              <th>Email</th>
              <th style="width: 300px">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>
                <code class="mr-1" style="font-size:100%">#{{ $user->id }}</code>
                <span>{{ $user->name }}</span>
              </td>
              <td>{{ implode(', ', $user->getRoleNames()->toArray()) }}</td>
              <td>{{ $user->email }}</td>
              <td>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info waves-effect waves-light btn-sm">
                  <i class="fas fa-pencil-alt" aria-hidden="true"></i> Ubah
                </a>
                <form action="{{ route('users.updateStatus', $user->id) }}" method="POST" style="display: inline-block">
                  @csrf
                  @method('PATCH')
                  <button type="submit" class="btn btn-{{ $user->active ? 'danger' : 'success' }} btn-sm">
                    <i class="fas fa-{{ $user->active ? 'times' : 'check' }}" aria-hidden="true"></i> {{ $user->active ? 'Matikan' : 'Hidupkan' }}
                  </button>
                </form>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                    <i class="fas fa-trash-alt mr-1" aria-hidden="true"></i> Hapus
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $users->links() }}
      </div>
    </div>
  </div>
</div>
@endsection
