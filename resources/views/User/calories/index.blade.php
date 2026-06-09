@extends('layouts.app')

@section('styles')

@vite('resources/css/User/calories.css')

@endsection

@section('content')

<section class="calorie-page">

    <div class="page-header">

        <div>

            <h1>Calorie Tracker</h1>

            <p>
                Monitor your food intake and
                daily calorie consumption.
            </p>

        </div>

        <a href="{{ route('calories.create') }}"
        class="sfwr-btn">

            Add Intake

        </a>

    </div>

    <!-- SUMMARY CARDS -->

    <div class="summary-grid">

        <div class="summary-card">

            <i class="fa-solid fa-fire"></i>

            <h2>1850</h2>

            <p>Today's Calories</p>

        </div>

        <div class="summary-card">

            <i class="fa-solid fa-bowl-food"></i>

            <h2>12</h2>

            <p>Total Food Items</p>

        </div>

        <div class="summary-card">

            <i class="fa-solid fa-chart-column"></i>

            <h2>2200</h2>

            <p>Weekly Average</p>

        </div>

    </div>

    <!-- TABLE -->

    <div class="table-card">

        <table>

            <thead>

                <tr>

                    <th>Food Item</th>

                    <th>Quantity</th>

                    <th>Calories</th>

                    <th>Date</th>

                    <th>Actions</th>

                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>Rice Bowl</td>

                    <td>2</td>

                    <td>450</td>

                    <td>2026-05-26</td>

                    <td class="actions">

                        <a href="{{ route('calories.edit',1) }}"
                        class="edit-btn">

                            Edit

                        </a>

                        <button
                            class="delete-btn"
                            onclick="deleteIntake()"
                        >
                            Delete
                        </button>

                    </td>

                </tr>

                <tr>

                    <td>Milk</td>

                    <td>1</td>

                    <td>120</td>

                    <td>2026-05-26</td>

                    <td class="actions">

                        <a href="{{ route('calories.edit',1) }}"
                        class="edit-btn">

                            Edit

                        </a>

                        <button
                            class="delete-btn"
                            onclick="deleteIntake()"
                        >
                            Delete
                        </button>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</section>

<script>

    function deleteIntake(){

        alert(
            "Backend delete functionality will be connected tomorrow."
        );

    }

</script>

@endsection