@extends('layouts.apps')

@section('title', 'Keterangan Monitoring')

@section('header', 'Keterangan Monitoring')
@section('content')
<div class="container">
    <h3>Tambah Keterangan </h3>
    <form class="_form" action="{{ route('keterangan.store') }}" method="POST">
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
        <div class="form-group col-md-6">
            <label for="name">Judul:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
        <button type="submit" class="btn btn-primary">Add Keterangan</button>
    </form>

</div>
@endsection


