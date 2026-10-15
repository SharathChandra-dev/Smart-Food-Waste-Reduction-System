@extends('admin.layout')

@section('styles')
    @vite('resources/css/Admin/fooditems.css')
    <style>
        .food-container {
            max-width: 1000px;
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .add-food-btn {
            background: linear-gradient(135deg, #c68a5a, #9f653a);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }

        .add-food-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(198,138,90,0.3);
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .action-buttons button {
            padding: 8px 12px;
            font-size: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.2s ease;
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
        }

        .edit-btn {
            background: rgba(76, 175, 80, 0.2);
            color: #2e7d32;
            border: 1px solid rgba(76, 175, 80, 0.3);
        }

        .edit-btn:hover {
            background: rgba(76, 175, 80, 0.3);
            transform: translateY(-2px);
        }

        .delete-btn {
            background: rgba(220, 80, 80, 0.2);
            color: #d4483d;
            border: 1px solid rgba(220, 80, 80, 0.3);
        }

        .delete-btn:hover {
            background: rgba(220, 80, 80, 0.3);
            transform: translateY(-2px);
        }

        .no-food {
            text-align: center;
            padding: 40px;
            background: rgba(255,255,255,0.85);
            border-radius: 16px;
            color: #6c5647;
        }

        .food-image {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            object-fit: cover;
            background: rgba(198,138,90,0.1);
        }

        .modal-form input[type="file"] {
            cursor: pointer;
        }

        /* Keep the add/edit dialogs over the viewport even if the Vite CSS is stale. */
        .modal {
            display: none !important;
            position: fixed !important;
            inset: 0 !important;
            z-index: 10000 !important;
            align-items: center !important;
            justify-content: center !important;
            overflow-y: auto;
            padding: 24px;
            background: rgba(15, 23, 42, 0.62);
            backdrop-filter: blur(3px);
        }

        .modal.active {
            display: flex !important;
        }

        .modal .modal-content {
            width: min(100%, 560px);
            max-height: calc(100vh - 48px);
            overflow-y: auto;
            margin: auto;
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 24px 70px rgba(15, 23, 42, 0.3);
        }

        button:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        }

        @media (max-width: 768px) {
            .header-section {
                flex-direction: column;
            }

            .add-food-btn {
                width: 100%;
                text-align: center;
            }

            table {
                font-size: 12px;
            }

            .food-image {
                width: 40px;
                height: 40px;
            }
        }

        @media (max-width: 300px) {
            .action-buttons {
                flex-direction: column;
                gap: 4px;
            }

            .action-buttons button {
                padding: 6px 8px;
                font-size: 10px;
                width: 100%;
            }

            .food-image {
                width: 30px;
                height: 30px;
            }
        }
    </style>
@endsection

@section('content')

<div class="food-container">

    <div class="header-section">
        <div>
            <span class="dashboard-kicker">Inventory</span>
            <h1>{{ $expiredView ? 'Expired Foods' : 'Food Items Management' }}</h1>
            <p class="food-page-subtitle">{{ $expiredView ? 'Review and remove food that is past its expiry date.' : 'Keep your listings current and easy to manage.' }}</p>
        </div>
        <button class="add-food-btn" onclick="openAddFoodModal()">+ Add Food Item</button>
    </div>

    <nav class="food-tabs" aria-label="Food item sections">
        <a href="{{ route('admin.food') }}" class="{{ empty($expiredView) ? 'active' : '' }}">
            All food <span>{{ $foodCounts['active'] ?? 0 }}</span>
        </a>
        <a href="{{ route('admin.food', ['status' => 'expired']) }}" class="{{ !empty($expiredView) ? 'active expired-tab' : '' }}">
            Expired foods <span>{{ $foodCounts['expired'] ?? 0 }}</span>
        </a>
    </nav>

    @if(session('success'))
        <div class="alert alert-success" role="status">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-error" role="alert">
            <strong>Please correct the following:</strong>
            <ul style="margin: 8px 0 0; padding-left: 22px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(isset($foodItems) && count($foodItems) > 0)

    <table>
        <thead>
        <tr>
            <th>S.No</th>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Expiry</th>
            <th>Image</th>
            <th>Available Till</th>
            <th>Actions</th>
        </tr>
        </thead>

        <tbody>
        @foreach($foodItems as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->id_food_sfwr }}</td>
            <td>{{ $item->foodname_sfwr }}</td>
            <td>{{ $item->foodcategory_sfwr }}</td>
            <td>{{ $item->expiry_date_sfwr }}</td>

            <td>
                @if($item->foodimage_sfwr)
                    <img class="food-image" src="{{ asset('storage/'.$item->foodimage_sfwr) }}" alt="Food image">
                @else
                    No Image
                @endif
            </td>

            <td>{{ $item->available_till_sfwr }}</td>

            <td>
                <div class="action-buttons">

                    <button type="button"
                        class="edit-btn"
                        onclick='openEditFoodModal(@json($item))'>
                        Edit
                    </button>

                    <form method="POST" action="{{ route('admin.food.destroy',$item->id_food_sfwr) }}">
                        @csrf
                        @method('DELETE')
                        <button class="delete-btn">Delete</button>
                    </form>

                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    @else
        <div class="no-food">{{ !empty($expiredView) ? 'There are no expired food items.' : 'There are no current food items.' }}</div>
    @endif
</div>

<!-- Add Food Item Modal -->
<div id="addFoodModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Add New Food Item</h2>
            <button class="close-btn" onclick="closeAddFoodModal()">&times;</button>
        </div>
        <form class="modal-form" id="addFoodForm" action="{{ route('admin.food.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="form_type" value="add">
            <!-- <input type="text" name="name" placeholder="Food Item Name" required>
            <input type="date" name="expiry_date" required>
            <input type="file" name="image" accept="image/*"> -->

            <input type="text" name="foodname_sfwr" placeholder="Food Name" value="{{ old('foodname_sfwr') }}" required>

            <input type="text" name="foodcategory_sfwr" placeholder="Category" value="{{ old('foodcategory_sfwr') }}" required>
            <h4>Manufacturing Date</h4>
            <input type="date" name="manufacturing_date_sfwr" placeholder="Manufacturing Date" value="{{ old('manufacturing_date_sfwr') }}" required>
            <h4>Expired Date</h4>
            <input type="date" name="expiry_date_sfwr" placeholder="Expiry Date" value="{{ old('expiry_date_sfwr') }}" required>

            <input type="number" name="foodquantity_sfwr" placeholder="Quantity" value="{{ old('foodquantity_sfwr') }}" min="1" required>

            <input type="number" name="calories_sfwr" placeholder="Calories" value="{{ old('calories_sfwr') }}" min="0" required>

            <textarea name="fooddescription_sfwr" placeholder="Food Description">{{ old('fooddescription_sfwr') }}</textarea>

            <input type="text" name="contact_sfwr" placeholder="Contact Number" value="{{ old('contact_sfwr') }}" required>

            <input type="text" name="pickup_location_sfwr" placeholder="Location" value="{{ old('pickup_location_sfwr') }}" required>
            <h4>Available Till</h4>
            <input type="datetime-local" name="available_till_sfwr" placeholder="Available Till" value="{{ old('available_till_sfwr') }}" required>

            <input type="file" name="image">

            <div style="display: flex; gap: 10px;">
                <button type="submit" id="addBtn" class="btn" style="flex: 1; margin: 0;">Add Food</button>
                <button type="button" onclick="closeAddFoodModal()" style="flex: 1; background: #ccc; color: #333;">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Food Item Modal -->
<div id="editFoodModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Edit Food Item</h2>
            <button class="close-btn" onclick="closeEditFoodModal()">&times;</button>
        </div>
        <form class="modal-form" id="editFoodForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="form_type" value="edit">
            <input type="hidden" name="food_id">
            <!-- <input type="text" name="name" id="editFoodName" placeholder="Food Item Name" required>
            <input type="date" name="expiry_date" id="editFoodExpiry" required>
            <input type="file" name="image" accept="image/*"> -->
            <input type="text" name="foodname_sfwr" placeholder="Food Name" required>

            <input type="text" name="foodcategory_sfwr" placeholder="Category" required>

            <input type="date" name="manufacturing_date_sfwr" required>

            <input type="date" name="expiry_date_sfwr" required>

            <input type="number" name="foodquantity_sfwr" min="1" required>

            <input type="number" name="calories_sfwr" min="0" required>

            <textarea name="fooddescription_sfwr"></textarea>

            <input type="text" name="contact_sfwr" required>

            <input type="text" name="pickup_location_sfwr" required>

            <input type="datetime-local" name="available_till_sfwr" required>

            <input type="file" name="image">
            
            <small style="color: #a08070;">Leave image blank to keep current image</small>
            <div style="display: flex; gap: 10px;">
                <button type="submit" class="btn" style="flex: 1; margin: 0;">Update Food</button>
                <button type="button" onclick="closeEditFoodModal()" style="flex: 1; background: #ccc; color: #333;">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>

let addForm = document.getElementById("addFoodForm");
let editForm = document.getElementById("editFoodForm");

/* -----------------------------
   OPEN / CLOSE ADD MODAL
------------------------------*/

function openAddFoodModal(){
    document.getElementById('addFoodModal').classList.add('active');
}

function closeAddFoodModal(){
    document.getElementById('addFoodModal').classList.remove('active');
    addForm.reset();
}

/* -----------------------------
   OPEN EDIT (FIXED SCOPING BUG)
------------------------------*/

// function openEditFoodModal(item){

//     document.getElementById('editFoodModal').classList.add('active');

//     editForm.reset(); // IMPORTANT: prevents old data sticking

//     editForm.action = `/admin/food/update/${item.id_food_sfwr}`;

//     editForm.foodname_sfwr.value = item.foodname_sfwr ?? '';
//     editForm.foodcategory_sfwr.value = item.foodcategory_sfwr ?? '';
//     editForm.manufacturing_date_sfwr.value = item.manufacturing_date_sfwr ?? '';
//     editForm.expiry_date_sfwr.value = item.expiry_date_sfwr ?? '';
//     editForm.foodquantity_sfwr.value = item.foodquantity_sfwr ?? '';
//     editForm.calories_sfwr.value = item.calories_sfwr ?? '';
//     editForm.fooddescription_sfwr.value = item.fooddescription_sfwr ?? '';
//     editForm.contact_sfwr.value = item.contact_sfwr ?? '';
//     editForm.pickup_location_sfwr.value = item.pickup_location_sfwr ?? '';

//     if(item.available_till_sfwr){
//         editForm.available_till_sfwr.value =
//             item.available_till_sfwr.replace(' ', 'T');
//     }
// }


function openEditFoodModal(item){

    document.getElementById('editFoodModal').classList.add('active');

    editForm.reset();

    editForm.action = `/admin/food/update/${item.id_food_sfwr}`;
    editForm.elements.namedItem('food_id').value = item.id_food_sfwr;

    editForm.querySelector('[name="foodname_sfwr"]').value          = item.foodname_sfwr ?? '';
    editForm.querySelector('[name="foodcategory_sfwr"]').value      = item.foodcategory_sfwr ?? '';
    editForm.querySelector('[name="manufacturing_date_sfwr"]').value = String(item.manufacturing_date_sfwr ?? '').slice(0, 10);
    editForm.querySelector('[name="expiry_date_sfwr"]').value       = String(item.expiry_date_sfwr ?? '').slice(0, 10);
    editForm.querySelector('[name="foodquantity_sfwr"]').value      = item.foodquantity_sfwr ?? '';
    editForm.querySelector('[name="calories_sfwr"]').value          = item.calories_sfwr ?? '';
    editForm.querySelector('[name="fooddescription_sfwr"]').value   = item.fooddescription_sfwr ?? '';
    editForm.querySelector('[name="contact_sfwr"]').value           = item.contact_sfwr ?? '';
    editForm.querySelector('[name="pickup_location_sfwr"]').value   = item.pickup_location_sfwr ?? '';

    if(item.available_till_sfwr){
        editForm.querySelector('[name="available_till_sfwr"]').value =
            String(item.available_till_sfwr).replace(' ', 'T').slice(0, 16);
    }
}


/* -----------------------------
   CLOSE EDIT MODAL
------------------------------*/

function closeEditFoodModal(){
    document.getElementById('editFoodModal').classList.remove('active');
    editForm.reset();
}

/* -----------------------------
   DATE VALIDATION (ADD + EDIT)
------------------------------*/

function validateDate(input){

    if(!input.value) return;

    let now = new Date();
    let val = new Date(input.value);

    if(val <= now){
        alert("Available Till must be greater than current date & time");
        input.value = "";
    }
}

/* attach to BOTH add + edit inputs */
document.querySelectorAll('input[name="available_till_sfwr"]').forEach(i=>{
    i.addEventListener('change', ()=>validateDate(i));
});

/* -----------------------------
   CLOSE MODALS ON OUTSIDE CLICK
------------------------------*/

window.addEventListener('click', function(event) {

    const addModal = document.getElementById('addFoodModal');
    const editModal = document.getElementById('editFoodModal');

    if (event.target === addModal) closeAddFoodModal();
    if (event.target === editModal) closeEditFoodModal();
});

@if($errors->any() && old('form_type') === 'add')
openAddFoodModal();
@elseif($errors->any() && old('form_type') === 'edit')
openEditFoodModal({
    id_food_sfwr: @json(old('food_id')),
    foodname_sfwr: @json(old('foodname_sfwr')),
    foodcategory_sfwr: @json(old('foodcategory_sfwr')),
    manufacturing_date_sfwr: @json(old('manufacturing_date_sfwr')),
    expiry_date_sfwr: @json(old('expiry_date_sfwr')),
    foodquantity_sfwr: @json(old('foodquantity_sfwr')),
    calories_sfwr: @json(old('calories_sfwr')),
    fooddescription_sfwr: @json(old('fooddescription_sfwr')),
    contact_sfwr: @json(old('contact_sfwr')),
    pickup_location_sfwr: @json(old('pickup_location_sfwr')),
    available_till_sfwr: @json(old('available_till_sfwr'))
});
@endif

</script>

@endsection
