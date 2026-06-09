@extends('Admin.layouts.admin')

@section('content')

<section class="pending-section">

    <!-- TOP -->

    <div class="page-top">

        <div>

            <h1>Pending Food Requests</h1>

            <p>
                Review and verify food submissions before publishing.
            </p>

        </div>

        <div class="pending-count">

            <i class="fa-solid fa-clock"></i>

            12 Pending

        </div>

    </div>

    <!-- FOOD GRID -->

    <div class="pending-grid">

        <!-- CARD 1 -->

        <div class="pending-card">

            <div class="food-image">

                <img
                src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38">

                <div class="pending-badge">
                    Pending Approval
                </div>

            </div>

            <div class="pending-body">

                <h2>Veg Pizza Combo</h2>

                <p class="food-desc">
                    Fresh pizza available from restaurant surplus.
                </p>

                <!-- USER -->

                <div class="user-info">

                    <img
                    src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png">

                    <div>

                        <h4>Sharath</h4>

                        <span>Food Contributor</span>

                    </div>

                </div>

                <!-- DETAILS -->

                <div class="food-details">

                    <div>
                        <i class="fa-solid fa-location-dot"></i>
                        Munich, Germany
                    </div>

                    <div>
                        <i class="fa-solid fa-phone"></i>
                        +49 123456789
                    </div>

                    <div>
                        <i class="fa-solid fa-calendar"></i>
                        Expiry: Tomorrow
                    </div>

                </div>

                <!-- BUTTONS -->

                <div class="action-buttons">

                    <button
                    class="approve-btn">

                        <i class="fa-solid fa-circle-check"></i>

                        Approve

                    </button>

                    <button
                    class="reject-btn">

                        <i class="fa-solid fa-circle-xmark"></i>

                        Reject

                    </button>

                </div>

            </div>

        </div>

        <!-- CARD 2 -->

        <div class="pending-card">

            <div class="food-image">

                <img
                src="https://images.unsplash.com/photo-1504674900247-0877df9cc836">

                <div class="pending-badge">
                    Pending Approval
                </div>

            </div>

            <div class="pending-body">

                <h2>Rice Meal Pack</h2>

                <p class="food-desc">
                    Extra food available for nearby students.
                </p>

                <div class="user-info">

                    <img
                    src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png">

                    <div>

                        <h4>Adithya</h4>

                        <span>Food Contributor</span>

                    </div>

                </div>

                <div class="food-details">

                    <div>
                        <i class="fa-solid fa-location-dot"></i>
                        Berlin, Germany
                    </div>

                    <div>
                        <i class="fa-solid fa-phone"></i>
                        +49 987654321
                    </div>

                    <div>
                        <i class="fa-solid fa-calendar"></i>
                        Expiry: Today
                    </div>

                </div>

                <div class="action-buttons">

                    <button
                    class="approve-btn">

                        <i class="fa-solid fa-circle-check"></i>

                        Approve

                    </button>

                    <button
                    class="reject-btn">

                        <i class="fa-solid fa-circle-xmark"></i>

                        Reject

                    </button>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- SUCCESS POPUP -->

<div class="status-popup"
id="statusPopup">

    <i class="fa-solid fa-circle-check"></i>

    <h3 id="popupTitle">
        Food Approved
    </h3>

    <p id="popupText">
        This food post is now visible to users.
    </p>

</div>

<script>

const approveBtns =
document.querySelectorAll('.approve-btn');

const rejectBtns =
document.querySelectorAll('.reject-btn');

const popup =
document.getElementById('statusPopup');

const popupTitle =
document.getElementById('popupTitle');

const popupText =
document.getElementById('popupText');

approveBtns.forEach(btn => {

    btn.addEventListener('click', () => {

        popupTitle.innerText =
        'Food Approved';

        popupText.innerText =
        'This post is now visible to users.';

        popup.classList.add('active');

        setTimeout(() => {

            popup.classList.remove('active');

        },3000);

    });

});

rejectBtns.forEach(btn => {

    btn.addEventListener('click', () => {

        popupTitle.innerText =
        'Food Rejected';

        popupText.innerText =
        'The food post has been rejected.';

        popup.classList.add('active');

        setTimeout(() => {

            popup.classList.remove('active');

        },3000);

    });

});

</script>

@endsection