<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>SFWR Admin Panel</title>

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

    <!-- FONT AWESOME -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <!-- CSS -->
    @vite('resources/css/Admin/admin.css')

</head>

<body>

    <!-- SIDEBAR -->

    <div class="admin-layout">

        <aside class="admin-sidebar">

            <div class="sidebar-top">

                <div class="admin-logo">

                    <i class="fa-solid fa-shield-halved"></i>

                    <div>
                        <h2>SFWR</h2>
                        <span>Admin Panel</span>
                    </div>

                </div>

                <button type="button" class="theme-toggle-btn admin-theme-toggle" id="adminThemeToggle" aria-label="Toggle theme">
                    <i class="fa-solid fa-sun"></i>
                </button>

            </div>

            <!-- MENU -->

            <div class="sidebar-menu">

                <a href="#" class="active">
                    <i class="fa-solid fa-chart-line"></i>
                    Dashboard
                </a>

                <a href="{{ route('admin.pending.food') }}">
                    <i class="fa-solid fa-bowl-food"></i>
                    Pending Food
                </a>

                <a href="#">
                    <i class="fa-solid fa-users"></i>
                    Users
                </a>

                <a href="{{ route('admin.headers') }}">
                    <i class="fa-solid fa-heading"></i>
                    Headers
                </a>

                <a href="#">
                    <i class="fa-solid fa-cart-shopping"></i>
                    Orders
                </a>

                <a href="#">
                    <i class="fa-solid fa-chart-pie"></i>
                    Analytics
                </a>

                <a href="{{ url('/') }}">
                    <i class="fa-solid fa-globe"></i>
                    User Website
                </a>

            </div>

        </aside>

        <!-- MAIN CONTENT -->

        <main class="admin-main">

            @yield('content')

        </main>

    </div>

    <script>
        const adminThemeButtons = document.querySelectorAll('.theme-toggle-btn');

        function setAdminTheme(theme) {
            const dark = theme === 'dark';
            document.body.classList.toggle('dark-mode', dark);

            adminThemeButtons.forEach(btn => {
                btn.innerHTML = '<i class="fa-solid fa-sun"></i>';
            });

            localStorage.setItem('sfwrTheme', theme);
        }

        const storedAdminTheme = localStorage.getItem('sfwrTheme')
            || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');

        setAdminTheme(storedAdminTheme);

        adminThemeButtons.forEach(button => {
            button.addEventListener('click', () => {
                const nextTheme = document.body.classList.contains('dark-mode') ? 'light' : 'dark';
                setAdminTheme(nextTheme);
            });
        });
    </script>

</body>
</html>