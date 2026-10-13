@extends('admin.layout')

@section('styles')
    @vite('resources/css/Admin/admin_dashboard.css')
@endsection

@section('content')

<div class="dashboard-container">
    <div class="dashboard-hero">
        <div>
            <span class="dashboard-kicker">System Overview</span>
            <h1>Admin Dashboard</h1>
            <p>Monitor food inventory, category mix, expiry urgency, and platform activity from one clean workspace.</p>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">👥</div>
            <div class="stat-content">
                <h3>Total Users</h3>
                <p class="stat-number">{{ $totalUsers ?? 0 }}</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">🛡️</div>
            <div class="stat-content">
                <h3>Total Admins</h3>
                <p class="stat-number">{{ $totalAdmins ?? 0 }}</p>
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

    <div class="chart-section">
        <div class="section-header">
            <h2>Analytics Overview</h2>
            <p>Live breakdown of food categories and system activity.</p>
        </div>

        <div class="chart-grid">
            <div class="chart-card">
                <h3>Food Categories</h3>
                <canvas id="categoryChart"></canvas>
            </div>

            <div class="chart-card">
                <h3>System Overview</h3>
                <canvas id="overviewChart"></canvas>
            </div>
        </div>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

const categoryLabels = @json($foodCategoryLabels ?? []);
const categoryData = @json($foodCategoryData ?? []);
const categoryColors = [
    '#c68a5a',
    '#16a34a',
    '#3b82f6',
    '#f59e0b',
    '#8b5cf6',
    '#06b6d4',
    '#ef4444',
    '#64748b',
];

const categoryCtx = document.getElementById('categoryChart').getContext('2d');
new Chart(categoryCtx, {
    type: 'doughnut',
    data: {
        labels: categoryLabels.length ? categoryLabels : ['No categories yet'],
        datasets: [{
            data: categoryData.length ? categoryData : [1],
            backgroundColor: categoryLabels.length
                ? categoryLabels.map((_, index) => categoryColors[index % categoryColors.length])
                : ['#cbd5e1'],
            borderColor: '#ffffff',
            borderWidth: 3,
        }]
    },
    options: {
        responsive: true,
        cutout: '62%',
        plugins: {
            legend: { position: 'bottom' }
        }
    }
});

const overviewCtx = document.getElementById('overviewChart').getContext('2d');
new Chart(overviewCtx, {
    type: 'bar',
    data: {
        labels: ['Users', 'Admins', 'Food Items', 'Expiring Soon', 'Headers'],
        datasets: [{
            label: 'Count',
            data: [{{ $totalUsers ?? 0 }}, {{ $totalAdmins ?? 0 }}, {{ $totalFoods ?? 0 }}, {{ $totalExpiringSoon ?? 0 }}, {{ $totalHeaders ?? 0 }}],
            backgroundColor: ['#3b82f6', '#0f766e', '#8b5cf6', '#f59e0b', '#06b6d4'],
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1 } }
        }
    }
});

</script>

@endsection
