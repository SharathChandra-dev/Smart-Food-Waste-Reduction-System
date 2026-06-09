@extends('layouts.app')

@section('styles')

@vite('resources/css/User/reminders.css')

@endsection

@section('content')

<section class="reminder-form-page">

    <div class="reminder-form-card">

        <div class="form-top">

            <h1>Add Reminder</h1>

            <p>
                Create reminders for grocery
                shopping and food tracking.
            </p>

        </div>

        <form>

            <div class="form-grid">

                <div class="input-group">

                    <label>Reminder Name</label>

                    <input
                        type="text"
                        placeholder="Enter reminder"
                    >

                </div>

                <div class="input-group">

                    <label>Reminder Date</label>

                    <input type="date">

                </div>

                <div class="input-group">

                    <label>Status</label>

                    <select>

                        <option>Pending</option>

                        <option>Completed</option>

                    </select>

                </div>

            </div>

            <button class="sfwr-btn">

                Save Reminder

            </button>

        </form>

    </div>

</section>

@endsection