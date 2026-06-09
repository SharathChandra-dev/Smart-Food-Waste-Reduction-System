@extends('layouts.app')

@section('styles')

@vite('resources/css/User/food.css')

@endsection

@section('content')

<section class="food-page">

    <div class="page-header">

        <div>

            <h1>Food Management</h1>

            <p>
                Manage your food items,
                expiry dates and calorie tracking.
            </p>

        </div>

        <a href="{{ route('food.create') }}" class="sfwr-btn">
            Add Food
        </a>

    </div>

    <!-- SEARCH -->

    <div class="search-bar">

        <input
            type="text"
            placeholder="Search food items..."
        >

    </div>

    <!-- TABLE -->

    <div class="food-table sfwr-card">

        <table>

            <thead>

                <tr>

                    <th>Food Name</th>

                    <th>Category</th>

                    <th>Expiry Date</th>

                    <th>Calories</th>

                    <th>Status</th>

                    <th>Actions</th>

                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>Milk</td>

                    <td>Dairy</td>

                    <td>2026-05-30</td>

                    <td>120</td>

                    <td>
                        <span class="badge-warning">
                            Expiring Soon
                        </span>
                    </td>

                    <td class="actions">

                        <a href="{{ route('food.edit',1) }}"
                        class="edit-btn">
                            Edit
                        </a>

                        <button class="delete-btn">
                            Delete
                        </button>

                    </td>

                </tr>

                <tr>

                    <td>Rice</td>

                    <td>Groceries</td>

                    <td>2026-08-15</td>

                    <td>320</td>

                    <td>
                        <span class="badge-success">
                            Safe
                        </span>
                    </td>

                    <td class="actions">

                        <a href="{{ route('food.edit',1) }}"
                        class="edit-btn">
                            Edit
                        </a>

                        <button class="delete-btn">
                            Delete
                        </button>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</section>

@endsection