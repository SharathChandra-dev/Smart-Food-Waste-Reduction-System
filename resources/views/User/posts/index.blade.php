@extends('layouts.app')

@section('styles')

@vite([
'resources/css/User/global.css',
'resources/css/User/posts.css'
])

@endsection

@section('content')

<section class="posts-section">

    <!-- TOP -->

    <div class="posts-top">

        <div>

            <span class="posts-badge">
                User Dashboard
            </span>

            <h1>My Food Posts</h1>

            <p>
                Manage your uploaded food items,
                requests, and approval status.
            </p>

        </div>

        <a
        href="{{ route('foods.create') }}"
        class="add-post-btn">

            <i class="fa-solid fa-plus"></i>

            Add New Food

        </a>

    </div>

    <!-- POSTS GRID -->

    <div class="posts-grid">

        <!-- CARD -->

        <div class="post-card">

            <div class="post-image">

                <img
                src="https://images.unsplash.com/photo-1513104890138-7c749659a591">

                <span class="approved-status">
                    Approved
                </span>

            </div>

            <div class="post-content">

                <div class="post-header">

                    <h3>Cheese Pizza</h3>

                    <span>12 Requests</span>

                </div>

                <p>
                    Fresh pizza available for pickup
                    near Munich Station.
                </p>

                <div class="post-details">

                    <div>

                        <i class="fa-solid fa-location-dot"></i>

                        Munich

                    </div>

                    <div>

                        <i class="fa-solid fa-clock"></i>

                        8 PM

                    </div>

                </div>

                <!-- <div class="post-actions">

                    <button class="edit-btn">

                        <i class="fa-solid fa-pen"></i>

                        Edit

                    </button>

                    <button class="delete-btn">

                        <i class="fa-solid fa-trash"></i>

                        Delete

                    </button>

                </div> -->

            </div>

        </div>

        <!-- CARD -->

        <div class="post-card">

            <div class="post-image">

                <img
                src="https://images.unsplash.com/photo-1504674900247-0877df9cc836">

                <span class="pending-status">
                    Pending
                </span>

            </div>

            <div class="post-content">

                <div class="post-header">

                    <h3>Rice Meal</h3>

                    <span>0 Requests</span>

                </div>

                <p>
                    Home cooked rice meal waiting
                    for admin verification.
                </p>

                <div class="post-details">

                    <div>

                        <i class="fa-solid fa-location-dot"></i>

                        Berlin

                    </div>

                    <div>

                        <i class="fa-solid fa-clock"></i>

                        Tomorrow

                    </div>

                </div>

                <!-- <div class="post-actions">

                    <button class="edit-btn">

                        <i class="fa-solid fa-pen"></i>

                        Edit

                    </button>

                    <button class="delete-btn">

                        <i class="fa-solid fa-trash"></i>

                        Delete

                    </button>

                </div> -->

            </div>

        </div>

        <!-- EMPTY CARD -->

        <div class="empty-post-card">

            <i class="fa-solid fa-bowl-food"></i>

            <h3>More Food Can Help People</h3>

            <p>
                Upload more food items and
                contribute to reducing food waste.
            </p>

            <a
            href="{{ route('foods.create') }}"
            class="upload-food-btn">

                Upload Food

            </a>

        </div>

    </div>

</section>

@endsection