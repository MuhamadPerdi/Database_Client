@extends('layouts.apps')
@section('title', 'Jenis Client')

@section('header', 'Jenis Client')
@section('content')
<div class="container">
    <h3>Edit Jenis</h3>
    <form class="_form" action="{{ route('jenis.update', $jenis->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
        <div class="form-group col-md-6">
            <label for="jenis">Judul:</label>
            <input type="text" id="jenis" name="jenis" class="form-control" value="{{ old('jenis', $jenis->jenis) }}" required>
            @error('jenis')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        </div>
        <button type="submit" class="btn btn-primary">Update Jenis</button>
    </form>

    <div id="responseMessage" class="mt-3"></div>
</div>

@endsection


