@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="login-card">
    <h2>Login</h2>
    <form id="loginForm">
        @csrf
        <input type="text" id="nrp" name="nrp" placeholder="NRP" value="{{ old('nrp') }}">

      <div class="password-wrapper">
            <input type="password" id="password" name="password" placeholder="Password">
            <span id="togglePassword" class="toggle-password">
                <!-- eye open -->
                <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                    <circle cx="12" cy="12" r="3"/>
                </svg>
            </span>
        </div>

        <button type="submit">Login</button>
    </form>
    <p>Belum punya akun? <a href="{{ route('register') }}">Register</a></p>
</div>

<script>
document.getElementById("loginForm").addEventListener("submit", async function(e) {
    e.preventDefault();

    const nrp = document.getElementById("nrp").value;
    const password = document.getElementById("password").value;

    try {
        const res = await fetch("{{ url('/api/login') }}", {
            method: "POST",
            headers: { 
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify({ nrp, password }),
            credentials: "include" 
        });

        const data = await res.json();

        if (res.ok) {
            alert("Login berhasil!");
            window.location.href = "/dashboard"; 
        } else {
            alert(data.message);
        }
    } catch (err) {
        console.error(err);
        alert("Terjadi error saat login");
    }
});

// Show password hanya saat ditekan
const togglePassword = document.getElementById("togglePassword");
const passwordInput = document.getElementById("password");

togglePassword.addEventListener("mousedown", function() {
    passwordInput.type = "text";
});

togglePassword.addEventListener("mouseup", function() {
    passwordInput.type = "password";
});

togglePassword.addEventListener("mouseleave", function() {
    passwordInput.type = "password";
});
</script>
@endsection
