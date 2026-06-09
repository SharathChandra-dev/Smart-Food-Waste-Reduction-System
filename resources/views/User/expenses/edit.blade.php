@extends('layouts.app')

@section('styles')

@vite('resources/css/User/expenses.css')

@endsection

@section('content')

<section class="expense-form-page">

    <div class="expense-form-card">

        <div class="form-top">

            <h1>Edit Expense</h1>

            <p>
                Update your expense details.
            </p>

        </div>

        <form>

            <div class="form-grid">

                <div class="input-group">

                    <label>Amount (€)</label>

                    <input
                        type="number"
                        value="45"
                    >

                </div>

                <div class="input-group">

                    <label>Category</label>

                    <select>

                        <option selected>
                            Groceries
                        </option>

                        <option>Dairy</option>

                        <option>Vegetables</option>

                    </select>

                </div>

                <div class="input-group">

                    <label>Date</label>

                    <input
                        type="date"
                        value="2026-05-26"
                    >

                </div>

                <div class="input-group">

                    <label>Status</label>

                    <select>

                        <option selected>
                            Paid
                        </option>

                        <option>Pending</option>

                    </select>

                </div>

            </div>

            <button class="sfwr-btn">

                Update Expense

            </button>

        </form>

    </div>

</section>

@endsection