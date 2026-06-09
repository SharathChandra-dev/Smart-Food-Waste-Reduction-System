@extends('layouts.app')

@section('styles')

@vite('resources/css/User/food.css')

@endsection

@section('content')

<section class="form-page">

    <div class="form-card">

        <div class="form-top">

            <h1>Edit Food Item</h1>

            <p>
                Update your food details.
            </p>

        </div>

        <form>

            <div class="form-grid">

                <div class="input-group">

                    <label>Food Name</label>

                    <input
                        type="text"
                        value="Milk"
                    >

                </div>

                <div class="input-group">

                    <label>Category</label>

                    <select>

                        <option selected>Dairy</option>

                        <option>Vegetables</option>

                    </select>

                </div>

                <div class="input-group">

                    <label>Expiry Date</label>

                    <input
                        type="date"
                        value="2026-05-30"
                    >

                </div>

                <div class="input-group">

                    <label>Calories</label>

                    <input
                        type="number"
                        value="120"
                    >

                </div>

            </div>

            <button class="sfwr-btn">

                Update Food Item

            </button>

        </form>

    </div>

</section>

@endsection