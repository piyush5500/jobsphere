<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — JobSphere</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Source+Sans+3:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Source Sans 3', sans-serif; min-height: 100vh; display: flex; background: #f5f6fa; }
        .left-panel {
            flex: 1;
            background: linear-gradient(160deg, #1a252f 0%, #2c3e50 50%, #27ae60 100%);
            display: flex; flex-direction: column; justify-content: center; align-items: center;
            padding: 60px 40px; color: white; position: relative; overflow: hidden;
        }
        .left-panel::before { content: ''; position: absolute; top: -80px; right: -80px; width: 350px; height: 350px; background: rgba(39,174,96,0.15); border-radius: 50%; }
        .left-panel::after { content: ''; position: absolute; bottom: -60px; left: -60px; width: 250px; height: 250px; background: rgba(255,255,255,0.05); border-radius: 50%; }
        .left-content { position: relative; z-index: 1; text-align: center; max-width: 380px; }
        .brand { display: flex; align-items: center; justify-content: center; gap: 12px; margin-bottom: 48px; }
        .brand-icon { width: 48px; height: 48px; background: #27ae60; border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .brand-name { font-family: 'Playfair Display', serif; font-size: 1.8rem; font-weight: 700; color: white; }
        .left-content h2 { font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 700; margin-bottom: 16px; line-height: 1.3; }
        .left-content p { font-size: 1rem; opacity: 0.85; line-height: 1.7; margin-bottom: 40px; }
        .steps { text-align: left; }
        .step { display: flex; align-items: flex-start; gap: 14px; padding: 12px 0; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .step:last-child { border-bottom: none; }
        .step-num { width: 28px; height: 28px; background: rgba(255,255,255,0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: 700; flex-shrink: 0; }
        .step-text { font-size: 0.92rem; opacity: 0.9; padding-top: 4px; }

        .right-panel { width: 520px; display: flex; flex-direction: column; justify-content: center; padding: 50px 48px; background: white; box-shadow: -4px 0 20px rgba(0,0,0,0.08); overflow-y: auto; }
        .form-header { margin-bottom: 30px; }
        .form-header h1 { font-family: 'Playfair Display', serif; font-size: 1.9rem; font-weight: 700; color: #2c3e50; margin-bottom: 8px; }
        .form-header p { color: #7f8c8d; font-size: 0.95rem; }
        .info-banner { background: #e8f8f0; border-left: 4px solid #27ae60; padding: 12px 16px; border-radius: 4px; margin-bottom: 24px; font-size: 0.88rem; color: #27ae60; font-weight: 500; }
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50; font-size: 0.9rem; }
        .form-input {
            width: 100%; padding: 12px 16px;
            border: 1.5px solid #dcdde1; border-radius: 6px;
            font-size: 0.95rem; font-family: inherit; color: #2c3e50; background: #fafafa;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-input:focus { outline: none; border-color: #27ae60; background: white; box-shadow: 0 0 0 3px rgba(39,174,96,0.12); }
        .btn-submit {
            width: 100%; padding: 13px;
            background: #2c3e50; color: white;
            border: none; border-radius: 6px;
            font-size: 1rem; font-weight: 600; font-family: inherit;
            cursor: pointer; transition: background 0.2s, transform 0.1s; letter-spacing: 0.3px;
        }
        .btn-submit:hover { background: #27ae60; transform: translateY(-1px); }
        .login-link { text-align: center; margin-top: 20px; font-size: 0.92rem; color: #7f8c8d; }
        .login-link a { color: #3498db; font-weight: 600; text-decoration: none; }
        .login-link a:hover { text-decoration: underline; }
        .alert-error { background: #fde8e8; color: #c0392b; padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; font-size: 0.9rem; border-left: 4px solid #e74c3c; }
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
            <h2>Join Thousands of Job Seekers</h2>
            <p>Create your free account and start applying to top companies today.</p>
            <div class="steps">
                <div class="step"><div class="step-num">1</div><div class="step-text">Create your free account in under 2 minutes</div></div>
                <div class="step"><div class="step-num">2</div><div class="step-text">Build your profile and upload your resume</div></div>
                <div class="step"><div class="step-num">3</div><div class="step-text">Browse and apply to thousands of jobs</div></div>
                <div class="step"><div class="step-num">4</div><div class="step-text">Track applications and chat with employers</div></div>
            </div>
        </div>
    </div>

    <!-- Right Panel -->
    <div class="right-panel">
        <div class="form-header">
            <h1>Create Your Account</h1>
            <p>Join JobSphere and find your next opportunity</p>
        </div>

        @if ($errors->any())
            <div class="alert-error">
                @foreach ($errors->all() as $error){{ $error }}<br>@endforeach
            </div>
        @endif

        <div class="info-banner">
            ✓ Registering as a Job Seeker — free forever
        </div>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">Full Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="form-input" placeholder="John Doe">
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required class="form-input" placeholder="you@example.com">
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" name="password" required class="form-input" placeholder="Min. 8 characters">
            </div>
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required class="form-input" placeholder="Repeat your password">
            </div>
            <button type="submit" class="btn-submit">Create My Account</button>
        </form>

        <div class="login-link">
            Already have an account? <a href="{{ route('login') }}">Sign in here</a>
        </div>
    </div>
</body>
</html>
