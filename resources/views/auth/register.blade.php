@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="register-card">
    <h2>Daftar akun</h2>
    <form method="POST" action="{{ route('register.post') }}">
        @csrf
        <input type="text" name="name" placeholder="Nama Lengkap" required>
        <input type="text" name="pangkat" placeholder="Pangkat" required>
        <input type="text" name="nrp" placeholder="NRP" required>
        <input type="text" name="korps" placeholder="Korps">
        <input type="text" name="jabatan" placeholder="Jabatan">
        <input type="text" name="satuan" placeholder="Satuan">
        <input type="text" name="nik" placeholder="NIK">
        <input type="text" name="alamat" placeholder="Alamat">
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
        <button type="submit">Register</button>
    </form>
    <p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
</div>
@endsection
