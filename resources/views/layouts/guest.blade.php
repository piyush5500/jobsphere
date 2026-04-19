<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'JobSphere') }}</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preload" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Source+Sans+3:wght@400;500;600&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Source+Sans+3:wght@400;500;600&display=swap" rel="stylesheet"></noscript>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body style="font-family: 'Source Sans 3', sans-serif; background: linear-gradient(135deg, #2c3e50 0%, #1a252f 60%, #2980b9 100%); min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 24px;">

        <!-- Brand -->
        <a href="/" style="display: flex; align-items: center; gap: 10px; text-decoration: none; margin-bottom: 28px;">
            <div style="width: 40px; height: 40px; background: #3498db; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:22px;height:22px;color:white;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <span style="font-family: 'Playfair Display', serif; font-size: 1.5rem; font-weight: 700; color: white;">JobSphere</span>
        </a>

        <!-- Card -->
        <div style="width: 100%; max-width: 440px; background: white; border-radius: 10px; box-shadow: 0 12px 40px rgba(0,0,0,0.25); padding: 40px; border-top: 4px solid #3498db;">
            {{ $slot }}
        </div>

        <p style="margin-top: 20px; color: rgba(255,255,255,0.5); font-size: 0.82rem;">&copy; {{ date('Y') }} JobSphere. All rights reserved.</p>
    </body>
</html>
