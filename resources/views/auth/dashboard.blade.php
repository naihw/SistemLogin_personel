@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="dashboard-container">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <header>
        <h2>Selamat datang, {{ Auth::user()->name }}</h2>
        <form method="POST" action="{{ route('auth.webLogout') }}">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </header>
    
    <div class="profile-card">
        <h3>Profil Personel</h3>
        <a href="{{ route('profile.edit') }}" class="edit-profile-btn">Edit Profil</a>
        <ul>
            <li><strong>Nama:</strong> {{ Auth::user()->name }}</li>
            <li><strong>Pangkat:</strong> {{ Auth::user()->pangkat ?? '-' }}</li>
            <li><strong>NRP:</strong> {{ Auth::user()->nrp }}</li>
            <li><strong>Korps:</strong> {{ Auth::user()->korps ?? '-' }}</li>
            <li><strong>Jabatan:</strong> {{ Auth::user()->jabatan ?? '-' }}</li>
            <li><strong>Satuan:</strong> {{ Auth::user()->satuan ?? '-' }}</li>
            <li><strong>NIK:</strong> {{ Auth::user()->nik ?? '-' }}</li>
            <li><strong>Alamat:</strong> {{ Auth::user()->alamat ?? '-' }}</li>
        </ul>
    </div>
</div>
@endsection
