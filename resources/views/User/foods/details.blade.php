@extends('layouts.app')

@section('styles')

@vite([
'resources/css/User/global.css',
'resources/css/User/details.css'
])

@endsection

@section('content')

<section class="details-section">

    <div class="details-container">

        <div class="details-image">

            <img
            src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?q=80&w=1200">

        </div>

        <div class="details-content">

            <span class="details-badge">
                Approved Food
            </span>

            <h1>Cheese Pizza</h1>

            <p class="details-description">

                Freshly prepared cheese pizza available
                for pickup. Stored safely and suitable
                for immediate consumption.

            </p>

            <div class="details-info">

                <div class="info-box">

                    <i class="fa-solid fa-user"></i>

                    <div>

                        <h4>Uploaded By</h4>

                        <p>John Doe</p>

                    </div>

                </div>

                <div class="info-box">

                    <i class="fa-solid fa-phone"></i>

                    <div>

                        <h4>Contact</h4>

                        <p>+49 123 456 789</p>

                    </div>

                </div>

                <div class="info-box">

                    <i class="fa-solid fa-location-dot"></i>

                    <div>

                        <h4>Pickup Location</h4>

                        <p>Munich Central Station</p>

                    </div>

                </div>

                <div class="info-box">

                    <i class="fa-solid fa-clock"></i>

                    <div>

                        <h4>Available Till</h4>

                        <p>Today 9:00 PM</p>

                    </div>

                </div>

            </div>

            <!-- <div class="details-buttons">

                <button class="primary-btn">
                    Request Food
                </button>

                <button class="secondary-btn">
                    Contact Owner
                </button>

            </div> -->

            <div class="details-buttons">

    <button
    class="primary-btn"
    id="openRequest">

        Request Food

    </button>

    <button
    class="secondary-btn"
    id="openContact">

        Contact Owner

    </button>

</div>

<!-- REQUEST MODAL -->

<div class="custom-modal"
id="requestModal">

    <div class="modal-box">

        <div class="modal-top">

            <h2>Request Food</h2>

            <i class="fa-solid fa-xmark closeModal"></i>

        </div>

        <form>

            <div class="modal-input">

                <label>Full Name</label>

                <input
                type="text"
                placeholder="Enter your name">

            </div>

            <div class="modal-input">

                <label>Phone Number</label>

                <input
                type="text"
                placeholder="Enter phone number">

            </div>

            <div class="modal-input">

                <label>Quantity Needed</label>

                <input
                type="number"
                placeholder="Enter quantity">

            </div>

            <div class="modal-input">

                <label>Pickup Time</label>

                <input type="time">

            </div>

            <div class="modal-input">

                <label>Message</label>

                <textarea
                rows="4"
                placeholder="Write a message"></textarea>

            </div>

            <button
            type="button"
            class="primary-btn submit-btn"
            id="submitRequest">

                Submit Request

            </button>

        </form>

    </div>

</div>

<!-- CONTACT MODAL -->

<div class="custom-modal"
id="contactModal">

    <div class="modal-box">

        <div class="modal-top">

            <h2>Contact Owner</h2>

            <i class="fa-solid fa-xmark closeModal"></i>

        </div>

        <div class="contact-owner-box">

            <div class="owner-info">

                <i class="fa-solid fa-user"></i>

                <div>

                    <h4>Owner Name</h4>

                    <p>John Doe</p>

                </div>

            </div>

            <div class="owner-info">

                <i class="fa-solid fa-phone"></i>

                <div>

                    <h4>Phone</h4>

                    <p>+49 123 456 789</p>

                </div>

            </div>

            <div class="owner-info">

                <i class="fa-solid fa-envelope"></i>

                <div>

                    <h4>Email</h4>

                    <p>john@sfwr.com</p>

                </div>

            </div>

            <div class="owner-info">

                <i class="fa-solid fa-location-dot"></i>

                <div>

                    <h4>Location</h4>

                    <p>Munich Central Station</p>

                </div>

            </div>

            <a
            href="#"
            class="whatsapp-btn">

                <i class="fa-brands fa-whatsapp"></i>

                Chat on WhatsApp

            </a>

        </div>

    </div>

</div>

<!-- SUCCESS MESSAGE -->

<div class="success-popup"
id="successPopup">

    <i class="fa-solid fa-circle-check"></i>

    <h3>Request Submitted</h3>

    <p>
        Your food request has been sent successfully.
    </p>

</div>

<script>

const requestModal =
document.getElementById('requestModal');

const contactModal =
document.getElementById('contactModal');

const successPopup =
document.getElementById('successPopup');

document.getElementById('openRequest')
.addEventListener('click', () => {

    requestModal.classList.add('active');

});

document.getElementById('openContact')
.addEventListener('click', () => {

    contactModal.classList.add('active');

});

document.querySelectorAll('.closeModal')
.forEach(button => {

    button.addEventListener('click', () => {

        requestModal.classList.remove('active');

        contactModal.classList.remove('active');

    });

});

document.getElementById('submitRequest')
.addEventListener('click', () => {

    requestModal.classList.remove('active');

    successPopup.classList.add('active');

    setTimeout(() => {

        successPopup.classList.remove('active');

    },3000);

});

</script>

        </div>

    </div>

</section>

@endsection