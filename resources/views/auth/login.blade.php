<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Hanglekiu Dental Clinic</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/responsive.css">
    <style>
        /* Admin palette variables (match sidebar / topbar) */
        :root{
            --surface: #FFFFFF;
            --main-bg: #FAF9F6;
            --accent: #B08D70; /* wood tone */
            --action: #5F6F65; /* button / action color */
            --text: #484848;
            --muted: #94a3b8;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--main-bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            display: flex;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            gap: 60px;
            align-items: center;
            justify-content: center;
        }

        /* Left Side - Illustration */
        .left-side {
            flex: 1;
            max-width: 550px;
        }

        .illustration {
            width: 100%;
            max-width: 520px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .illustration-img {
            width: 100%;
            max-width: 480px;
            height: auto;
            object-fit: contain;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
            background: transparent;
        }

        .left-side h2 {
            font-size: 24px;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 15px;
        }

        .left-side p {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .left-side a {
            color: var(--action);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }

        .left-side a:hover {
            text-decoration: underline;
        }

        /* Right Side - Login Form */
        .right-side {
            flex: 0 0 380px;
        }

        .login-card {
            background: var(--surface);
            border-radius: 12px;
            padding: 40px 35px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .logo {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .logo-icon {
            width: 50px;
            height: 50px;
            color: var(--accent);
        }

        .logo-icon svg {
            width: 100%;
            height: 100%;
        }

        .logo-text {
            font-size: 32px;
            font-weight: 700;
            color: var(--accent);
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group input {
            width: 100%;
            padding: 15px 0;
            border: none;
            border-bottom: 1px solid #e0e0e0;
            font-size: 15px;
            color: var(--text);
            background: transparent;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .form-group input::placeholder {
            color: #999;
        }

        .form-group input:focus {
            border-bottom-color: var(--action);
        }

        .password-toggle {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
            color: #999;
        }

        .password-toggle:hover {
            color: #666;
        }

        .password-toggle svg {
            width: 22px;
            height: 22px;
        }

        .login-btn {
            width: 100%;
            padding: 15px;
            background: var(--action);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .login-btn:hover {
            filter:brightness(.96);
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        }

        .register-btn {
            display: block;
            width: 100%;
            box-sizing: border-box;
            padding: 12px 18px;
            border-radius: 8px;
            background: transparent;
            border: 1px solid var(--action);
            color: var(--action);
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.2s ease, color 0.2s ease;
        }

        .register-btn:hover {
            background: rgba(95,111,101,0.08);
            color: var(--action);
        }

        .forgot-password {
            text-align: center;
            margin-top: 25px;
        }

        .forgot-password a {
            color: var(--action);
            text-decoration: none;
            font-size: 14px;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        .version {
            text-align: right;
            margin-top: 20px;
            font-size: 12px;
            color: #bbb;
        }

        /* Error Messages */
        .error-message {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .login-container {
                flex-direction: column;
                gap: 40px;
            }

            .left-side {
                display: none;
            }

            .right-side {
                flex: 0 0 auto;
                width: 100%;
                max-width: 400px;
            }
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 30px 25px;
            }

            .logo-text {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Left Side - Illustration -->
        <div class="left-side">
            <div class="illustration">
                <img src="{{ asset('assets/dokter.png') }}" alt="Dokter" class="illustration-img">
            </div>
            <!-- <h2>Pilih Hanya Yang Terbaik</h2>
            <p>Assist.id adalah sistem informasi kesehatan terbaik untuk klinik, praktek pribadi Anda. Berbagai fitur tersedia untuk Anda.</p>
            <a href="#">Pelajari lebih lanjut ></a> -->
        </div>

        <!-- Right Side - Login Form -->
        <div class="right-side">
            <div class="login-card">
                <div class="logo">
                    <div class="logo-container">
                        <div class="logo-icon">
                            <svg viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <!-- Shield background inherits currentColor so it matches theme -->
                                <path d="M30 5 L50 12 L50 30 Q50 50 30 55 Q10 50 10 30 L10 12 Z" fill="currentColor"/>
                                <!-- White cross -->
                                <rect x="26" y="18" width="8" height="24" rx="2" fill="white"/>
                                <rect x="18" y="26" width="24" height="8" rx="2" fill="white"/>
                            </svg>
                        </div>
                        <span class="logo-text">Hanglekiu Dental Clinic</span>
                    </div>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <input 
                            type="text" 
                            name="email" 
                            id="email" 
                            placeholder="Username/Email" 
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                        >
                    </div>

                    <div class="form-group">
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            placeholder="Password" 
                            required
                            autocomplete="current-password"
                        >
                        <button type="button" class="password-toggle" onclick="togglePassword()">
                            <svg id="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>

                    <button type="submit" class="login-btn">Login</button>
                </form>

                <div class="register-link" style="text-align:center;margin-top:12px;">
                    <a href="{{ route('register') }}" class="register-btn">Belum punya akun?</a>
                </div>

                <div class="forgot-password" style="text-align:center;margin-top:8px;">
                    <a href="{{ route('password.request') }}">Lupa password?</a>
                </div>

                <!-- <div class="version">V.3.37.0</div> -->
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = `
                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                    <line x1="1" y1="1" x2="23" y2="23"/>
                `;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = `
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                    <circle cx="12" cy="12" r="3"/>
                `;
            }
        }
    </script>
</body>
</html>
