@extends('layouts.app')

@section('styles')

@vite('resources/css/User/reminders.css')

@endsection

@section('content')

<section class="reminder-page">

    <div class="page-header">

        <div>

            <h1>Reminder System</h1>

            <p>
                Manage grocery reminders and
                avoid unnecessary food waste.
            </p>

        </div>

        <a href="{{ route('reminders.create') }}"
        class="sfwr-btn">

            Add Reminder

        </a>

    </div>

    <!-- REMINDER CARDS -->

    <div class="reminder-grid">

        <!-- CARD -->

        <div class="reminder-card">

            <div class="card-top">

                <h3>Buy Milk</h3>

                <span class="pending-badge">
                    Pending
                </span>

            </div>

            <p class="date">

                Reminder Date:
                2026-05-28

            </p>

            <div class="card-actions">

                <a href="{{ route('reminders.edit',1) }}"
                class="edit-btn">

                    Edit

                </a>

                <button
                    class="delete-btn"
                    onclick="deleteReminder()"
                >
                    Delete
                </button>

            </div>

        </div>

        <!-- CARD -->

        <div class="reminder-card">

            <div class="card-top">

                <h3>Vegetables Shopping</h3>

                <span class="completed-badge">
                    Completed
                </span>

            </div>

            <p class="date">

                Reminder Date:
                2026-05-30

            </p>

            <div class="card-actions">

                <a href="{{ route('reminders.edit',1) }}"
                class="edit-btn">

                    Edit

                </a>

                <button
                    class="delete-btn"
                    onclick="deleteReminder()"
                >
                    Delete
                </button>

            </div>

        </div>

    </div>

</section>

<script>

    function deleteReminder(){

        alert(
            "Reminder delete backend will be connected tomorrow."
        );

    }

</script>

@endsection