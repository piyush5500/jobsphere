<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobSphere - Find Your Dream Job</title>
    @vite(['resources/css/app.css'])
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body style="font-family: 'Figtree', sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; margin: 0; padding: 0;">
    <!-- Navigation -->
    <nav style="background: white; padding: 15px 40px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <a href="/" style="font-size: 1.5rem; font-weight: bold; color: #2c3e50; text-decoration: none;">JobSphere</a>
        <div style="display: flex; gap: 20px; align-items: center;">
            <a href="{{ route('jobs.index') }}" style="text-decoration: none; color: #2c3e50; font-weight: 500;">Browse Jobs</a>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" style="text-decoration: none; color: #2c3e50; font-weight: 500;">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" style="text-decoration: none; color: #2c3e50; font-weight: 500;">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" style="padding: 10px 20px; background: #3498db; color: white; border-radius: 5px; text-decoration: none; font-weight: 500;">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <div style="padding: 80px 40px; text-align: center; color: white;">
        <h1 style="font-size: 3rem; margin-bottom: 20px;">Find Your Dream Job Today</h1>
        <p style="font-size: 1.2rem; margin-bottom: 40px; opacity: 0.9;">Discover thousands of job opportunities from top companies and startups</p>
        
        <!-- Search Box -->
        <div style="background: white; padding: 30px; border-radius: 10px; max-width: 800px; margin: 0 auto; display: flex; gap: 15px; flex-wrap: wrap;">
            <input type="text" placeholder="Job title or keyword" style="flex: 1; min-width: 200px; padding: 15px; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
            <select style="flex: 1; min-width: 200px; padding: 15px; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
                <option value="">All Locations</option>
                <option value="remote">Remote</option>
                <option value="new-york">New York</option>
                <option value="san-francisco">San Francisco</option>
                <option value="london">London</option>
            </select>
            <button style="padding: 15px 40px; background: #3498db; color: white; border: none; border-radius: 5px; font-size: 1rem; cursor: pointer;">Search Jobs</button>
        </div>
    </div>

    <!-- Stats Section -->
    <div style="background: white; padding: 40px; display: flex; justify-content: center; gap: 60px; flex-wrap: wrap;">
        <div style="text-align: center;">
            <div style="font-size: 2.5rem; font-weight: bold; color: #3498db;">10,000+</div>
            <div style="color: #7f8c8d; margin-top: 5px;">Job Listings</div>
        </div>
        <div style="text-align: center;">
            <div style="font-size: 2.5rem; font-weight: bold; color: #3498db;">5,000+</div>
            <div style="color: #7f8c8d; margin-top: 5px;">Companies</div>
        </div>
        <div style="text-align: center;">
            <div style="font-size: 2.5rem; font-weight: bold; color: #3498db;">50,000+</div>
            <div style="color: #7f8c8d; margin-top: 5px;">Job Seekers</div>
        </div>
        <div style="text-align: center;">
            <div style="font-size: 2.5rem; font-weight: bold; color: #3498db;">10,000+</div>
            <div style="color: #7f8c8d; margin-top: 5px;">Placements</div>
        </div>
    </div>

    <!-- Featured Jobs Section -->
    <div style="padding: 60px 40px; background: #f8f9fa;">
        <div style="text-align: center; margin-bottom: 40px;">
            <h2 style="font-size: 2rem; color: #2c3e50; margin-bottom: 10px;">Featured Jobs</h2>
            <p style="color: #7f8c8d;">Explore the latest job opportunities</p>
        </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; max-width: 1200px; margin: 0 auto;">
            <!-- Job Card 1 -->
            <div style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <h3 style="font-size: 1.2rem; color: #2c3e50; margin-bottom: 10px;">Software Engineer</h3>
                <p style="color: #7f8c8d; margin-bottom: 15px;">Tech Company Inc.</p>
                <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 15px;">
                    <span style="background: #e8f4fc; color: #2980b9; padding: 4px 12px; border-radius: 3px; font-size: 0.8rem;">Remote</span>
                    <span style="background: #f5f6fa; color: #7f8c8d; padding: 4px 12px; border-radius: 3px; font-size: 0.8rem;">$80k - $120k</span>
                </div>
                <a href="#" style="display: inline-block; padding: 8px 16px; background: #3498db; color: white; border-radius: 5px; text-decoration: none;">View Details</a>
            </div>
            <!-- Job Card 2 -->
            <div style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <h3 style="font-size: 1.2rem; color: #2c3e50; margin-bottom: 10px;">Product Manager</h3>
                <p style="color: #7f8c8d; margin-bottom: 15px;">Startup Labs</p>
                <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 15px;">
                    <span style="background: #e8f4fc; color: #2980b9; padding: 4px 12px; border-radius: 3px; font-size: 0.8rem;">Remote</span>
                    <span style="background: #f5f6fa; color: #7f8c8d; padding: 4px 12px; border-radius: 3px; font-size: 0.8rem;">$90k - $130k</span>
                </div>
                <a href="#" style="display: inline-block; padding: 8px 16px; background: #3498db; color: white; border-radius: 5px; text-decoration: none;">View Details</a>
            </div>
            <!-- Job Card 3 -->
            <div style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <h3 style="font-size: 1.2rem; color: #2c3e50; margin-bottom: 10px;">UX Designer</h3>
                <p style="color: #7f8c8d; margin-bottom: 15px;">Design Studio Co.</p>
                <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 15px;">
                    <span style="background: #e8f4fc; color: #2980b9; padding: 4px 12px; border-radius: 3px; font-size: 0.8rem;">Remote</span>
                    <span style="background: #f5f6fa; color: #7f8c8d; padding: 4px 12px; border-radius: 3px; font-size: 0.8rem;">$70k - $100k</span>
                </div>
                <a href="#" style="display: inline-block; padding: 8px 16px; background: #3498db; color: white; border-radius: 5px; text-decoration: none;">View Details</a>
            </div>
        </div>
        <div style="text-align: center; margin-top: 40px;">
            <a href="{{ route('jobs.index') }}" style="display: inline-block; padding: 12px 30px; background: transparent; border: 2px solid #3498db; color: #3498db; border-radius: 5px; text-decoration: none; font-weight: 500;">View All Jobs</a>
        </div>
    </div>

    <!-- CTA Section -->
    <div style="padding: 60px 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); text-align: center; color: white;">
        <h2 style="font-size: 2rem; margin-bottom: 15px;">Ready to Get Started?</h2>
        <p style="font-size: 1.1rem; margin-bottom: 30px; opacity: 0.9;">Join thousands of job seekers who found their dream jobs on JobSphere</p>
        @if (Route::has('register'))
            <a href="{{ route('register') }}" style="display: inline-block; padding: 15px 40px; background: white; color: #667eea; border-radius: 5px; text-decoration: none; font-weight: 600; font-size: 1.1rem;">Create an Account</a>
        @endif
    </div>

    <!-- Footer -->
    <footer style="background: #2c3e50; color: white; padding: 40px; text-align: center;">
        <p>&copy; {{ date('Y') }} JobSphere. All rights reserved.</p>
    </footer>
</body>
</html>
