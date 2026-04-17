<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobSphere — Find Your Dream Job</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Source Sans 3', sans-serif; background: #f5f6fa; color: #2c3e50; }

        /* NAV */
        .nav { background: #2c3e50; border-bottom: 3px solid #3498db; padding: 0 40px; display: flex; justify-content: space-between; align-items: center; height: 64px; position: sticky; top: 0; z-index: 100; box-shadow: 0 2px 8px rgba(0,0,0,0.2); }
        .nav-brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .nav-brand-icon { width: 36px; height: 36px; background: #3498db; border-radius: 6px; display: flex; align-items: center; justify-content: center; }
        .nav-brand-name { font-family: 'Playfair Display', serif; font-size: 1.3rem; font-weight: 700; color: white; }
        .nav-links { display: flex; align-items: center; gap: 8px; }
        .nav-link { padding: 8px 16px; color: rgba(255,255,255,0.8); text-decoration: none; font-size: 0.9rem; font-weight: 500; border-radius: 4px; transition: all 0.2s; }
        .nav-link:hover { color: white; background: rgba(255,255,255,0.1); }
        .nav-btn { padding: 8px 20px; background: #3498db; color: white; text-decoration: none; font-size: 0.9rem; font-weight: 600; border-radius: 4px; transition: background 0.2s; }
        .nav-btn:hover { background: #2980b9; }

        /* HERO */
        .hero { background: linear-gradient(135deg, #2c3e50 0%, #1a252f 50%, #2980b9 100%); padding: 90px 40px; text-align: center; color: white; position: relative; overflow: hidden; }
        .hero::before { content: ''; position: absolute; top: -100px; right: -100px; width: 500px; height: 500px; background: rgba(52,152,219,0.1); border-radius: 50%; }
        .hero::after { content: ''; position: absolute; bottom: -80px; left: -80px; width: 350px; height: 350px; background: rgba(255,255,255,0.04); border-radius: 50%; }
        .hero-content { position: relative; z-index: 1; max-width: 700px; margin: 0 auto; }
        .hero-badge { display: inline-block; background: rgba(52,152,219,0.25); border: 1px solid rgba(52,152,219,0.5); color: #81ecec; padding: 6px 18px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; margin-bottom: 24px; letter-spacing: 0.5px; }
        .hero h1 { font-family: 'Playfair Display', serif; font-size: 3.2rem; font-weight: 700; line-height: 1.2; margin-bottom: 20px; }
        .hero p { font-size: 1.15rem; opacity: 0.88; margin-bottom: 40px; line-height: 1.7; }
        .hero-search { background: white; border-radius: 8px; padding: 20px 24px; max-width: 680px; margin: 0 auto 32px; display: flex; gap: 12px; flex-wrap: wrap; box-shadow: 0 8px 30px rgba(0,0,0,0.2); }
        .hero-search input, .hero-search select { flex: 1; min-width: 180px; padding: 12px 16px; border: 1.5px solid #dcdde1; border-radius: 6px; font-size: 0.95rem; font-family: inherit; color: #2c3e50; }
        .hero-search input:focus, .hero-search select:focus { outline: none; border-color: #3498db; }
        .hero-search-btn { padding: 12px 28px; background: #2c3e50; color: white; border: none; border-radius: 6px; font-size: 0.95rem; font-weight: 600; cursor: pointer; transition: background 0.2s; white-space: nowrap; }
        .hero-search-btn:hover { background: #3498db; }
        .hero-cta { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }
        .btn-hero-primary { padding: 13px 32px; background: #3498db; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 1rem; transition: all 0.2s; }
        .btn-hero-primary:hover { background: #2980b9; transform: translateY(-2px); }
        .btn-hero-outline { padding: 13px 32px; background: transparent; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 1rem; border: 2px solid rgba(255,255,255,0.5); transition: all 0.2s; }
        .btn-hero-outline:hover { border-color: white; background: rgba(255,255,255,0.1); }

        /* STATS */
        .stats { background: white; padding: 40px; border-bottom: 1px solid #dcdde1; }
        .stats-inner { max-width: 900px; margin: 0 auto; display: flex; justify-content: center; gap: 60px; flex-wrap: wrap; }
        .stat-item { text-align: center; }
        .stat-num { font-family: 'Playfair Display', serif; font-size: 2.4rem; font-weight: 700; color: #2c3e50; }
        .stat-label { font-size: 0.9rem; color: #7f8c8d; margin-top: 4px; }

        /* SECTIONS */
        .section { padding: 70px 40px; }
        .section-alt { background: white; }
        .section-inner { max-width: 1200px; margin: 0 auto; }
        .section-header { text-align: center; margin-bottom: 48px; }
        .section-header h2 { font-family: 'Playfair Display', serif; font-size: 2.2rem; font-weight: 700; color: #2c3e50; margin-bottom: 12px; }
        .section-header p { color: #7f8c8d; font-size: 1rem; }

        /* JOB CARDS */
        .jobs-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 20px; }
        .job-card { background: white; border-radius: 6px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); border-top: 3px solid #3498db; transition: transform 0.2s, box-shadow 0.2s; }
        .job-card:hover { transform: translateY(-3px); box-shadow: 0 6px 20px rgba(0,0,0,0.1); }
        .job-card h3 { font-size: 1.1rem; font-weight: 600; color: #2c3e50; margin-bottom: 6px; }
        .job-card .company { color: #7f8c8d; font-size: 0.9rem; margin-bottom: 14px; }
        .job-tags { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 16px; }
        .job-tag { padding: 4px 12px; border-radius: 3px; font-size: 0.78rem; font-weight: 500; }
        .tag-type { background: #e8f4fc; color: #2980b9; }
        .tag-salary { background: #e8f8f0; color: #27ae60; }
        .job-card-footer { display: flex; justify-content: space-between; align-items: center; padding-top: 14px; border-top: 1px solid #dcdde1; }
        .job-card-footer span { font-size: 0.82rem; color: #7f8c8d; }
        .btn-card { padding: 7px 16px; background: #2c3e50; color: white; text-decoration: none; border-radius: 4px; font-size: 0.85rem; font-weight: 500; transition: background 0.2s; }
        .btn-card:hover { background: #3498db; }

        /* HOW IT WORKS */
        .how-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 30px; }
        .how-card { text-align: center; padding: 32px 24px; background: white; border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); border-bottom: 3px solid #3498db; }
        .how-num { width: 52px; height: 52px; background: #2c3e50; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-family: 'Playfair Display', serif; font-size: 1.3rem; font-weight: 700; margin: 0 auto 18px; }
        .how-card h3 { font-size: 1.05rem; font-weight: 600; color: #2c3e50; margin-bottom: 10px; }
        .how-card p { font-size: 0.9rem; color: #7f8c8d; line-height: 1.6; }

        /* CTA */
        .cta { background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%); padding: 70px 40px; text-align: center; color: white; }
        .cta h2 { font-family: 'Playfair Display', serif; font-size: 2.2rem; font-weight: 700; margin-bottom: 16px; }
        .cta p { font-size: 1.05rem; opacity: 0.88; margin-bottom: 32px; }
        .cta-btns { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }
        .btn-cta-white { padding: 13px 32px; background: white; color: #2c3e50; text-decoration: none; border-radius: 6px; font-weight: 700; font-size: 1rem; transition: all 0.2s; }
        .btn-cta-white:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,0.2); }
        .btn-cta-outline { padding: 13px 32px; background: transparent; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 1rem; border: 2px solid rgba(255,255,255,0.6); transition: all 0.2s; }
        .btn-cta-outline:hover { border-color: white; background: rgba(255,255,255,0.1); }

        /* FOOTER */
        footer { background: #1a252f; color: rgba(255,255,255,0.6); padding: 30px 40px; text-align: center; font-size: 0.88rem; }
        footer a { color: rgba(255,255,255,0.7); text-decoration: none; margin: 0 12px; }
        footer a:hover { color: white; }
    </style>
</head>
<body>

<!-- Navigation -->
<nav class="nav">
    <a href="/" class="nav-brand">
        <div class="nav-brand-icon">
            <svg xmlns="http://www.w3.org/2000/svg" style="width:20px;height:20px;color:white;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
        </div>
        <span class="nav-brand-name">JobSphere</span>
    </a>
    <div class="nav-links">
        <a href="{{ route('jobs.index') }}" class="nav-link">Browse Jobs</a>
        @if(Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="nav-link">Log In</a>
                @if(Route::has('register'))
                    <a href="{{ route('register') }}" class="nav-btn">Get Started</a>
                @endif
            @endauth
        @endif
    </div>
</nav>

<!-- Hero -->
<section class="hero">
    <div class="hero-content">
        <div class="hero-badge">✦ Trusted by 50,000+ Job Seekers</div>
        <h1>Find Your Dream Job Today</h1>
        <p>Discover thousands of opportunities from top companies. Your next career move is just one click away.</p>
        <div class="hero-search">
            <input type="text" placeholder="Job title, keyword, or company...">
            <select>
                <option value="">All Locations</option>
                <option>Remote</option>
                <option>New York</option>
                <option>San Francisco</option>
                <option>London</option>
                <option>Toronto</option>
            </select>
            <button class="hero-search-btn" onclick="window.location='{{ route('jobs.index') }}'">Search Jobs</button>
        </div>
        <div class="hero-cta">
            <a href="{{ route('jobs.index') }}" class="btn-hero-primary">Browse All Jobs</a>
            @guest
            <a href="{{ route('register') }}" class="btn-hero-outline">Create Free Account</a>
            @endguest
        </div>
    </div>
</section>

<!-- Stats -->
<div class="stats">
    <div class="stats-inner">
        <div class="stat-item"><div class="stat-num">10,000+</div><div class="stat-label">Active Job Listings</div></div>
        <div class="stat-item"><div class="stat-num">5,000+</div><div class="stat-label">Partner Companies</div></div>
        <div class="stat-item"><div class="stat-num">50,000+</div><div class="stat-label">Registered Job Seekers</div></div>
        <div class="stat-item"><div class="stat-num">12,000+</div><div class="stat-label">Successful Placements</div></div>
    </div>
</div>

<!-- Featured Jobs -->
<section class="section">
    <div class="section-inner">
        <div class="section-header">
            <h2>Featured Opportunities</h2>
            <p>Hand-picked roles from top employers across industries</p>
        </div>
        <div class="jobs-grid">
            <div class="job-card">
                <h3>Senior Software Engineer</h3>
                <div class="company">Tech Innovations Inc.</div>
                <div class="job-tags">
                    <span class="job-tag tag-type">Full-time</span>
                    <span class="job-tag tag-salary">$100k – $140k</span>
                </div>
                <div class="job-card-footer">
                    <span>📍 Remote</span>
                    <a href="{{ route('jobs.index') }}" class="btn-card">View Details</a>
                </div>
            </div>
            <div class="job-card">
                <h3>Product Manager</h3>
                <div class="company">Startup Labs Co.</div>
                <div class="job-tags">
                    <span class="job-tag tag-type">Full-time</span>
                    <span class="job-tag tag-salary">$90k – $130k</span>
                </div>
                <div class="job-card-footer">
                    <span>📍 New York</span>
                    <a href="{{ route('jobs.index') }}" class="btn-card">View Details</a>
                </div>
            </div>
            <div class="job-card">
                <h3>UX / UI Designer</h3>
                <div class="company">Creative Studio Ltd.</div>
                <div class="job-tags">
                    <span class="job-tag tag-type">Contract</span>
                    <span class="job-tag tag-salary">$70k – $95k</span>
                </div>
                <div class="job-card-footer">
                    <span>📍 Remote</span>
                    <a href="{{ route('jobs.index') }}" class="btn-card">View Details</a>
                </div>
            </div>
        </div>
        <div style="text-align: center; margin-top: 36px;">
            <a href="{{ route('jobs.index') }}" style="display: inline-block; padding: 12px 32px; border: 2px solid #2c3e50; color: #2c3e50; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 0.95rem; transition: all 0.2s;" onmouseover="this.style.background='#2c3e50';this.style.color='white'" onmouseout="this.style.background='transparent';this.style.color='#2c3e50'">View All Jobs →</a>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="section section-alt">
    <div class="section-inner">
        <div class="section-header">
            <h2>How JobSphere Works</h2>
            <p>Get hired in four simple steps</p>
        </div>
        <div class="how-grid">
            <div class="how-card"><div class="how-num">1</div><h3>Create Your Profile</h3><p>Sign up free and build a professional profile that stands out to employers.</p></div>
            <div class="how-card"><div class="how-num">2</div><h3>Browse & Search</h3><p>Explore thousands of jobs filtered by location, type, and salary range.</p></div>
            <div class="how-card"><div class="how-num">3</div><h3>Apply with Ease</h3><p>Submit your application with your resume in just a few clicks.</p></div>
            <div class="how-card"><div class="how-num">4</div><h3>Get Hired</h3><p>Chat directly with employers and track every application in real time.</p></div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta">
    <h2>Ready to Start Your Journey?</h2>
    <p>Join thousands of professionals who found their dream jobs through JobSphere.</p>
    <div class="cta-btns">
        @guest
        <a href="{{ route('register') }}" class="btn-cta-white">Create Free Account</a>
        @endguest
        <a href="{{ route('jobs.index') }}" class="btn-cta-outline">Browse Jobs</a>
    </div>
</section>

<!-- Footer -->
<footer>
    <div style="margin-bottom: 12px;">
        <a href="{{ route('jobs.index') }}">Browse Jobs</a>
        <a href="{{ route('login') }}">Login</a>
        @if(Route::has('register'))<a href="{{ route('register') }}">Register</a>@endif
    </div>
    <p>&copy; {{ date('Y') }} JobSphere. All rights reserved.</p>
</footer>

</body>
</html>
