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

<section class="filter-section">

    <div class="search-box">

        <i class="fa-solid fa-magnifying-glass"></i>

        <input
        type="text"
        id="searchInput"
        placeholder="Search foods...">

    </div>

    <div class="filter-dropdown">
        <label for="filterSelect">Expiry filter</label>
        <select id="filterSelect">
            <option value="all">All</option>
            <option value="lt1week">&lt;1 week</option>
            <option value="lt2weeks">&lt;2 weeks</option>
            <option value="lt1month">&lt;1 month</option>
            <option value="lt2months">&lt;2 months</option>
            <option value="lt6months">&lt;6 months</option>

        </select>
    </div>

</section>

<section class="foods-page-section">

    <div class="food-grid" id="foodGrid">

@foreach($foods as $food)

<div class="food-card"
     data-name="{{ strtolower($food->foodname_sfwr) }}"
     data-category="expiry"
     data-expiry="{{ $food->expiry_date_sfwr }}">

    <div class="food-image">

        @if($food->foodimage_sfwr)
            <img src="{{ asset('storage/'.$food->foodimage_sfwr) }}" alt="Food image">
        @else
            <span>No Image</span>
        @endif

        <span class="food-badge">
            Available
        </span>

    </div>

    <div class="food-content">

        <div class="food-top">
            <h3>{{ $food->foodname_sfwr }}</h3>
        </div>

        <p>{{ $food->fooddescription_sfwr }}</p>

        <div class="food-meta">

            <span>
                Manufacturing: {{ $food->manufacturing_date_sfwr }}
            </span>

            <span>
                Expiry: {{ $food->expiry_date_sfwr }}
            </span>

        </div>

        <div class="food-meta food-meta--secondary">
            <span>
                Quantity: {{ $food->foodquantity_sfwr }}
            </span>
            <span>
                Calories: {{ $food->calories_sfwr }} kcal
            </span>
        </div>

        <div class="food-footer">

            <span>
                Contact: {{ $food->contact_sfwr }}
            </span>

        </div>

    </div>

</div>

@endforeach

</div>

    <!-- EMPTY -->

    <div class="empty-state"
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

function filterFoods(){

    const search =
    searchInput.value.toLowerCase();

    let visibleCount = 0;

    const today = new Date();
    const msPerDay = 24 * 60 * 60 * 1000;

    cards.forEach(card => {

        const name =
        card.dataset.name;

        const expiryDate =
        card.dataset.expiry ? new Date(card.dataset.expiry) : null;

        const daysUntilExpiry = expiryDate
            ? Math.ceil((expiryDate - today) / msPerDay)
            : null;

        const matchesSearch =
        name.includes(search);

        let matchesCategory = activeCategory === 'all';

        if(!matchesCategory && expiryDate){
            if(activeCategory === 'lt1week'){
                matchesCategory = daysUntilExpiry >= 0 && daysUntilExpiry <= 7;
            } else if(activeCategory === 'lt2weeks'){
                matchesCategory = daysUntilExpiry >= 0 && daysUntilExpiry <= 14;
            } else if(activeCategory === 'lt1month'){
                matchesCategory = daysUntilExpiry >= 0 && daysUntilExpiry <= 30;
            } else if(activeCategory === 'lt2months'){
                matchesCategory = daysUntilExpiry >= 0 && daysUntilExpiry <= 60;
            } else if(activeCategory === 'lt6months'){
                matchesCategory = daysUntilExpiry >= 0 && daysUntilExpiry <= 180;
            }
        }

        if(matchesSearch && matchesCategory){

            card.style.display = 'block';

            visibleCount++;

        }else{

            card.style.display = 'none';

        }

    });

    if(visibleCount === 0){

        emptyState.style.display = 'flex';

    }else{

        emptyState.style.display = 'none';

    }

}

searchInput.addEventListener('keyup', filterFoods);

filterSelect.addEventListener('change', () => {
    activeCategory = filterSelect.value;
    filterFoods();
});

filterFoods();

</script>

@endsection