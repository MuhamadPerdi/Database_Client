@extends('layouts.apps')

@section('title', 'Status Client')

@section('header', 'Status Client')
@section('content')
<div class="container">
    <h3>Edit Status</h3>
    <form class="_form" action="{{ route('status.update', $status->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
        <div class="form-group col-md-6">
            <label for="status">Judul:</label>
            <input type="text" id="status" name="status" class="form-control" value="{{ old('status', $status->status) }}" required>
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        </div>
        <button type="submit" id="submitBtn" class="btn btn-primary">Update Status</button>
    </form>

    <div id="responseMessage" class="mt-3"></div>
</div>



@endsection
