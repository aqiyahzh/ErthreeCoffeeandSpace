<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login Admin</title>
    <link href="/css/style.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Inter", sans-serif;
            background:
                linear-gradient(rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.55)),
                url('/img/carousel-2.png') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.35);
            color: #fff;
            width: 100%;
            max-width: 430px;
        }

        h2 {
            text-align: center;
            font-weight: 700;
            margin-bottom: 8px;
            color: #fff;
        }

        .subtext {
            text-align: center;
            color: #e5e7eb;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .form-control {
            padding: 12px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.85);
            border: none;
        }

        .btn-primary {
            background-color: #3b82f6 !important;
            border: none;
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            margin-top: 10px;
        }

        .btn-primary:hover {
            background-color: #2563eb !important;
        }

        label {
            font-weight: 600;
            margin-bottom: 5px;
            color: #f3f4f6;
        }

        /* TURNSTILE CENTER */
        .turnstile-wrapper {
            display: flex;
            justify-content: center;
            margin: 18px 0;
        }
    </style>
</head>

<body>

<div class="login-card">

    <!-- LOGO -->
    <div style="text-align:center; margin-bottom:20px;">
        <img src="/img/erthree-logo.png"
             alt="Erthree Logo"
             style="width:200px; filter: drop-shadow(0 0 10px rgba(243, 242, 242, 1));">
    </div>

    <h2>Selamat Datang!</h2>
    <div class="subtext">Silakan masuk ke panel admin</div>

    @if($errors->any())
        <div class="alert alert-danger text-center">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login.post') }}">
        @csrf

        <div class="mb-3">
            <label>Email</label>
            <input type="email"
                   name="email"
                   class="form-control"
                   value="{{ old('email') }}"
                   required>
        </div>

        <div class="mb-3">
            <label>Kata Sandi</label>
            <input type="password"
                   name="password"
                   class="form-control"
                   required>
        </div>

        <!-- TURNSTILE CENTER -->
        <div class="turnstile-wrapper">
            <div class="cf-turnstile"
                 data-sitekey="{{ env('TURNSTILE_SITE_KEY') }}">
            </div>
        </div>

        <button class="btn btn-primary">Masuk</button>
    </form>

</div>

<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

</body>
</html>
