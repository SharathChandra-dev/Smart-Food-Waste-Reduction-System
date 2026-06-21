@extends('layouts.app')

@section('styles')

@vite([
'resources/css/User/global.css',
'resources/css/User/foods.css'
])

@endsection

@section('content')

<section class="page-banner">

    <div class="banner-content">

        @auth
            <h1>Welcome {{ auth()->user()->username_sfwr }},</h1>
        @else
            <h1>Welcome there,</h1>
        @endauth

        <h2>Available Foods</h2>

        <p>
            Browse community shared food items
        </p>

    </div>

</section>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-error">{{ session('error') }}</div>
@endif

<section class="filter-section">

    <div class="search-box">

        <i class="fa-solid fa-magnifying-glass"></i>

        <input
            type="text"
            id="searchInput"
            placeholder="Search foods...">

    </div>

    <div class="filter-dropdown">

        <label for="filterSelect">
            Category
        </label>

        <select id="filterSelect">

            <option value="all">
                All Categories
            </option>

            @foreach($categories as $category)
                <option value="{{ strtolower($category) }}">
                    {{ $category }}
                </option>
            @endforeach

        </select>

    </div>

</section>

<section class="foods-page-section">

    <div class="food-grid" id="foodGrid">

        @foreach($foods as $food)

        @php
            $badgeMap = [
                'fresh' => ['food-badge--fresh', '🟢 Fresh'],
                'expiring_soon' => ['food-badge--warning', '🟡 Expiring Soon'],
                'expired' => ['food-badge--expired', '🔴 Expired'],
            ];
            [$badgeClass, $badgeLabel] = $badgeMap[$food->expiry_status];

            $claimStatus = $myClaims[$food->id_food_sfwr] ?? null;
        @endphp

        <div
            class="food-card"
            data-name="{{ strtolower($food->foodname_sfwr) }}"
            data-category="{{ strtolower($food->foodcategory_sfwr) }}">

            <div class="food-image">

                @if($food->foodimage_sfwr)
                    <img
                        src="{{ asset('storage/'.$food->foodimage_sfwr) }}"
                        alt="Food image">
                @else
                    <span>No Image</span>
                @endif

                <span class="food-badge {{ $badgeClass }}">
                    {{ $badgeLabel }}
                </span>

            </div>

            <div class="food-content">

                <div class="food-top">
                    <h3>{{ $food->foodname_sfwr }}</h3>
                </div>

                <p>{{ $food->fooddescription_sfwr }}</p>

                <div class="food-meta">

                    <span>
                        Category:
                        {{ $food->foodcategory_sfwr }}
                    </span>

                </div>

                <div class="food-meta">

                    <span>
                        Manufacturing:
                        {{ $food->manufacturing_date_sfwr }}
                    </span>

                    <span>
                        Expiry:
                        {{ $food->expiry_date_sfwr }}
                    </span>

                </div>

                <div class="food-meta food-meta--secondary">

                    <span>
                        Quantity:
                        {{ $food->foodquantity_sfwr }}
                    </span>

                    <span>
                        Calories:
                        {{ $food->calories_sfwr }} kcal
                    </span>

                </div>

                <div class="food-footer">

                    <span>
                        Contact:
                        {{ $food->contact_sfwr }}
                    </span>

                </div>

                <div class="food-action">

                    @if($claimStatus === 'pending')
                        <button class="btn-claim btn-claim--pending" disabled>
                            <i class="fa-solid fa-clock"></i> Request Pending
                        </button>
                    @elseif($claimStatus === 'approved')
                        <button class="btn-claim btn-claim--approved" disabled>
                            <i class="fa-solid fa-check"></i> Approved
                        </button>
                    @else
                        <form action="{{ route('foods.claim', $food->id_food_sfwr) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-claim btn-claim--request">
                                <i class="fa-solid fa-hand-holding-heart"></i> Request This Item
                            </button>
                        </form>
                    @endif

                </div>

            </div>

        </div>

        @endforeach

    </div>

    <div
        class="empty-state"
        id="emptyState">

        <i class="fa-solid fa-face-sad-tear"></i>

        <h2>No Food Items Found</h2>

        <p>
            Sorry, there are no foods available
            in this category.
        </p>

    </div>

</section>

<script>

const searchInput =
document.getElementById('searchInput');

const filterSelect =
document.getElementById('filterSelect');

const cards =
document.querySelectorAll('.food-card');

const emptyState =
document.getElementById('emptyState');

let activeCategory = 'all';

function filterFoods() {

    const search =
    searchInput.value.toLowerCase();

    let visibleCount = 0;

    cards.forEach(card => {

        const name =
        card.dataset.name;

        const category =
        card.dataset.category;

        const matchesSearch =
        name.includes(search);

        const matchesCategory =
        activeCategory === 'all' ||
        category === activeCategory;

        if (
            matchesSearch &&
            matchesCategory
        ) {

            card.style.display = 'block';

            visibleCount++;

        } else {

            card.style.display = 'none';

        }

    });

    if (visibleCount === 0) {

        emptyState.style.display = 'flex';

    } else {

        emptyState.style.display = 'none';

    }

}

searchInput.addEventListener(
    'keyup',
    filterFoods
);

filterSelect.addEventListener(
    'change',
    () => {

        activeCategory =
        filterSelect.value;

        filterFoods();

    }
);

filterFoods();

</script>

@endsection