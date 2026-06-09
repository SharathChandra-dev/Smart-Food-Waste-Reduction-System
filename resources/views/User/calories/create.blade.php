@extends('layouts.app')

@section('styles')

@vite('resources/css/User/calories.css')

@endsection

@section('content')

<section class="calorie-form-page">

    <div class="calorie-form-card">

        <div class="form-top">

            <h1>Add Food Intake</h1>

            <p>
                Record consumed food items
                and calorie values.
            </p>

        </div>

        <form>

            <div class="form-grid">

                <div class="input-group">

                    <label>Food Item</label>

                    <input
                        type="text"
                        placeholder="Enter food item"
                    >

                </div>

                <div class="input-group">

                    <label>Quantity</label>

                    <input
                        type="number"
                        placeholder="Enter quantity"
                    >

                </div>

                <div class="input-group">

                    <label>Total Calories</label>

                    <input
                        type="number"
                        placeholder="Enter calories"
                    >

                </div>

                <div class="input-group">

                    <label>Date</label>

                    <input type="date">

                </div>

            </div>

            <button class="sfwr-btn">

                Save Intake

            </button>

        </form>

    </div>

</section>

@endsection