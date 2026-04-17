<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — JobSphere</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Source+Sans+3:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Source Sans 3', sans-serif;
            min-height: 100vh;
            display: flex;
            background: #f5f6fa;
        }
        .left-panel {
            flex: 1;
            background: linear-gradient(160deg, #2c3e50 0%, #1a252f 60%, #2980b9 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px 40px;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .left-panel::before {
            content: '';
            position: absolute;
            top: -100px; right: -100px;
            width: 400px; height: 400px;
            background: rgba(52,152,219,0.15);
            border-radius: 50%;
        }
        .left-panel::after {
            content: '';
            position: absolute;
            bottom: -80px; left: -80px;
            width: 300px; height: 300px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
        }
        .left-content { position: relative; z-index: 1; text-align: center; max-width: 380px; }
        .brand { display: flex; align-items: center; justify-content: center; gap: 12px; margin-bottom: 48px; }
        .brand-icon { width: 48px; height: 48px; background: #3498db; border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .brand-name { font-family: 'Playfair Display', serif; font-size: 1.8rem; font-weight: 700; color: white; }
        .left-content h2 { font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 700; margin-bottom: 16px; line-height: 1.3; }
        .left-content p { font-size: 1rem; opacity: 0.85; line-height: 1.7; margin-bottom: 40px; }
        .feature-list { list-style: none; text-align: left; }
        .feature-list li { display: flex; align-items: center; gap: 12px; padding: 10px 0; font-size: 0.95rem; opacity: 0.9; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .feature-list li:last-child { border-bottom: none; }
        .feature-dot { width: 8px; height: 8px; background: #3498db; border-radius: 50%; flex-shrink: 0; }

        .right-panel {
            width: 480px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 48px;
            background: white;
            box-shadow: -4px 0 20px rgba(0,0,0,0.08);
        }
        .form-header { margin-bottom: 36px; }
        .form-header h1 { font-family: 'Playfair Display', serif; font-size: 1.9rem; font-weight: 700; color: #2c3e50; margin-bottom: 8px; }
        .form-header p { color: #7f8c8d; font-size: 0.95rem; }
        .form-group { margin-bottom: 22px; }
        .form-label { display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50; font-size: 0.9rem; }
        .form-input {
            width: 100%; padding: 12px 16px;
            border: 1.5px solid #dcdde1; border-radius: 6px;
            font-size: 0.95rem; font-family: inherit;
            color: #2c3e50; background: #fafafa;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-input:focus { outline: none; border-color: #3498db; background: white; box-shadow: 0 0 0 3px rgba(52,152,219,0.12); }
        .remember-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; }
        .remember-check { display: flex; align-items: center; gap: 8px; font-size: 0.9rem; color: #2c3e50; cursor: pointer; }
        .remember-check input { width: 16px; height: 16px; accent-color: #3498db; cursor: pointer; }
        .forgot-link { font-size: 0.88rem; color: #3498db; text-decoration: none; }
        .forgot-link:hover { text-decoration: underline; }
        .btn-submit {
            width: 100%; padding: 13px;
            background: #2c3e50; color: white;
            border: none; border-radius: 6px;
            font-size: 1rem; font-weight: 600;
            font-family: inherit; cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            letter-spacing: 0.3px;
        }
        .btn-submit:hover { background: #3498db; transform: translateY(-1px); }
        .divider { display: flex; align-items: center; gap: 12px; margin: 24px 0; }
        .divider-line { flex: 1; height: 1px; background: #dcdde1; }
        .divider-text { font-size: 0.82rem; color: #7f8c8d; }
        .register-link { text-align: center; font-size: 0.92rem; color: #7f8c8d; }
        .register-link a { color: #3498db; font-weight: 600; text-decoration: none; }
        .register-link a:hover { text-decoration: underline; }
        .alert-error { background: #fde8e8; color: #c0392b; padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; font-size: 0.9rem; border-left: 4px solid #e74c3c; }
        .alert-success { background: #d4edda; color: #155724; padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; font-size: 0.9rem; border-left: 4px solid #27ae60; }
        @media (max-width: 768px) {
            body { flex-direction: column; }
            .left-panel { display: none; }
            .right-panel { width: 100%; padding: 40px 24px; box-shadow: none; }
        }
    </style>
</head>
<body>
    <!-- Left Panel -->
    <div class="left-panel">
        <div class="left-content">
            <div class="brand">
                <div class="brand-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:26px;height:26px;color:white;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="brand-name">JobSphere</span>
            </div>
            <h2>Your Career Journey Starts Here</h2>
            <p>Connect with top employers, discover opportunities, and take the next step in your professional life.</p>
            <ul class="feature-list">
                <li><span class="feature-dot"></span> Thousands of verified job listings</li>
                <li><span class="feature-dot"></span> Direct messaging with employers</li>
                <li><span class="feature-dot"></span> Track all your applications</li>
                <li><span class="feature-dot"></span> Build a professional profile</li>
            </ul>
        </div>
    </div>

    <!-- Right Panel -->
    <div class="right-panel">
        <div class="form-header">
            <h1>Welcome Back</h1>
            <p>Sign in to your JobSphere account</p>
        </div>

        @if ($errors->any())
            <div class="alert-error">
                @foreach ($errors->all() as $error){{ $error }}<br>@endforeach
            </div>
        @endif

        @if (session('status'))
            <div class="alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="form-input" placeholder="you@example.com">
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" name="password" required class="form-input" placeholder="••••••••">
            </div>
            <div class="remember-row">
                <label class="remember-check">
                    <input type="checkbox" name="remember" id="remember">
                    Remember me
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                @endif
            </div>
            <button type="submit" class="btn-submit">Sign In to JobSphere</button>
        </form>

        <div class="divider">
            <div class="divider-line"></div>
            <span class="divider-text">New to JobSphere?</span>
            <div class="divider-line"></div>
        </div>

        <div class="register-link">
            Don't have an account? <a href="{{ route('register') }}">Create one free</a>
        </div>
    </div>
</body>
</html>
