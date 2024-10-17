@extends('layouts.apps')
@section('title', 'Projek Monitoring')

@section('header', 'Projek Monitoring')

@section('content')
<div class="container">
    <h3>Edit Projek</h3>
    <form class="_form" action="{{ route('projek.update', $projek->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
        <div class="form-group col-md-6">
            <label for="name">Judul:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $projek->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        </div>
        <button type="submit" class="btn btn-primary">Update Projek</button>
    </form>

    <div id="responseMessage" class="mt-3"></div>
</div>



@endsection
