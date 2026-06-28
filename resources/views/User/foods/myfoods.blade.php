@extends('layouts.app')

@section('styles')

@vite([
    'resources/css/User/global.css'
])

<style>
    .page-banner {
        background: linear-gradient(135deg, #c68a5a, #9f653a);
        padding: 90px 80px;
        color: #ffffff;
    }

    .banner-content h1 {
        font-size: 46px;
        margin-bottom: 14px;
    }

    .banner-content p {
        color: #fff7ed;
        font-size: 18px;
    }

    .claims-section {
        padding: 56px 80px 90px;
    }

    .claims-table-wrap {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
        overflow-x: auto;
    }

    .claims-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 860px;
    }

    .claims-table th,
    .claims-table td {
        padding: 18px 20px;
        text-align: left;
        border-bottom: 1px solid #f1e3d8;
        vertical-align: middle;
    }

    .claims-table th {
        color: #5d4037;
        font-size: 14px;
        font-weight: 700;
        background: #fff7ed;
    }

    .claims-table td {
        color: #4a3528;
        font-size: 15px;
    }

    .claim-food-name {
        font-weight: 700;
        color: #3d2b1f;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border-radius: 999px;
        padding: 8px 12px;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-badge--pending {
        background: #fef3c7;
        color: #92400e;
    }

    .status-badge--approved {
        background: #dcfce7;
        color: #166534;
    }

    .status-badge--rejected {
        background: #fee2e2;
        color: #991b1b;
    }

    .claims-empty {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
        padding: 76px 24px;
        text-align: center;
    }

    .claims-empty i {
        color: #c68a5a;
        font-size: 64px;
        margin-bottom: 18px;
    }

    .claims-empty h2 {
        color: #3d2b1f;
        font-size: 28px;
        margin-bottom: 12px;
    }

    .claims-empty p {
        color: #6f5647;
        margin-bottom: 26px;
    }

    .browse-food-link {
        background: #9f653a;
        border-radius: 8px;
        color: #ffffff;
        display: inline-flex;
        font-weight: 700;
        padding: 13px 18px;
    }

    @media (max-width: 768px) {
        .page-banner {
            padding: 70px 20px;
        }

        .banner-content h1 {
            font-size: 36px;
        }

        .claims-section {
            padding: 36px 20px 70px;
        }
    }
</style>

@endsection

@section('content')

<section class="page-banner">
    <div class="banner-content">
        <h1>My Food Requests</h1>
        <p>Track the status of every food item you have requested.</p>
    </div>
</section>

<section class="claims-section">
    @if($claims->isEmpty())
        <div class="claims-empty">
            <i class="fa-solid fa-clipboard-list"></i>
            <h2>You haven't requested any items yet.</h2>
            <p>Browse available food and request an item when something fits your needs.</p>
            <a class="browse-food-link" href="{{ route('foods.index') }}">
                Browse Available Food
            </a>
        </div>
    @else
        <div class="claims-table-wrap">
            <table class="claims-table">
                <thead>
                    <tr>
                        <th>Food Name</th>
                        <th>Category</th>
                        <th>Expiry Date</th>
                        <th>Pickup Location</th>
                        <th>Status</th>
                        <th>Date Requested</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($claims as $claim)
                        @php
                            $food = $claim->foodItem;
                            $status = $claim->status_sfwr;
                            $statusMap = [
                                'pending' => ['status-badge--pending', '⏳ Pending'],
                                'approved' => ['status-badge--approved', '✅ Approved'],
                                'rejected' => ['status-badge--rejected', '❌ Rejected'],
                            ];
                            [$statusClass, $statusLabel] = $statusMap[$status] ?? ['status-badge--pending', ucfirst($status)];
                        @endphp

                        <tr>
                            <td class="claim-food-name">
                                {{ $food->foodname_sfwr ?? 'Item Unavailable' }}
                            </td>
                            <td>{{ $food->foodcategory_sfwr ?? 'N/A' }}</td>
                            <td>
                                {{ $food ? \Carbon\Carbon::parse($food->expiry_date_sfwr)->format('M d, Y') : 'N/A' }}
                            </td>
                            <td>{{ $food->pickup_location_sfwr ?? 'N/A' }}</td>
                            <td>
                                <span class="status-badge {{ $statusClass }}">
                                    {{ $statusLabel }}
                                </span>
                            </td>
                            <td>
                                {{ $claim->claimed_at ? \Carbon\Carbon::parse($claim->claimed_at)->format('M d, Y') : 'N/A' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</section>

@endsection
