@extends('layouts.apps')
@section('title', 'Tambah Role')
 @section('header', 'Tambah Role')
@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Create Role</h3>
                </div>
                <div class="card-body">
    <form class="_form" action="{{ route('fitur.store') }}" method="POST">
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group ">
            <label for="role_name">Nama Role</label>
            <input type="text" class="form-control" id="role_name" name="role_name" required>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Otoritas Fitur Master Admin</h3>
            </div>
            <div class="card-body row">
                @foreach($featuresMasterAdmin as $feature)
                <div class="form-group mb-0 form-group col-md-4">
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="permissions[]" value="{{ $feature->name }}" class="form-check-input" id="feature-{{ $feature->id }}_label">
                        <label class="form-check-label" for="feature-{{ $feature->id }}_label">{{ $feature->name }}</label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Otoritas Fitur Lainnya</h3>
            </div>
            <div class="card-body row">
                @foreach($featuresLainnya as $feature)
                <div class="form-group mb-0 form-group col-md-4">
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="permissions[]" value="{{ $feature->name }}" class="form-check-input" id="feature-{{ $feature->id }}_label">
                        <label class="form-check-label" for="feature-{{ $feature->id }}_label">{{ $feature->name }}</label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Buat Role</button>
    </form>
</div>
</div>
</div>
    </div>
</div>

@endsection
