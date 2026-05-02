<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedSyst — Register</title>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&family=DM+Serif+Display&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background: #f4f7f6;
        }

        .page {
            display: grid;
            grid-template-columns: 480px 1fr;
            min-height: 100vh;
        }

        .left-panel {
            background: #2e9d91;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-name {
            font-family: 'DM Serif Display', serif;
            color: white;
            font-size: 2rem;
        }

        .right-panel {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-card {
            width: 400px;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: black;
            color: white;
            border-radius: 50px;
            border: none;
            cursor: pointer;
        }

        .register-wrap {
            margin-top: 1.5rem;
            text-align: center;
        }

        .register-link {
            color: #2e9d91;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="page">

    <div class="left-panel">
        <div class="brand-name">MedSyst</div>
    </div>

    <div class="right-panel">
        <div class="form-card">

            <h1>Create Account</h1>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <input type="text" name="name" placeholder="Name" required><br><br>
                <input type="email" name="email" placeholder="Email" required><br><br>
                <input type="password" name="password" placeholder="Password" required><br><br>
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required><br><br>

                <button type="submit" class="btn-login">Register</button>
            </form>

            <div class="register-wrap">
                <span>Already have an account?</span>
                <a href="{{ route('login') }}" class="register-link">Login</a>
            </div>

        </div>
    </div>

</div>

</body>
</html>