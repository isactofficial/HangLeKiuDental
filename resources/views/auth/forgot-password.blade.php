<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lupa Password - Hanglekiu Dental Clinic</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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

        .container {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 40px 35px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
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

        .logo-text {
            font-size: 32px;
            font-weight: 700;
            color: #2196F3;
        }

        h2 {
            text-align: center;
            font-size: 20px;
            color: #333;
            margin-bottom: 15px;
        }

        p {
            text-align: center;
            font-size: 14px;
            color: #666;
            margin-bottom: 25px;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 25px;
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

        .submit-btn {
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
        }

        .submit-btn:hover {
            background: linear-gradient(135deg, #4A93D0 0%, #2B72B4 100%);
            box-shadow: 0 4px 15px rgba(59, 130, 196, 0.4);
        }

        .back-link {
            text-align: center;
            margin-top: 25px;
        }

        .back-link a {
            color: #2196F3;
            text-decoration: none;
            font-size: 14px;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="logo">
                <div class="logo-container">
                    <div class="logo-icon">
                        <svg viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg">
                            <path d="M30 5 L50 12 L50 30 Q50 50 30 55 Q10 50 10 30 L10 12 Z" fill="#2196F3"/>
                            <rect x="26" y="18" width="8" height="24" rx="2" fill="white"/>
                            <rect x="18" y="26" width="24" height="8" rx="2" fill="white"/>
                        </svg>
                    </div>
                    <span class="logo-text">Hanglekiu Dental Clinic</span>
                </div>
            </div>

            <h2>Lupa Password</h2>
            <p>Masukkan email Anda dan kami akan mengirimkan link untuk reset password.</p>

            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        placeholder="Email" 
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                    >
                </div>

                <button type="submit" class="submit-btn">Kirim Link Reset Password</button>
            </form>

            <div class="back-link">
                <a href="{{ route('login') }}">← Kembali ke Login</a>
            </div>
        </div>
    </div>
</body>
</html>
