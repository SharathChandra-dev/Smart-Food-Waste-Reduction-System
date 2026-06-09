@extends('layouts.app')

@section('styles')

@vite('resources/css/User/reminders.css')

@endsection

@section('content')

<section class="reminder-form-page">

    <div class="reminder-form-card">

        <div class="form-top">

            <h1>Edit Reminder</h1>

            <p>
                Update reminder details.
            </p>

        </div>

        <form>

            <div class="form-grid">

                <div class="input-group">

                    <label>Reminder Name</label>

                    <input
                        type="text"
                        value="Buy Milk"
                    >

                </div>

                <div class="input-group">

                    <label>Reminder Date</label>

                    <input
                        type="date"
                        value="2026-05-28"
                    >

                </div>

                <div class="input-group">

                    <label>Status</label>

                    <select>

                        <option selected>
                            Pending
                        </option>

                        <option>
                            Completed
                        </option>

                    </select>

                </div>

            </div>

            <button class="sfwr-btn">

                Update Reminder

            </button>

        </form>

    </div>

</section>

@endsection