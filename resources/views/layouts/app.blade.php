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
    <body style="font-family: 'Source Sans 3', sans-serif; background-color: #f5f6fa; color: #2c3e50;">
        <div style="min-height: 100vh;">
            @include('layouts.navigation')

            @isset($header)
                <header style="background: #fff; border-bottom: 1px solid #dcdde1; box-shadow: 0 1px 3px rgba(0,0,0,0.06);">
                    <div style="max-width: 1400px; margin: 0 auto; padding: 18px 24px;">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
