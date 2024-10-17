@extends('layouts.apps')

@section('title', 'Create Client')

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Create Client</h3>
                </div>
                <div class="card-body">
                    <form class="_form" action="{{ route('clients.store') }}" method="POST">
                        @csrf
                        <div class="row">
                        <div class="form-group col-md-4">
                            <label for="name">Nama Client:</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Nama Client" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group col-md-4">
                            <label for="jenis_id">Jenis:</label>
                            <select id="jenis_id" name="jenis_id" class="form-control" required>
                                <option value="">Pilih Jenis</option>
                                @foreach($jenisOptions as $jenis)
                                    <option value="{{ $jenis->id }}" {{ old('jenis_id') == $jenis->id ? 'selected' : '' }}>
                                        {{ $jenis->jenis }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jenis_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="tanggal">Tanggal:</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal') }}" required>
                            @error('tanggal')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="status_id">Status:</label>
                            <select id="status_id" name="status_id" class="form-control" required>
                                <option value="">Pilih Status</option>
                                @foreach($statusOptions as $status)
                                    <option value="{{ $status->id }}" {{ old('status_id') == $status->id ? 'selected' : '' }}>
                                        {{ $status->status }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="no_telp">Nomor Telpon:</label>
                            <input type="number" name="no_telp" id="no_telp" class="form-control" value="{{ old('no_telp') }}" required>
                            @error('no_telp')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="sumber">Sumber:</label>
                            <input type="text" name="sumber" id="sumber" class="form-control" value="{{ old('sumber') }}" required>
                            @error('sumber')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group col-md-12">
                            <label for="kebutuhan">Kebutuhan:</label>
                            <textarea name="kebutuhan" id="kebutuhan" class="form-control" required>{{ old('kebutuhan') }}</textarea>
                            @error('kebutuhan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-12">
                            <label for="alamat">Alamat:</label>
                            <textarea name="alamat" id="alamat" class="form-control" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group col-md-12">
                            <label for="keterangan">Keterangan:</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" required>{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        
                    </div>
                        <button type="submit"  class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/crud.js')}}"></script>    
@endpush


