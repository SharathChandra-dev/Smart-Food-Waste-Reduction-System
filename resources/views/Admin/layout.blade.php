<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $adminHeaderTitle ?? 'SFWR Admin' }}</title>

    @vite('resources/css/Admin/layout.css')
    @yield('styles')
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <h2>{{ $adminHeaderTitle ?? 'SFWR Admin' }}</h2>
    <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
        @csrf
        <button type="submit" class="logout-btn">Logout</button>
    </form>
</div>

<!-- MAIN CONTAINER -->
<div class="container">
    <!-- SIDEBAR -->
    <aside class="sidebar">
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span>📊</span> Dashboard
            </a>
            <a href="{{ route('admin.users') }}" class="sidebar-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <span>👥</span> Users
            </a>
            <a href="{{ route('admin.food') }}" class="sidebar-link {{ request()->routeIs('admin.food*') ? 'active' : '' }}">
                <span>🍽️</span> Food Items
            </a>
            <a href="{{ route('admin.contacts') }}" class="sidebar-link {{ request()->routeIs('admin.contacts*') ? 'active' : '' }}">
                <span>✉️</span> Contact Requests
            </a>
            <a href="{{ route('admin.headers') }}" class="sidebar-link {{ request()->routeIs('admin.headers*') ? 'active' : '' }}">
                <span>🪧</span> Headers
            </a>
        </nav>
    </aside>

    <!-- CONTENT AREA -->
    <main class="content">
        <div class="bg-gradient"></div>
        @yield('content')
    </main>

</div>

<!-- FOOTER -->
<footer class="main-footer">

    <div class="footer-container">

        <!-- LEFT -->

        <div class="footer-box">

            <h2>SFWR</h2>

            <p>
                Smart Food Waste Reducer is a
                sustainable food redistribution
                platform helping communities
                reduce food wastage efficiently.
            </p>

        </div>

        <!-- CENTER -->

        <div class="footer-box">

            <h3>Quick Links</h3>

            <a href="{{ route('home') }}">
                Home
            </a>

            <a href="{{ route('foods.index') }}">
                Foods
            </a>

        </div>

        <!-- RIGHT -->

        <div class="footer-box">

            <h3>Contact</h3>

            <p><a href="https://www.google.com/maps/place/SRH+Campus+Munich/@48.0961494,11.5088421,17z/data=!3m1!4b1!4m6!3m5!1s0x479dd98aaf6b661f:0x3afeab762b633b34!8m2!3d48.0961494!4d11.511417!16s%2Fg%2F11x_pdplc8?entry=ttu&g_ep=EgoyMDI2MDUyNy4wIKXMDSoASAFQAw%3D%3D" target="_blank" rel="noopener noreferrer">SRH Campus Munich</a></p>

            <p><a href="mailto:Nilesh.Dokuparthi@stud.srh-university.de">Mail</a></p>

            <p>+49 123 456 789</p>

        </div>

    </div>

    <div class="footer-bottom">

        © 2026 Smart Food Waste Reducer.
        All Rights Reserved.

    </div>

</footer>

</body>
</html>
