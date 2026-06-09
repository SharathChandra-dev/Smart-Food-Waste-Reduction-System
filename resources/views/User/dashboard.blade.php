@extends('layouts.app')

@section('styles')

@vite('resources/css/User/dashboard.css')

@endsection

@section('content')

<section class="dashboard-page">

    <div class="dashboard-header">

        <h1>User Dashboard</h1>

        <p>
            Monitor food usage, expenses,
            calories, and reminders efficiently.
        </p>

    </div>

    <!-- TOP CARDS -->

    <div class="dashboard-cards">

        <div class="dashboard-card">
            <i class="fa-solid fa-bowl-food"></i>
            <h2>24</h2>
            <p>Total Food Items</p>
        </div>

        <div class="dashboard-card">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <h2>5</h2>
            <p>Expiring Soon</p>
        </div>

        <div class="dashboard-card">
            <i class="fa-solid fa-fire"></i>
            <h2>1800</h2>
            <p>Calories Today</p>
        </div>

        <div class="dashboard-card">
            <i class="fa-solid fa-wallet"></i>
            <h2>€250</h2>
            <p>Monthly Expenses</p>
        </div>

    </div>

    <!-- TABLE -->

    <div class="recent-food sfwr-card">

        <div class="section-top">

            <h2>Recent Food Items</h2>

            <button class="sfwr-btn">
                Add Food
            </button>

        </div>

        <table>

            <thead>

                <tr>

                    <th>Name</th>

                    <th>Category</th>

                    <th>Expiry</th>

                    <th>Calories</th>

                    <th>Status</th>

                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>Milk</td>

                    <td>Dairy</td>

                    <td>2026-05-28</td>

                    <td>120</td>

                    <td>
                        <span class="status warning">
                            Expiring Soon
                        </span>
                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</section>

@endsection