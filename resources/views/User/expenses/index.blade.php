@extends('layouts.app')

@section('styles')

@vite('resources/css/User/expenses.css')

@endsection

@section('content')

<section class="expenses-page">

    <!-- PAGE HEADER -->

    <div class="page-header">

        <div>

            <h1>Expense Tracker</h1>

            <p>
                Track your food expenses and
                monitor monthly spending.
            </p>

        </div>

        <a href="{{ route('expenses.create') }}"
        class="sfwr-btn">

            Add Expense

        </a>

    </div>

    <!-- SUMMARY CARDS -->

    <div class="expense-cards">

        <div class="expense-card">

            <i class="fa-solid fa-wallet"></i>

            <h2>€450</h2>

            <p>Total Expenses</p>

        </div>

        <div class="expense-card">

            <i class="fa-solid fa-chart-line"></i>

            <h2>€120</h2>

            <p>This Week</p>

        </div>

        <div class="expense-card">

            <i class="fa-solid fa-basket-shopping"></i>

            <h2>Groceries</h2>

            <p>Highest Category</p>

        </div>

    </div>

    <!-- FILTERS -->

    <div class="filter-section">

        <input
            type="text"
            placeholder="Search expenses..."
        >

        <select>

            <option>All Categories</option>

            <option>Groceries</option>

            <option>Vegetables</option>

            <option>Dairy</option>

            <option>Snacks</option>

        </select>

    </div>

    <!-- TABLE -->

    <div class="expense-table sfwr-card">

        <table>

            <thead>

                <tr>

                    <th>Amount</th>

                    <th>Category</th>

                    <th>Date</th>

                    <th>Status</th>

                    <th>Actions</th>

                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>€45</td>

                    <td>Groceries</td>

                    <td>2026-05-26</td>

                    <td>
                        <span class="paid-badge">
                            Paid
                        </span>
                    </td>

                    <td class="actions">

                        <a href="{{ route('expenses.edit',1) }}"
                            class="edit-btn">

                            Edit

                        </a>

                        <!-- <form action="#" method="POST">

                            @csrf
                            @method('DELETE')

                            <button class="delete-btn">

                                Delete

                            </button>

                        </form> -->
                        <button
                            class="delete-btn"
                            onclick="showDeleteMessage()"
                        >
                            Delete
                        </button>

                    </td>

                </tr>

                <tr>

                    <td>€20</td>

                    <td>Dairy</td>

                    <td>2026-05-24</td>

                    <td>
                        <span class="paid-badge">
                            Paid
                        </span>
                    </td>

                    <td class="actions">

                        <a href="{{ route('expenses.edit',1) }}"
                            class="edit-btn">

                            Edit

                        </a>

                        <button
                            class="delete-btn"
                            onclick="showDeleteMessage()"
                        >
                              Delete
                        </button>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</section>

@endsection
<script>

    function showDeleteMessage(){

        alert("Backend delete functionality will be connected tomorrow.");

    }

</script>