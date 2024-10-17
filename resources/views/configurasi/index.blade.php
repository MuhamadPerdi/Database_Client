@extends('layouts.apps')

@section('title', 'Edit Konfigurasi')
 @section('header', 'Edit Konfigurasi')
 @section('breadcrumb')
<div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
<div class="breadcrumb-item">Edit Konfigurasi</div>
 @endsection
@section('content')
<section class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h6 class="card-title">Edit Konfigurasi</h6>
        </div>

        <!-- Display flash messages -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form class="_form" action="{{ route('configurasi.update', $konfigurasi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
            <div class="card-body row">
                <!-- Input fields -->
                <div class="form-group col-md-6">
                    <label for="title">Nama Website</label>
                    <input type="text" name="title" id="title" placeholder="Masukan Nama Website" class="form-control" required value="{{ old('title', $konfigurasi->title) }}">
                </div>

                <div class="form-group col-md-3">
                    <label for="logo">Logo</label>
                    <br>
                    <input type="file" name="logo" id="logo" accept=".jpg, .png">
                    <div id="preview">
                        @if($konfigurasi->logo)
                            <img src="{{ asset('storage/logos/' . basename($konfigurasi->logo)) }}" id="preview" style="margin-top: 10px; width: 200px; height: auto;">
                        @else
                            <p>No logo available</p>
                        @endif
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="favicon">Favicon</label>
                    <br>
                    <input type="file" name="favicon" id="favicon" accept=".ico, .png, .jpg">
                    <div id="preview2">
                        @if($konfigurasi->favicon)
                            <img src="{{ asset('storage/favicons/' . basename($konfigurasi->favicon)) }}" id="preview2" style="margin-top: 10px; width: 200px; height: auto;">
                        @else
                            <p>No favicon available</p>
                        @endif
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Masukan Email" class="form-control" required value="{{ old('email', $konfigurasi->email) }}">
                </div>

                <div class="form-group col-md-6">
                    <label for="email2">Email Kedua</label>
                    <input type="email" name="email2" id="email2" placeholder="Masukan Email Kedua" class="form-control" value="{{ old('email2', $konfigurasi->email2) }}">
                </div>

                <div class="form-group col-md-6">
                    <label for="phone">Nomor Telepon</label>
                    <input type="text" name="phone" id="phone" placeholder="Masukan Nomor Telepon" class="form-control" required value="{{ old('phone', $konfigurasi->phone) }}">
                </div>

                <div class="form-group col-md-6">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" placeholder="Masukan Alamat" class="form-control" required>{{ old('alamat', $konfigurasi->alamat) }}</textarea>
                </div>

                <div class="form-group col-md-12">
                    <label for="map">Link Peta (iframe embed code)</label>
                    <textarea name="map" id="map" placeholder="Masukan URL Peta" class="form-control" required>{{ old('map', $konfigurasi->map) }}</textarea>
                </div>

                <div class="form-group col-md-12">
                    <label for="footer">Footer</label>
                    <textarea name="footer" id="footer" placeholder="Masukan Teks Footer" class="form-control" required>{{ old('footer', $konfigurasi->footer) }}</textarea>
                </div>

                <div class="form-group col-md-6">
                    <label for="instagram">Link Instagram</label>
                    <input type="url" name="instagram" id="instagram" placeholder="Masukan alamat Instagram" class="form-control" value="{{ old('instagram', $konfigurasi->instagram) }}">
                </div>

                <div class="form-group col-md-6">
                    <label for="facebook">Link Facebook</label>
                    <input type="url" name="facebook" id="facebook" placeholder="Masukan alamat Facebook" class="form-control" value="{{ old('facebook', $konfigurasi->facebook) }}">
                </div>

                <div class="form-group col-md-6">
                    <label for="twitter">Link Twitter</label>
                    <input type="url" name="twitter" id="twitter" placeholder="Masukan alamat Twitter" class="form-control" value="{{ old('twitter', $konfigurasi->twitter) }}">
                </div>

                <div class="form-group col-md-6">
                    <label for="youtube">Link YouTube</label>
                    <input type="url" name="youtube" id="youtube" placeholder="Masukan alamat YouTube" class="form-control" value="{{ old('youtube', $konfigurasi->youtube) }}">
                </div>

                <div class="form-group col-md-6">
                    <label for="whatsapp">Link WhatsApp</label>
                    <input type="text" name="whatsapp" id="whatsapp" placeholder="Masukan nomor WhatsApp" class="form-control" value="{{ old('whatsapp', $konfigurasi->whatsapp) }}">
                </div>

                <div class="form-group col-md-6">
                    <label for="linkedin">Link LinkedIn</label>
                    <input type="url" name="linkedin" id="linkedin" placeholder="Masukan alamat LinkedIn" class="form-control" value="{{ old('linkedin', $konfigurasi->linkedin) }}">
                </div>

                <div class="form-group col-md-12">
                    <label for="overview">Overview</label>
                    <textarea name="overview" id="overview" placeholder="Masukan Overview" class="form-control" required>{{ old('overview', $konfigurasi->overview) }}</textarea>
                </div>

                <div class="form-group col-md-12">
                    <label for="metakeyword">Meta Keyword</label>
                    <textarea name="metakeyword" id="metakeyword" placeholder="Masukan Meta Keyword" class="form-control" required>{{ old('metakeyword', $konfigurasi->metakeyword) }}</textarea>
                </div>

                <div class="form-group col-md-12">
                    <label for="metadeskripsi">Meta Deskripsi</label>
                    <textarea name="metadeskripsi" id="metadeskripsi" placeholder="Masukan Meta Deskripsi" class="form-control" required>{{ old('metadeskripsi', $konfigurasi->metadeskripsi) }}</textarea>
                </div>
            </div>
                <div class="form-group col-md-6" style=" margin-left: 11px;">
                    <button type="submit" class="btn btn-primary">Update Konfigurasi</button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
