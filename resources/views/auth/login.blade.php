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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
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
            max-width: 500px;
            margin-bottom: 30px;
        }

        .illustration img {
            width: 100%;
            height: auto;
        }

        .left-side h2 {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
        }

        .left-side p {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .left-side a {
            color: #2196F3;
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
            background: white;
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
        }

        .logo-icon svg {
            width: 100%;
            height: 100%;
        }

        .logo-text {
            font-size: 32px;
            font-weight: 700;
            color: #2196F3;
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
            color: #333;
            background: transparent;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .form-group input::placeholder {
            color: #999;
        }

        .form-group input:focus {
            border-bottom-color: #2196F3;
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
            background: linear-gradient(135deg, #5BA3E0 0%, #3B82C4 100%);
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
            background: linear-gradient(135deg, #4A93D0 0%, #2B72B4 100%);
            box-shadow: 0 4px 15px rgba(59, 130, 196, 0.4);
        }

        .register-btn {
            display: block;
            width: 100%;
            box-sizing: border-box;
            padding: 12px 18px;
            border-radius: 8px;
            background: transparent;
            border: 1px solid #3B82C4;
            color: #3B82C4;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.2s ease, color 0.2s ease;
        }

        .register-btn:hover {
            background: rgba(59,130,196,0.08);
            color: #1e4f8a;
        }

        .forgot-password {
            text-align: center;
            margin-top: 25px;
        }

        .forgot-password a {
            color: #2196F3;
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
                <svg viewBox="0 0 500 400" xmlns="http://www.w3.org/2000/svg">
                    <!-- Background shapes -->
                    <ellipse cx="250" cy="320" rx="200" ry="30" fill="#E8D4F0" opacity="0.5"/>
                    
                    <!-- Purple desk/table -->
                    <path d="M80 280 Q250 320 420 280 L400 350 Q250 380 100 350 Z" fill="#9B7BB8"/>
                    
                    <!-- Laptop -->
                    <rect x="120" y="240" width="100" height="60" rx="5" fill="#C0C0C0"/>
                    <rect x="125" y="245" width="90" height="50" fill="#333"/>
                    <rect x="100" y="300" width="140" height="8" rx="2" fill="#A0A0A0"/>
                    <!-- Apple logo on laptop -->
                    <path d="M170 270 Q175 260 180 270 Q175 280 170 270" fill="#FFF" opacity="0.5"/>
                    
                    <!-- Coffee mug -->
                    <rect x="320" y="260" width="40" height="45" rx="5" fill="#FFF" stroke="#DDD" stroke-width="2"/>
                    <ellipse cx="340" cy="263" rx="18" ry="5" fill="#8B4513" opacity="0.6"/>
                    <path d="M360 275 Q380 280 360 300" stroke="#DDD" stroke-width="3" fill="none"/>
                    <!-- MD text on mug -->
                    <text x="330" y="290" font-size="14" font-weight="bold" fill="#4A90A4">MD</text>
                    
                    <!-- Plant -->
                    <rect x="390" y="260" width="25" height="35" rx="3" fill="#8B7355"/>
                    <path d="M402 260 Q402 230 420 210" stroke="#4CAF50" stroke-width="3" fill="none"/>
                    <path d="M402 260 Q402 235 385 220" stroke="#4CAF50" stroke-width="3" fill="none"/>
                    <path d="M402 260 Q402 240 410 225" stroke="#4CAF50" stroke-width="3" fill="none"/>
                    <ellipse cx="420" cy="208" rx="15" ry="10" fill="#4CAF50"/>
                    <ellipse cx="385" cy="218" rx="12" ry="8" fill="#66BB6A"/>
                    <ellipse cx="410" cy="223" rx="10" ry="7" fill="#81C784"/>
                    
                    <!-- Woman/Patient sitting -->
                    <!-- Chair -->
                    <rect x="100" y="300" width="60" height="80" rx="5" fill="#E5A43B"/>
                    
                    <!-- Woman's body -->
                    <ellipse cx="130" cy="220" rx="25" ry="25" fill="#F5D0C5"/>
                    <!-- Hair -->
                    <path d="M105 210 Q100 180 120 170 Q150 165 155 190 Q158 210 155 230 Q140 240 120 235 Q105 230 105 210" fill="#5D4037"/>
                    
                    <!-- Face -->
                    <ellipse cx="132" cy="215" rx="18" ry="20" fill="#F5D0C5"/>
                    
                    <!-- Blouse -->
                    <path d="M110 240 Q130 250 150 240 L160 320 L100 320 Z" fill="#3B5998"/>
                    
                    <!-- Skirt -->
                    <path d="M100 320 L95 380 L165 380 L160 320 Z" fill="#3B5998"/>
                    <path d="M100 340 L165 340" stroke="#2D4373" stroke-width="2"/>
                    
                    <!-- Arms -->
                    <path d="M150 250 Q170 260 175 280 Q180 300 175 310" stroke="#F5D0C5" stroke-width="12" fill="none" stroke-linecap="round"/>
                    <path d="M110 250 Q95 270 100 300" stroke="#F5D0C5" stroke-width="12" fill="none" stroke-linecap="round"/>
                    
                    <!-- Doctor -->
                    <!-- Head -->
                    <ellipse cx="280" cy="140" rx="30" ry="32" fill="#F5D0C5"/>
                    
                    <!-- Hair (dark blue/black) -->
                    <path d="M250 130 Q250 100 280 95 Q310 100 310 130 Q305 120 280 120 Q255 120 250 130" fill="#1A237E"/>
                    
                    <!-- Glasses -->
                    <rect x="262" y="135" width="16" height="12" rx="2" fill="none" stroke="#333" stroke-width="2"/>
                    <rect x="282" y="135" width="16" height="12" rx="2" fill="none" stroke="#333" stroke-width="2"/>
                    <line x1="278" y1="141" x2="282" y2="141" stroke="#333" stroke-width="2"/>
                    
                    <!-- Smile -->
                    <path d="M272 158 Q280 165 288 158" stroke="#333" stroke-width="2" fill="none"/>
                    
                    <!-- White coat -->
                    <path d="M250 170 Q280 180 310 170 L320 280 L240 280 Z" fill="#FFF"/>
                    <path d="M265 180 L265 250" stroke="#E0E0E0" stroke-width="1"/>
                    <path d="M295 180 L295 250" stroke="#E0E0E0" stroke-width="1"/>
                    
                    <!-- Blue shirt under coat -->
                    <path d="M265 175 Q280 185 295 175 L295 200 L265 200 Z" fill="#42A5F5"/>
                    
                    <!-- Arms -->
                    <path d="M250 180 Q220 200 210 240 Q205 260 220 280" stroke="#FFF" stroke-width="20" fill="none" stroke-linecap="round"/>
                    <path d="M310 180 Q340 200 350 240 Q355 260 340 280" stroke="#FFF" stroke-width="20" fill="none" stroke-linecap="round"/>
                    
                    <!-- Hands -->
                    <ellipse cx="220" cy="285" rx="12" ry="10" fill="#F5D0C5"/>
                    <ellipse cx="340" cy="285" rx="12" ry="10" fill="#F5D0C5"/>
                    
                    <!-- Decorative background blob -->
                    <path d="M180 80 Q300 50 380 100 Q420 150 380 220 Q320 180 250 200 Q180 220 150 180 Q120 140 180 80" fill="#D4B8E0" opacity="0.4"/>
                </svg>
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
                            <svg viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg">
                                <!-- Shield background -->
                                <path d="M30 5 L50 12 L50 30 Q50 50 30 55 Q10 50 10 30 L10 12 Z" fill="#2196F3"/>
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

                <div class="version">V.3.37.0</div>
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
