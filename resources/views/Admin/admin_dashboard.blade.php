@extends('admin.layout')

@section('styles')
    @vite('resources/css/Admin/admin_dashboard.css')
@endsection

@section('content')

<div class="dashboard-container">
    <h1>Admin Dashboard</h1>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">👥</div>
            <div class="stat-content">
                <h3>Total Users</h3>
                <p class="stat-number">{{ $totalUsers ?? 0 }}</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">🍽️</div>
            <div class="stat-content">
                <h3>Food Items</h3>
                <p class="stat-number">{{ $totalFoods ?? 0 }}</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">🪧</div>
            <div class="stat-content">
                <h3>Header Widgets</h3>
                <p class="stat-number">{{ $totalHeaders ?? 0 }}</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">📦</div>
            <div class="stat-content">
                <h3>Expiring Soon</h3>
                <p class="stat-number">{{ $totalExpiringSoon ?? 0 }}</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">⚙️</div>
            <div class="stat-content">
                <h3>System Status</h3>
                <p class="stat-status">Active</p>
            </div>
        </div>
    </div>

    <div class="welcome-section">
        <h2>Welcome to SFWR Admin Panel</h2>
        <p>Manage your system efficiently with our comprehensive admin dashboard. Navigate through the sidebar to manage users and food items.</p>
    </div>

    <div class="expiring-section">
        <div class="section-header">
            <h2>Expiring Soon</h2>
            <p>Products expiring within the next 7 days.</p>
        </div>

        @if(isset($expiringFoods) && $expiringFoods->count() > 0)
            <div class="expiring-list">
                @foreach($expiringFoods as $food)
                    <div class="expiring-item">
                        <div>
                            <strong>{{ $food->foodname_sfwr }}</strong>
                            <p>{{ $food->fooddescription_sfwr ?? 'No description available.' }}</p>
                        </div>
                        <div class="expiring-meta">
                            <span>Expiry: {{ \Carbon\Carbon::parse($food->expiry_date_sfwr)->format('M d, Y') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-urgent-items">
                <p>No products are expiring within the next 7 days.</p>
            </div>
        @endif
    </div>
</div>

@endsection
