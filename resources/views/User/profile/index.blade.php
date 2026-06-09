@extends('layouts.app')

@section('styles')

@vite([
'resources/css/User/global.css',
'resources/css/User/profile.css'
])

@endsection

@section('content')

<section class="profile-section">

    <!-- PROFILE TOP -->

    <div class="profile-top">

        <!-- LEFT -->

        <div class="profile-card">

            <div class="profile-image-box">

                <img
                id="profilePreview"
                src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png">

                <label
                for="profileImage"
                class="upload-profile-btn">

                    <i class="fa-solid fa-camera"></i>

                </label>

                <input
                type="file"
                id="profileImage"
                hidden>

            </div>

            <h2>Sharath</h2>

            <p>
                Community Food Contributor
            </p>

            <div class="profile-badges">

                <span>Top Contributor</span>

                <span>Waste Reducer</span>

            </div>

        </div>

        <!-- RIGHT -->

        <div class="stats-grid">

            <div class="stat-card">

                <i class="fa-solid fa-bowl-food"></i>

                <h3>28</h3>

                <p>Food Shared</p>

            </div>

            <div class="stat-card">

                <i class="fa-solid fa-cart-shopping"></i>

                <h3>15</h3>

                <p>Orders Made</p>

            </div>

            <div class="stat-card">

                <i class="fa-solid fa-users"></i>

                <h3>42</h3>

                <p>People Helped</p>

            </div>

            <div class="stat-card">

                <i class="fa-solid fa-recycle"></i>

                <h3>95 KG</h3>

                <p>Waste Reduced</p>

            </div>

        </div>

    </div>

    <!-- PROFILE FORM -->

    <div class="profile-form-container">

        <div class="profile-form-header">

            <h2>Edit Profile</h2>

            <p>
                Update your account information.
            </p>

        </div>

        <form class="profile-form">

            <div class="form-grid">

                <div class="form-group">

                    <label>Full Name</label>

                    <input
                    type="text"
                    value="Sharath">

                </div>

                <div class="form-group">

                    <label>Email Address</label>

                    <input
                    type="email"
                    value="sharath@gmail.com">

                </div>

                <div class="form-group">

                    <label>Phone Number</label>

                    <input
                    type="text"
                    value="+49 123 456 789">

                </div>

                <div class="form-group">

                    <label>Location</label>

                    <input
                    type="text"
                    value="Munich, Germany">

                </div>

            </div>

            <div class="form-group">

                <label>Bio</label>

                <textarea rows="5">

Helping reduce food waste and support communities.

                </textarea>

            </div>

            <button
            type="button"
            class="save-profile-btn"
            id="saveProfileBtn">

                Save Changes

            </button>

        </form>

    </div>

    <!-- ACTIVITY -->

    <div class="activity-section">

        <div class="activity-header">

            <h2>Recent Activity</h2>

            <p>
                Your latest food sharing actions.
            </p>

        </div>

        <div class="activity-list">

            <div class="activity-card">

                <i class="fa-solid fa-circle-check"></i>

                <div>

                    <h4>Pizza shared successfully</h4>

                    <p>2 hours ago</p>

                </div>

            </div>

            <div class="activity-card">

                <i class="fa-solid fa-bowl-food"></i>

                <div>

                    <h4>Rice meal approved by admin</h4>

                    <p>Yesterday</p>

                </div>

            </div>

            <div class="activity-card">

                <i class="fa-solid fa-user-group"></i>

                <div>

                    <h4>New request received</h4>

                    <p>2 days ago</p>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- SUCCESS POPUP -->

<div class="profile-popup"
id="profilePopup">

    <i class="fa-solid fa-circle-check"></i>

    <h3>Profile Updated</h3>

    <p>
        Your profile has been updated successfully.
    </p>

</div>

<script>

const profileImage =
document.getElementById('profileImage');

const profilePreview =
document.getElementById('profilePreview');

profileImage.addEventListener('change', function(){

    const file = this.files[0];

    if(file){

        profilePreview.src =
        URL.createObjectURL(file);

    }

});

document.getElementById('saveProfileBtn')
.addEventListener('click', () => {

    const popup =
    document.getElementById('profilePopup');

    popup.classList.add('active');

    setTimeout(() => {

        popup.classList.remove('active');

    },3000);

});

</script>

@endsection