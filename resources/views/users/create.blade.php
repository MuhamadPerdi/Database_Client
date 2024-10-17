@extends('layouts.apps')

@section('title', 'Create User')

@section('breadcrumb')
<div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
<div class="breadcrumb-item active"><a href="{{route('users.index')}}">User Admin</a></div>
<div class="breadcrumb-item">Create User Admin</div>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3>Create User</h3>
      </div>
      <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <form class="_form" action="{{ route('users.store') }}" method="POST">
          @csrf
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="row">
          <div class="form-group col-md-6">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" required>
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group col-md-6">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group col-md-6">
            <label for="password">Password</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                    </span>
                </div>
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password">
            </div>
        </div>
        
          <div class="form-group col-md-6">
            <label for="password_confirmation">Confirm Password</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                    </span>
                </div>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Masukkan password sebelum nya">
            </div>
            <div class="invalid-feedback">
                Please confirm the password
            </div>
        </div>
          <div class="form-group col-md-6">
            <label for="roles">Roles</label>
            <select name="roles[]" id="roles" class="form-control" required>
                <option value="" disabled selected>Select Roles</option>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
            @error('roles')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
          </div>
          <button type="submit" class="btn btn-primary">Create</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')

<script>
    $(document).ready(function() {
        $('#roles').select2({
            placeholder: "Select roles",
            allowClear: true
        });
    });
    </script>
@endpush