@extends('layouts.apps')

@section('title', 'Edit Monitoring')
@section('header', 'Edit Monitoring')

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Monitoring</h3>
                </div>
                <div class="card-body">
                    <form class="_form" action="{{ route('monitorings.update', $monitoring->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                        <!-- Form Fields -->
                        <div class="form-group col-md-6">
                            <label for="name">Nama Client:</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $monitoring->name) }}" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="projek_id">Projek:</label>
                            <select id="projek_id" name="projek_id" class="form-control @error('projek_id') is-invalid @enderror" required>
                                <option value="">Select Projek</option>
                                @foreach($projekOptions as $projek)
                                    <option value="{{ $projek->id }}" {{ old('projek_id', $monitoring->projek_id) == $projek->id ? 'selected' : '' }}>
                                        {{ $projek->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('projek_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="bidang">Bidang:</label>
                            <input type="text" name="bidang" id="bidang" class="form-control" value="{{ old('bidang', $monitoring->bidang) }}" required>
                            @error('bidang')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="mulai">Mulai:</label>
                            <input type="date" name="mulai" id="mulai" class="form-control" value="{{ old('mulai', $monitoring->mulai->format('Y-m-d')) }}" required>
                            @error('mulai')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="selesai">Selesai:</label>
                            <input type="date" name="selesai" id="selesai" class="form-control" value="{{ old('selesai', $monitoring->selesai->format('Y-m-d')) }}" required>
                            @error('selesai')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        

                        <div class="form-group col-md-6">
                            <label for="domain">Domain:</label>
                            <input type="text" name="domain" id="domain" class="form-control" value="{{ old('domain', $monitoring->domain) }}" required>
                            @error('domain')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="keterangan_id">Keterangan:</label>
                            <select id="keterangan_id" name="keterangan_id" class="form-control @error('keterangan_id') is-invalid @enderror" required>
                                <option value="">Select Keterangan</option>
                                @foreach($keteranganOptions as $keterangan)
                                    <option value="{{ $keterangan->id }}" {{ old('keterangan_id', $monitoring->keterangan_id) == $keterangan->id ? 'selected' : '' }}>
                                        {{ $keterangan->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('keterangan_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>

      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


