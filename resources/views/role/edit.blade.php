@extends('layouts.apps')
@section('title', 'Edit Role')
@section('header', 'Edit Role')
@section('content')
    <div class="row">
        <!-- Form Perbarui Fitur -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Role</h3>
                </div>
                <form class="_form" action="{{ route('fitur.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">
                        <div class="form-group col-md-12">
                            <label for="role_name">Nama Role:</label>
                            <input type="text" name="role_name" id="role_name" class="form-control" value="{{ $role->name }}" required>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Otoritas Fitur Master Admin</h3>
                            </div>
                            <div class="card-body row">
                                @foreach($featuresMasterAdmin as $feature)
                                    <div class="form-group col-md-4">
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" name="permissions[]" value="{{ $feature->id }}" class="form-check-input" id="feature-{{ $feature->id }}_admin" {{ in_array($feature->id, $rolePermissions) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="feature-{{ $feature->id }}_admin">{{ $feature->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Otoritas Fitur Lainnya</h3>
                            </div>
                            <div class="card-body row">
                                @foreach($featuresLainnya as $feature)
                                    <div class="form-group col-md-4">
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" name="permissions[]" value="{{ $feature->id }}" class="form-check-input" id="feature-{{ $feature->id }}_lainnya" {{ in_array($feature->id, $rolePermissions) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="feature-{{ $feature->id }}_lainnya">{{ $feature->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Perbarui Fitur</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Form Hapus Role -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Hapus Role</h3>
                </div>
                <form action="{{ route('fitur.destroy', $role->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus role dan fitur ini?');">
                    @csrf
                    @method('DELETE')
                    <div class="card-body text-center">
                        <button type="submit" class="btn btn-danger">Hapus Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

