<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Admin Login</title>
    <link href="/css/style.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Inter", sans-serif;

            /* Background gambar + overlay hitam transparan */
            background: 
                linear-gradient(rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.55)),
                url('/img/bg.jpg') no-repeat center center/cover;

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
            margin-bottom: 10px;
            color: #fff;
        }

        .subtext {
            text-align: center;
            color: #e5e7eb;
            margin-bottom: 25px;
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
            margin-top: 5px;
        }

        .btn-primary:hover {
            background-color: #2563eb !important;
        }

        label {
            font-weight: 600;
            margin-bottom: 5px;
            color: #f3f4f6;
        }
    </style>
</head>

<body>

    <div class="login-card">

        <!-- LOGO ERTHREE -->
        <div style="text-align:center; margin-bottom:20px;">
            <img src="/img/erthree-logo.png"
                 alt="Erthree Logo"
                 style="width:200px; filter: drop-shadow(0 0 10px rgba(243, 242, 242, 1));">
        </div>

        <h2>Welcome Back!</h2>
        <div class="subtext">Log in to your admin account</div>

        @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button class="btn btn-primary">Login</button>
        </form>

    </div>

</body>
</html>
