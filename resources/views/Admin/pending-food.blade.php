@extends('Admin.layouts.admin')

@section('content')

<section class="pending-section">

    <!-- TOP -->

    <div class="page-top">

        <div>

            <h1>Pending Food Requests</h1>

            <p>
                Review and approve user requests for available food items.
            </p>

        </div>

        <div class="pending-count">

            <i class="fa-solid fa-clock"></i>

            {{ $claims->count() }} Pending

        </div>

    </div>

    <!-- FOOD GRID -->

    <div class="pending-grid">

        @forelse($claims as $claim)

        <div class="pending-card" id="claim-{{ $claim->id_claim_sfwr }}">

            <div class="food-image">

                <img
                src="{{ $claim->foodItem && $claim->foodItem->foodimage_sfwr ? asset('storage/' . $claim->foodItem->foodimage_sfwr) : 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38' }}">

                <div class="pending-badge">
                    Pending Approval
                </div>

            </div>

            <div class="pending-body">

                <h2>{{ $claim->foodItem->foodname_sfwr ?? 'Item Unavailable' }}</h2>

                <p class="food-desc">
                    {{ $claim->foodItem->fooddescription_sfwr ?? 'No description provided.' }}
                </p>

                <!-- USER -->

                <div class="user-info">

                    <img
                    src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png">

                    <div>

                        <h4>{{ $claim->user->username_sfwr ?? 'Unknown User' }}</h4>

                        <span>Requesting User</span>

                    </div>

                </div>

                <!-- DETAILS -->

                <div class="food-details">

                    <div>
                        <i class="fa-solid fa-location-dot"></i>
                        {{ $claim->foodItem->pickup_location_sfwr ?? 'N/A' }}
                    </div>

                    <div>
                        <i class="fa-solid fa-phone"></i>
                        {{ $claim->foodItem->contact_sfwr ?? 'N/A' }}
                    </div>

                    <div>
                        <i class="fa-solid fa-calendar"></i>
                        Expiry: {{ $claim->foodItem ? \Carbon\Carbon::parse($claim->foodItem->expiry_date_sfwr)->format('M d, Y') : 'N/A' }}
                    </div>

                </div>

                <!-- BUTTONS -->

                <div class="action-buttons">

                    <form action="{{ route('admin.claims.approve', $claim->id_claim_sfwr) }}" method="POST" class="claim-form">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="approve-btn" data-action="approve">
                            <i class="fa-solid fa-circle-check"></i>
                            Approve
                        </button>
                    </form>

                    <form action="{{ route('admin.claims.reject', $claim->id_claim_sfwr) }}" method="POST" class="claim-form">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="reject-btn" data-action="reject">
                            <i class="fa-solid fa-circle-xmark"></i>
                            Reject
                        </button>
                    </form>

                </div>

            </div>

        </div>

        @empty

        <p>No pending food requests right now.</p>

        @endforelse

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

const popup =
document.getElementById('statusPopup');

const popupTitle =
document.getElementById('popupTitle');

const popupText =
document.getElementById('popupText');

function showPopup(action) {

    if (action === 'approve') {
        popupTitle.innerText = 'Food Approved';
        popupText.innerText = 'This request has been approved.';
    } else {
        popupTitle.innerText = 'Food Rejected';
        popupText.innerText = 'The food request has been rejected.';
    }

    popup.classList.add('active');

    setTimeout(() => {
        popup.classList.remove('active');
    }, 3000);

}

document.querySelectorAll('.claim-form').forEach(form => {

    form.addEventListener('submit', function (e) {

        e.preventDefault();

        const button = this.querySelector('button[type="submit"]');
        const action = button.dataset.action;
        const card = this.closest('.pending-card');

        fetch(this.action, {
            method: 'POST',
            body: new FormData(this),
        })
        .then(response => {

            if (response.ok) {

                showPopup(action);

                card.style.transition = 'opacity 0.4s ease';
                card.style.opacity = '0';

                setTimeout(() => card.remove(), 400);

            } else {

                alert('Something went wrong. Please try again.');

            }

        })
        .catch(() => {

            alert('Network error. Please try again.');

        });

    });

});

</script>

@endsection