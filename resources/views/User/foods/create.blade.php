@extends('layouts.app')

@section('styles')

@vite([
'resources/css/User/global.css',
'resources/css/User/create-food.css'
])

@endsection

@section('content')

<section class="create-food-section">

    <div class="create-food-container">

        <!-- LEFT -->

        <div class="create-food-left">

            <span class="create-badge">
                Share Food
            </span>

            <h1>
                Donate Surplus Food
            </h1>

            <p>
                Help reduce food waste by sharing
                extra food with the community.
            </p>

            <div class="create-features">

                <div class="create-feature">

                    <i class="fa-solid fa-recycle"></i>

                    <div>

                        <h3>Reduce Waste</h3>

                        <p>
                            Prevent unnecessary food disposal.
                        </p>

                    </div>

                </div>

                <div class="create-feature">

                    <i class="fa-solid fa-users"></i>

                    <div>

                        <h3>Help Community</h3>

                        <p>
                            Support nearby people with food.
                        </p>

                    </div>

                </div>

                <div class="create-feature">

                    <i class="fa-solid fa-shield-heart"></i>

                    <div>

                        <h3>Admin Verification</h3>

                        <p>
                            All food items are reviewed safely.
                        </p>

                    </div>

                </div>

            </div>

        </div>

        <!-- RIGHT -->

        <div class="create-food-right">

            <form class="food-form">

                <!-- IMAGE -->

                <div class="image-upload-box">

                    <input
                    type="file"
                    id="foodImage"
                    hidden>

                    <label
                    for="foodImage"
                    class="upload-area">

                        <img
                        id="previewImage"
                        src="https://cdn-icons-png.flaticon.com/512/685/685655.png">

                        <p>
                            Click to upload food image
                        </p>

                    </label>

                </div>

                <!-- FOOD NAME -->

                <div class="form-group">

                    <label>Food Name</label>

                    <input
                    type="text"
                    placeholder="Enter food name">

                </div>

                <!-- CATEGORY -->

                <div class="form-group">

                    <label>Category</label>

                    <select>

                        <option>Select Category</option>

                        <option>Pizza</option>

                        <option>Meals</option>

                        <option>Bakery</option>

                        <option>Dessert</option>

                        <option>Vegetarian</option>

                    </select>

                </div>

                <!-- DESCRIPTION -->

                <div class="form-group">

                    <label>Description</label>

                    <textarea
                    rows="5"
                    placeholder="Describe the food"></textarea>

                </div>

                <!-- LOCATION -->

                <div class="form-group">

                    <label>Pickup Location</label>

                    <input
                    type="text"
                    placeholder="Enter location">

                </div>

                <!-- CONTACT -->

                <div class="form-group">

                    <label>Contact Number</label>

                    <input
                    type="text"
                    placeholder="Enter contact number">

                </div>

                <!-- QUANTITY -->

                <div class="form-group">

                    <label>Quantity Available</label>

                    <input
                    type="number"
                    placeholder="Enter quantity">

                </div>

                <!-- EXPIRY -->

                <div class="form-group">

                    <label>Available Till</label>

                    <input
                    type="datetime-local">

                </div>

                <!-- SUBMIT -->

                <button
                type="button"
                class="submit-food-btn"
                id="submitFoodBtn">

                    Submit For Approval

                </button>

            </form>

        </div>

    </div>

</section>

<!-- SUCCESS POPUP -->

<div class="food-success-popup"
id="foodSuccessPopup">

    <i class="fa-solid fa-circle-check"></i>

    <h3>Food Submitted</h3>

    <p>
        Your food item has been sent
        for admin approval.
    </p>

</div>

<script>

const imageInput =
document.getElementById('foodImage');

const previewImage =
document.getElementById('previewImage');

imageInput.addEventListener('change', function(){

    const file =
    this.files[0];

    if(file){

        previewImage.src =
        URL.createObjectURL(file);

    }

});

document.getElementById('submitFoodBtn')
.addEventListener('click', () => {

    const popup =
    document.getElementById('foodSuccessPopup');

    popup.classList.add('active');

    setTimeout(() => {

        popup.classList.remove('active');

    },3000);

});

</script>

@endsection