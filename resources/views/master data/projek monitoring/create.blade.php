@extends('layouts.apps')
@section('title', 'Projek Monitoring')

@section('header', 'Projek Monitoring')
@section('content')
<div class="container">
    <h3>Add New Projek</h3>
    <form class="_form" action="{{ route('projek.store') }}" method="POST">
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
        <button type="submit" class="btn btn-primary">Add Projek</button>
    </form>

    <div id="responseMessage" class="mt-3"></div>
</div>


@endsection
