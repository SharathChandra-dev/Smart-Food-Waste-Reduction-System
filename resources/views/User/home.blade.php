@extends('layouts.app')

@section('styles')

@vite([
    'resources/css/User/global.css',
    'resources/css/User/foods.css'
])

@endsection

@section('content')

<!-- HERO SECTION -->

<section class="hero-section">

    <div class="hero-overlay"></div>

    <div class="hero-content">

        <span class="hero-badge">
            Smart Food Waste Reducer
        </span>

        <h1>
            Reduce Food Waste <br>
            Share Surplus Food
        </h1>

        <p>
            Connect with local communities,
            discover available food items,
            and contribute toward a smarter,
            sustainable future.
        </p>

        <div class="hero-buttons">

            @auth
                <a href="{{ route('foods.index') }}"
                class="primary-btn">

                    Explore Foods

                </a>
            @else
                <a href="{{ route('login') }}"
                class="primary-btn">

                    Login to Explore Foods

                </a>
            @endauth

        </div>

    </div>

</section>


<!-- FEATURED FOODS -->

<section class="foods-section">

    <!-- <div class="section-title">

        <h2>Featured Foods</h2>

        <p>
            Available food items around you
        </p>

    </div> -->


</section>

<!-- CTA -->

<section class="cta-section">

    <div class="cta-card">

        <h2>
            Join The Fight Against Food Waste
        </h2>

        <p>
            Consume surplus food and help local
            communities reduce unnecessary waste.
        </p>

        <!-- <a href="{{ route('register') }}"
        class="primary-btn">

            Get Started

        </a> -->

    </div>

</section>

<!-- LOCATION SECTION -->

<section class="location-section">

    <div class="section-title">

        <h2>Find Us</h2>

        <p>
            Visit SRH Campus Munich and connect
            with our sustainable food initiative.
        </p>

    </div>

    <div class="location-wrapper">

        <!-- MAP -->

        <div class="map-box">

            <iframe
                src="https://maps.google.com/maps?q=SRH%20Campus%20Munich&t=&z=13&ie=UTF8&iwloc=&output=embed"
                allowfullscreen=""
                loading="lazy">
            </iframe>

        </div>

        <!-- LOCATION INFO -->

        <div class="location-info">

            <h3>
                SRH Campus Munich
            </h3>

            <p>
                Located at SRH Campus Munich, supporting sustainable food redistribution
                and community impact.
            </p>

            <div class="info-item">
                <i class="fa-solid fa-location-dot"></i>
                <a href="https://www.google.com/maps/place/SRH+Campus+Munich/@48.0961494,11.5088421,17z/data=!3m1!4b1!4m6!3m5!1s0x479dd98aaf6b661f:0x3afeab762b633b34!8m2!3d48.0961494!4d11.511417!16s%2Fg%2F11x_pdplc8?entry=ttu&g_ep=EgoyMDI2MDUyNy4wIKXMDSoASAFQAw%3D%3D" target="_blank" rel="noopener noreferrer">
                    SRH Campus Munich
                </a>
            </div>

            <div class="info-item">
                <i class="fa-solid fa-envelope"></i>
                <a href="mailto:Nilesh.Dokuparthi@stud.srh-university.de">Mail</a>
            </div>

            <div class="info-item">
                <i class="fa-solid fa-phone"></i>
                +49 123 456 789
            </div>

        </div>

    </div>

</section>

<!-- CONTACT SECTION -->

<section class="contact-section" id="contact">

    <div class="section-title">

        <h2>Contact Admin</h2>

        <p>
            Have questions or want to contribute?
            Send a message to the administrator.
        </p>

    </div>

    <div class="contact-wrapper">

        @if(session('success'))
            <div class="alert alert-success" style="margin-bottom: 20px; padding: 16px; background: #e8f7ea; border: 1px solid #b9e2c2; color: #256029;">
                {{ session('success') }}
            </div>
        @endif

        <form
            action="{{ route('contact.submit') }}"
            method="POST"
            class="contact-form">

            @csrf

            <div class="form-group">

                <label>Full Name</label>

                <input
                    type="text"
                    name="name"
                    placeholder="Enter your full name"
                    required>

            </div>

            <div class="form-group">

                <label>Email Address</label>

                <input
                    type="email"
                    name="email"
                    placeholder="Enter your email"
                    required>

            </div>

            <!-- <div class="form-group">

                <label>Subject</label>

                <input
                    type="text"
                    name="subject"
                    placeholder="Enter subject"
                    required>

            </div> -->

            <div class="form-group">

                <label>Message</label>

                <textarea
                    name="message"
                    rows="6"
                    placeholder="Write your message..."
                    required></textarea>

            </div>

            <button type="submit"
            class="primary-btn">

                Send Message

            </button>

        </form>

    </div>

</section>

@endsection