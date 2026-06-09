@extends('layouts.app')

@section('styles')

@vite('resources/css/User/food.css')

@endsection

@section('content')

<section class="form-page">

    <div class="form-card">

        <div class="form-top">

            <h1>Add Food Item</h1>

            <p>
                Add new food items with expiry
                tracking and calories.
            </p>

        </div>

        <form>

            <div class="form-grid">

                <div class="input-group">

                    <label>Food Name</label>

                    <input
                        type="text"
                        placeholder="Enter food name"
                    >

                </div>

                <div class="input-group">

                    <label>Category</label>

                    <select>

                        <option>Dairy</option>

                        <option>Vegetables</option>

                        <option>Groceries</option>

                        <option>Fruits</option>

                    </select>

                </div>

                <div class="input-group">

                    <label>Expiry Date</label>

                    <input type="date">

                </div>

                <div class="input-group">

                    <label>Calories</label>

                    <input
                        type="number"
                        placeholder="Calories"
                    >

                </div>

            </div>

            <div class="checkbox-group">

                <input type="checkbox">

                <span>Mark as wasted food</span>

            </div>

            <button class="sfwr-btn">

                Save Food Item

            </button>

        </form>

    </div>

</section>

@endsection