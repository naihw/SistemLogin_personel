@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100 bg-gradient">
    <div class="card edit-profile-card shadow-lg">
        <div class="card-header text-center">
            <h3 class="mb-0">Edit Profile</h3>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control"
                        value="{{ old('name', $user->name) }}" placeholder="Nama lengkap">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Pangkat</label>
                        <input type="text" name="pangkat" class="form-control"
                            value="{{ old('pangkat', $user->pangkat) }}" placeholder="Pangkat">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">NRP</label>
                        <input type="text" name="nrp" class="form-control"
                            value="{{ old('nrp', $user->nrp) }}" placeholder="NRP">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Korps</label>
                        <input type="text" name="korps" class="form-control"
                            value="{{ old('korps', $user->korps) }}" placeholder="Korps">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jabatan</label>
                        <input type="text" name="jabatan" class="form-control"
                            value="{{ old('jabatan', $user->jabatan) }}" placeholder="Jabatan">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Satuan</label>
                        <input type="text" name="satuan" class="form-control"
                            value="{{ old('satuan', $user->satuan) }}" placeholder="Satuan">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">NIK</label>
                        <input type="text" name="nik" class="form-control"
                            value="{{ old('nik', $user->nik) }}" placeholder="NIK">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3"
                        placeholder="Alamat lengkap">{{ old('alamat', $user->alamat) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password (Opsional)</label>
                    <input type="password" name="password" class="form-control"
                        placeholder="Kosongkan jika tidak diganti">
                </div>

                <div class="d-flex justify-content-center gap-3 mt-4">
                    <button type="submit" class="btn btn-primary btn-save">Save Changes</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-light btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
