@extends('layouts.app')

@section('styles')

@vite('resources/css/User/calories.css')

@endsection

@section('content')

<section class="calorie-form-page">

    <div class="calorie-form-card">

        <div class="form-top">

            <h1>Edit Intake</h1>

            <p>
                Update food intake details.
            </p>

        </div>

        <form>

            <div class="form-grid">

                <div class="input-group">

                    <label>Food Item</label>

                    <input
                        type="text"
                        value="Rice Bowl"
                    >

                </div>

                <div class="input-group">

                    <label>Quantity</label>

                    <input
                        type="number"
                        value="2"
                    >

                </div>

                <div class="input-group">

                    <label>Total Calories</label>

                    <input
                        type="number"
                        value="450"
                    >

                </div>

                <div class="input-group">

                    <label>Date</label>

                    <input
                        type="date"
                        value="2026-05-26"
                    >

                </div>

            </div>

            <button class="sfwr-btn">

                Update Intake

            </button>

        </form>

    </div>

</section>

@endsection