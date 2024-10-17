@extends('layouts.apps')
@section('title', 'Jenis Client')

@section('header', 'Jenis Client')

@section('breadcrumb')
<div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
<div class="breadcrumb-item active"><a href="{{route('jenis.index')}}">Jenis Client</a></div>
<div class="breadcrumb-item">Create Jenis Client</div>
@endsection
@section('content')
<div class="container">
    <h3>Add New Jenis</h3>
    <form class="_form" action="{{ route('jenis.store') }}" method="POST">
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
        <div class="form-group col-md-6">
            <label for="jenis">Judul:</label>
            <input type="text" id="jenis" name="jenis" class="form-control" value="{{ old('jenis') }}" required>
            @error('jenis')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        </div>
        <button type="submit" class="btn btn-primary">Add Jenis</button>
    </form>

    <div id="responseMessage" class="mt-3"></div>
</div>
@endsection


