@extends('layouts.apps')
@section('title', 'Status Client')

@section('header', 'Status Client')

@section('content')
<div class="container">
    <h3>Add New Status</h3>
    <form class="_form" action="{{ route('status.store') }}" method="POST">
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
        <div class="form-group col-md-6">
            <label for="status">Judul:</label>
            <input type="text" id="status" name="status" class="form-control" value="{{ old('status') }}" required>
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        </div>
        <button type="submit" id="submitBtn" class="btn btn-primary">Add Status</button>
    </form>

    <div id="responseMessage" class="mt-3"></div>
</div>


@endsection
