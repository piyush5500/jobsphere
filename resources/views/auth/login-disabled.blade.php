<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Disabled - JobSphere</title>
    <link rel="stylesheet" href="{{ asset('css/classic.css') }}">
    <style>
        body {
            font-family: 'Georgia', 'Times New Roman', serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }
        .login-box {
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 450px;
            text-align: center;
        }
        .login-box h1 {
            margin-bottom: 10px;
            font-size: 1.8rem;
            color: #2c3e50;
        }
        .login-box .subtitle {
            color: #7f8c8d;
            margin-bottom: 30px;
            font-style: italic;
        }
        .info-message {
            background: #e8f4f8;
            color: #2c3e50;
            padding: 20px;
            border-radius: 4px;
            margin-bottom: 20px;
            border: 1px solid #b8d4e3;
        }
        .info-message p {
            margin: 10px 0;
        }
        .btn-primary {
            display: inline-block;
            padding: 12px 24px;
            font-size: 1rem;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 3px;
            transition: background 0.3s;
        }
        .btn-primary:hover {
            background: #2980b9;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h1>Login Disabled</h1>
        <p class="subtitle">JobSphere</p>

        <div class="info-message">
            <p><strong>Employee login is currently disabled.</strong></p>
            <p>If you need access to the system, please contact your administrator to create an account for you.</p>
            <p>Only administrators can create new employee accounts.</p>
        </div>

        <a href="/" class="btn-primary">
            Go to Homepage
        </a>
    </div>
</body>
</html>
