<header class="main-header">

    <div class="header-container">

        <!-- LOGO -->

        <a href="{{ route('home') }}" class="logos">
            <h2>{{ $userHeaderTitle ?? 'Smart Food Waste Reducer(SFWR)' }}</h2>
        </a>

        <!-- DESKTOP NAV -->

        <nav class="desktop-nav">

            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                Home
            </a>

            @auth
                <a href="{{ route('foods.index') }}" class="{{ request()->routeIs('foods.index') ? 'active' : '' }}">
                    Foods
                </a>
            @endauth

            <a href="{{ route('home') }}#contact">
                Contact
            </a>

        </nav>

        <!-- AUTH BUTTONS -->

        <div class="header-buttons">
            @guest
                <a href="{{ route('login') }}" class="login-btn">Login</a>
                <a href="{{ route('register') }}" class="register-btn">Register</a>
            @else
                @if(Auth::user()->role_sfwr === 'Admin')
                    <a href="{{ route('dashboard') }}" class="login-btn">Dashboard</a>
                @endif
                <form method="POST" action="{{ route('admin.logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="register-btn" style="border:none; cursor:pointer;">Logout</button>
                </form>
            @endguest

            <button type="button" class="theme-toggle-btn" id="themeToggle" aria-label="Toggle theme">
                <i class="fa-solid fa-sun"></i>
            </button>
        </div>

        <!-- MOBILE MENU BUTTON -->

        <div class="menu-toggle"
        id="menuToggle">

            <i class="fa-solid fa-bars"></i>

        </div>

    </div>

    <!-- MOBILE MENU -->

    <div class="mobile-menu"
    id="mobileMenu">

        <div class="mobile-close"
        id="closeMenu">

            <i class="fa-solid fa-xmark"></i>

        </div>

        <a href="{{ route('home') }}">
            Home
        </a>

        @auth
            <a href="{{ route('foods.index') }}">
                Foods
            </a>
        @endauth

        <a href="{{ route('home') }}#contact">
            Contact
        </a>

        @guest
            <a href="{{ route('login') }}">
                Login
            </a>

            <a href="{{ route('register') }}">
                Register
            </a>
        @else
            @if(Auth::user()->role_sfwr === 'Admin')
                <a href="{{ route('dashboard') }}">
                    Dashboard
                </a>
            @endif

            <form method="POST" action="{{ route('admin.logout') }}" style="display:inline;">
                @csrf
                <button type="submit" style="background:none; border:none; cursor:pointer; padding:0;">Logout</button>
            </form>
        @endguest

        <button type="button" class="theme-toggle-btn theme-toggle-mobile" id="mobileThemeToggle" aria-label="Toggle theme">
            <i class="fa-solid fa-sun"></i>
        </button>

    </div>

</header>

<script>

    const menuToggle =
    document.getElementById('menuToggle');

    const mobileMenu =
    document.getElementById('mobileMenu');

    const closeMenu =
    document.getElementById('closeMenu');

    menuToggle.addEventListener('click', () => {

        mobileMenu.classList.add('active');

    });

    closeMenu.addEventListener('click', () => {

        mobileMenu.classList.remove('active');

    });

    const themeButtons = document.querySelectorAll('.theme-toggle-btn');

    function setTheme(theme) {
        const dark = theme === 'dark';
        document.body.classList.toggle('dark-mode', dark);
        document.documentElement.style.colorScheme = dark ? 'dark' : 'light';

        themeButtons.forEach(btn => {
            btn.innerHTML = dark
                ? '<i class="fa-solid fa-sun"></i>'
                : '<i class="fa-solid fa-moon"></i>';
        });

        localStorage.setItem('sfwrTheme', theme);
    }

    const storedTheme = localStorage.getItem('sfwrTheme')
        || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');

    setTheme(storedTheme);

    themeButtons.forEach(button => {
        button.addEventListener('click', () => {
            const nextTheme = document.body.classList.contains('dark-mode') ? 'light' : 'dark';
            setTheme(nextTheme);
        });
    });

</script>
