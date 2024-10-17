@extends('layouts.apps')

@section('title', 'Profile')

@section('header', 'Profile')

@section('breadcrumb')
<div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
<div class="breadcrumb-item">Edit Profile</div>
@endsection
@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row mt-4">
        <div class="col-12 col-md-12 col-lg-5">
            <div class="card profile-widget">
                <div class="profile-widget-header">
                    <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('assets/img/avatar/avatar-1.png') }}" alt="Avatar" class="rounded-circle profile-widget-picture">
                    <div class="profile-widget-items">
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Name</div>
                            <div class="profile-widget-item-value">{{ $user->name }}</div>
                        </div>
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Email</div>
                            <div class="profile-widget-item-value">{{ $user->email }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-7">
            <div class="card">
                <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="needs-validation" novalidate="">
                    @csrf
                    <div class="card-header">
                        <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                            <div class="invalid-feedback">
                                Please fill in the name
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                            <div class="invalid-feedback">
                                Please fill in the email
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="avatar">Avatar</label>
                            <input type="file" class="form-control-file" id="image" name="avatar" accept="avatar/*" onchange="previewImage(event)">
                             <div id="imagePreview">
                                @if($user->avatar)
                                    <img src="{{ asset('storage/'.$user->avatar) }}" style="max-width: 200px; margin-top: 10px;" class="img-fluid mt-2">
                                @endif
                            </div>
                            @error('avatar')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                Upload a new avatar (optional)
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </div>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                            <small class="form-text text-muted">
                                Leave blank if you don't want to change the password
                            </small>
                        </div>
                        
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </div>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                            </div>
                            <div class="invalid-feedback">
                                Please confirm the password
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>function previewImage(event) {
var reader = new FileReader();
reader.onload = function() {
    var output = document.getElementById('imagePreview');
    output.innerHTML = '<img src="' + reader.result + '" style="max-width: 200px; margin-top: 10px;" class="img-fluid mt-2" />';
}
    if (event.target.files.length > 0) {
        reader.readAsDataURL(event.target.files[0]);
    } else {
        document.getElementById('imagePreview').innerHTML = ''; // Clear preview if no file is selected
    }
}
</script>

@endpush
