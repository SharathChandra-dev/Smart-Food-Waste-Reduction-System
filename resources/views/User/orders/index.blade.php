@extends('layouts.app')

@section('styles')

@vite([
'resources/css/User/global.css',
'resources/css/User/orders.css'
])

@endsection

@section('content')

<section class="orders-section">

    <!-- TOP -->

    <div class="orders-top">

        <span class="orders-badge">
            Food Requests
        </span>

        <h1>My Orders</h1>

        <p>
            Track your requested food items
            and monitor their current status.
        </p>

    </div>

    <!-- ORDERS GRID -->

    <div class="orders-grid">

        <!-- CARD -->

        <div class="order-card">

            <div class="order-image">

                <img
                src="https://images.unsplash.com/photo-1513104890138-7c749659a591">

                <span class="status approved">
                    Approved
                </span>

            </div>

            <div class="order-content">

                <div class="order-header">

                    <h3>Cheese Pizza</h3>

                    <span>2 Plates</span>

                </div>

                <p>
                    Request approved by owner.
                    Ready for pickup.
                </p>

                <div class="order-details">

                    <div>

                        <i class="fa-solid fa-location-dot"></i>

                        Munich

                    </div>

                    <div>

                        <i class="fa-solid fa-clock"></i>

                        Today 7 PM

                    </div>

                </div>

                <div class="order-actions">

            <button
                class="contact-btn openContact">

                       Contact Owner

            </button>

            <button
                class="details-btn openDetails">

                    View Details

             </button>

            <button
                class="cancel-btn cancelOrder">

                Cancel

            </button>

        </div>

            </div>

        </div>

        <!-- CARD -->

        <div class="order-card">

            <div class="order-image">

                <img
                src="https://images.unsplash.com/photo-1504674900247-0877df9cc836">

                <span class="status pending">
                    Pending
                </span>

            </div>

            <div class="order-content">

                <div class="order-header">

                    <h3>Rice Meal</h3>

                    <span>1 Box</span>

                </div>

                <p>
                    Waiting for food owner
                    approval.
                </p>

                <div class="order-details">

                    <div>

                        <i class="fa-solid fa-location-dot"></i>

                        Berlin

                    </div>

                    <div>

                        <i class="fa-solid fa-clock"></i>

                        Tomorrow

                    </div>

                </div>

            <div class="order-actions">

            <button
                class="contact-btn openContact">

                       Contact Owner

            </button>

            <button
                class="details-btn openDetails">

                    View Details

             </button>

            <button
                class="cancel-btn cancelOrder">

                Cancel

            </button>

        </div>

            </div>

        </div>

        <!-- EMPTY -->

        <div class="empty-orders">

            <i class="fa-solid fa-bag-shopping"></i>

            <h3>No More Orders</h3>

            <p>
                Start requesting food items
                from nearby users.
            </p>

            <a
            href="{{ route('foods.index') }}"
            class="browse-btn">

                Browse Food

            </a>

        </div>

    </div>

</section>


<!-- CONTACT MODAL -->

<div class="custom-modal"
id="contactModal">

    <div class="modal-box">

        <div class="modal-top">

            <h2>Food Owner Details</h2>

            <i class="fa-solid fa-xmark closeModal"></i>

        </div>

        <div class="owner-card">

            <div class="owner-item">

                <i class="fa-solid fa-user"></i>

                <div>

                    <h4>Name</h4>

                    <p>John Doe</p>

                </div>

            </div>

            <div class="owner-item">

                <i class="fa-solid fa-phone"></i>

                <div>

                    <h4>Phone</h4>

                    <p>+49 123 456 789</p>

                </div>

            </div>

            <div class="owner-item">

                <i class="fa-solid fa-location-dot"></i>

                <div>

                    <h4>Location</h4>

                    <p>Munich Central Station</p>

                </div>

            </div>

            <a
            href="#"
            class="whatsapp-button">

                <i class="fa-brands fa-whatsapp"></i>

                WhatsApp Owner

            </a>

        </div>

    </div>

</div>

<!-- DETAILS MODAL -->

<div class="custom-modal"
id="detailsModal">

    <div class="modal-box">

        <div class="modal-top">

            <h2>Food Details</h2>

            <i class="fa-solid fa-xmark closeModal"></i>

        </div>

        <img
        class="details-image"
        src="https://images.unsplash.com/photo-1513104890138-7c749659a591">

        <div class="details-content">

            <h3>Cheese Pizza</h3>

            <p>
                Freshly prepared cheese pizza
                available for pickup near Munich.
            </p>

            <div class="details-row">

                <span>Quantity:</span>

                <strong>2 Plates</strong>

            </div>

            <div class="details-row">

                <span>Pickup Time:</span>

                <strong>Today 7 PM</strong>

            </div>

            <div class="details-row">

                <span>Status:</span>

                <strong>Approved</strong>

            </div>

        </div>

    </div>

</div>

<!-- CANCEL POPUP -->

<div class="cancel-popup"
id="cancelPopup">

    <i class="fa-solid fa-circle-check"></i>

    <h3>Order Cancelled</h3>

    <p>
        Your order has been cancelled successfully.
    </p>

</div>

<script>

const contactModal =
document.getElementById('contactModal');

const detailsModal =
document.getElementById('detailsModal');

const cancelPopup =
document.getElementById('cancelPopup');

document.querySelectorAll('.openContact')
.forEach(button => {

    button.addEventListener('click', () => {

        contactModal.classList.add('active');

    });

});

document.querySelectorAll('.openDetails')
.forEach(button => {

    button.addEventListener('click', () => {

        detailsModal.classList.add('active');

    });

});

document.querySelectorAll('.closeModal')
.forEach(button => {

    button.addEventListener('click', () => {

        contactModal.classList.remove('active');

        detailsModal.classList.remove('active');

    });

});

document.querySelectorAll('.cancelOrder')
.forEach(button => {

    button.addEventListener('click', () => {

        const orderCard =
        button.closest('.order-card');

        orderCard.remove();

        cancelPopup.classList.add('active');

        setTimeout(() => {

            cancelPopup.classList.remove('active');

        },3000);

    });

});

</script>

@endsection