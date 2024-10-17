@extends('layouts.apps')
@section('title', 'Keterangan Monitoring')

@section('header', 'Keterangan Monitoring')
@section('content')

<div class="container">
    <h3>Edit Keterangan</h3>
    <form class="_form" action="{{ route('keterangan.update', $keterangan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
        <div class="form-group col-md-6">
            <label for="name">Judul:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $keterangan->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        </div>
        <button type="submit" id="submitBtn" class="btn btn-primary">Update Keterangan</button>
    </form>

    <div id="responseMessage" class="mt-3"></div>
</div>

@endsection
