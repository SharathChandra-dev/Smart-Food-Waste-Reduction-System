@extends('layouts.app')

@section('styles')

@vite('resources/css/User/expenses.css')

@endsection

@section('content')

<section class="expense-form-page">

    <div class="expense-form-card">

        <div class="form-top">

            <h1>Add Expense</h1>

            <p>
                Record and categorize your
                food-related expenses.
            </p>

        </div>

        <form>

            <div class="form-grid">

                <div class="input-group">

                    <label>Amount (€)</label>

                    <input
                        type="number"
                        placeholder="Enter amount"
                    >

                </div>

                <div class="input-group">

                    <label>Category</label>

                    <select>

                        <option>Groceries</option>

                        <option>Dairy</option>

                        <option>Vegetables</option>

                        <option>Fruits</option>

                    </select>

                </div>

                <div class="input-group">

                    <label>Date</label>

                    <input type="date">

                </div>

                <div class="input-group">

                    <label>Payment Status</label>

                    <select>

                        <option>Paid</option>

                        <option>Pending</option>

                    </select>

                </div>

            </div>

            <button class="sfwr-btn">

                Save Expense

            </button>

        </form>

    </div>

</section>

@endsection