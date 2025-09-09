<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Aplikasi')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        /* ===================== ALERT STYLE ===================== */
        .alert {
            position: fixed;
            top: 15px;
            left: 50%;
            transform: translateX(-50%);
            padding: 15px 25px;
            border-radius: 8px;
            z-index: 9999;
            font-size: 16px;
            color: #fff;
            min-width: 300px;
            max-width: 600px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            animation: fadeIn 0.5s ease;
        }
        .alert-success { background-color: #4CAF50; }
        .alert-danger { background-color: #f44336; }
        .close-btn { 
            margin-left: 15px; 
            font-weight: bold; 
            cursor: pointer; 
            color: #fff; 
        }

        /* Animasi masuk */
        @keyframes fadeIn {
            from { opacity: 0; transform: translate(-50%, -20px); }
            to { opacity: 1; transform: translate(-50%, 0); }
        }
    </style>
</head>
<body>

    {{-- ===================== ALERT ===================== --}}
    @if(session('sukses'))
        <div class="alert alert-success" id="alert-box">
            {{ session('sukses') }}
            <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" id="alert-box">
            {{ session('error') }}
            <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger" id="alert-box">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
            <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
        </div>
    @endif

    {{-- ===================== KONTEN HALAMAN ===================== --}}
    @yield('content')

    <script>
        // Auto-hide alert setelah 5 detik
        setTimeout(function(){
            var alertBox = document.getElementById('alert-box');
            if(alertBox){ alertBox.style.display = 'none'; }
        }, 5000);
    </script>

</body>
</html>
