@extends('layouts.app')

@section('styles')

@vite([
    'resources/css/User/global.css',
    'resources/css/User/foods.css'
])

@endsection

@section('content')

<section class="hero-section">
    <div class="hero-content">
        <span class="hero-badge">Smart Food Waste Reducer</span>

        <h1>Share surplus food before it goes to waste.</h1>

        <p>
            SFWR helps communities publish available food, request items quickly,
            and coordinate pickup while freshness still matters.
        </p>

        <div class="hero-buttons">
            @auth
                <a href="{{ route('foods.index') }}" class="primary-btn">
                    <i class="fa-solid fa-bowl-food"></i>
                    Browse Food
                </a>
            @else
                <a href="{{ route('login') }}" class="primary-btn">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i>
                    Login to Browse
                </a>

                <a href="{{ route('register') }}" class="secondary-btn">
                    Create Account
                </a>
            @endauth
        </div>
    </div>

    <div class="hero-panel">
        <div class="hero-panel-top">
            <span>Live Community Flow</span>
            <strong>Available Today</strong>
        </div>

        <div class="impact-grid">
            <div>
                <strong>Fresh</strong>
                <span>Color-coded status</span>
            </div>
            <div>
                <strong>Fast</strong>
                <span>One-click requests</span>
            </div>
            <div>
                <strong>Local</strong>
                <span>Pickup details</span>
            </div>
        </div>
    </div>
</section>

<section class="value-section">
    <div class="section-title">
        <h2>Built for clear decisions</h2>
        <p>Users see the essential details first: freshness, quantity, pickup, and contact.</p>
    </div>

    <div class="value-grid">
        <div class="value-card">
            <i class="fa-solid fa-clock"></i>
            <h3>Freshness First</h3>
            <p>Expiry status makes urgent items easy to identify at a glance.</p>
        </div>

        <div class="value-card">
            <i class="fa-solid fa-location-dot"></i>
            <h3>Pickup Ready</h3>
            <p>Location and WhatsApp contact stay visible on every food card.</p>
        </div>

        <div class="value-card">
            <i class="fa-solid fa-chart-simple"></i>
            <h3>Managed Cleanly</h3>
            <p>Admins can track categories, inventory, and expiring items from a focused dashboard.</p>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="cta-card">
        <h2>Turn surplus into shared value.</h2>
        <p>
            Browse available food near you and help reduce avoidable waste in the community.
        </p>

        <a href="{{ route('foods.index') }}" class="primary-btn">
            View Available Food
        </a>
    </div>
</section>

<section class="location-section">
    <div class="section-title">
        <h2>Find Us</h2>
        <p>Visit SRH Campus Munich and connect with the SFWR initiative.</p>
    </div>

    <div class="location-wrapper">
        <div class="map-box">
            <iframe
                src="https://maps.google.com/maps?q=SRH%20Campus%20Munich&t=&z=13&ie=UTF8&iwloc=&output=embed"
                allowfullscreen=""
                loading="lazy">
            </iframe>
        </div>

        <div class="location-info">
            <h3>SRH Campus Munich</h3>

            <p>
                Supporting sustainable redistribution with simple posting,
                requesting, and pickup coordination.
            </p>

            <div class="info-item">
                <i class="fa-solid fa-location-dot"></i>
                <a href="https://www.google.com/maps/place/SRH+Campus+Munich/@48.0961494,11.5088421,17z/data=!3m1!4b1!4m6!3m5!1s0x479dd98aaf6b661f:0x3afeab762b633b34!8m2!3d48.0961494!4d11.511417!16s%2Fg%2F11x_pdplc8?entry=ttu&g_ep=EgoyMDI2MDUyNy4wIKXMDSoASAFQAw%3D%3D" target="_blank" rel="noopener noreferrer">
                    SRH Campus Munich
                </a>
            </div>

            <div class="info-item">
                <i class="fa-solid fa-envelope"></i>
                <a href="mailto:Sharath.workdev@gmail.com">Sharath.workdev@gmail.com</a>
            </div>

            <div class="info-item">
                <i class="fa-solid fa-phone"></i>
                +49 155 10323692
            </div>
        </div>
    </div>
</section>

<section class="contact-section" id="contact">
    <div class="section-title">
        <h2>Contact Admin</h2>
        <p>Send a message to the administrator for questions, partnerships, or support.</p>
    </div>

    <div class="contact-wrapper">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('contact.submit') }}" method="POST" class="contact-form">
            @csrf

            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" placeholder="Enter your full name" required>
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label>Message</label>
                <textarea name="message" rows="6" placeholder="Write your message..." required></textarea>
            </div>

            <button type="submit" class="primary-btn">
                Send Message
            </button>
        </form>
    </div>
</section>

@endsection
