@extends('admin.layout')

@section('styles')
    @vite('resources/css/Admin/admin_users.css')
    <style>
        .users-container {
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

        .add-user-btn {
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

        .add-user-btn:hover {
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

        .no-users {
            text-align: center;
            padding: 40px;
            background: rgba(255,255,255,0.85);
            border-radius: 16px;
            color: #6c5647;
        }

        @media (max-width: 768px) {
            .header-section {
                flex-direction: column;
            }

            .add-user-btn {
                width: 100%;
                text-align: center;
            }

            table {
                font-size: 12px;
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
        }
    </style>
@endsection

@section('content')

<div class="users-container">
    <div class="header-section">
        <h1>Users Management</h1>
        <button class="add-user-btn" onclick="openAddUserModal()">+ Add New User</button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            ✓ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            ✗ {{ session('error') }}
        </div>
    @endif

    @if(isset($users) && count($users) > 0)
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user['id'] ?? 'N/A' }}</td>
                    <td>{{ $user['name'] ?? 'N/A' }}</td>
                    <td>{{ $user['email'] ?? 'N/A' }}</td>
                    <td>{{ $user['role'] ?? 'User' }}</td>
                    <td>{{ $user['created_at'] ?? 'N/A' }}</td>
                    <td>
                        <div class="action-buttons">
                            <button class="edit-btn" data-user='@json($user)' onclick="openEditUserModal(this)">Edit</button>
                            <form action="{{ route('admin.users.destroy', $user['id']) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-users">
            <p>📋 No users found. Click "Add New User" to create one.</p>
        </div>
    @endif
</div>

<!-- Add User Modal -->
<div id="addUserModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Add New User</h2>
            <button class="close-btn" onclick="closeAddUserModal()">&times;</button>
        </div>
        <form class="modal-form" action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="User Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <select name="role" required>
                <option value="User">User</option>
                <option value="Admin">Admin</option>
            </select>
            <input type="password" name="password" placeholder="Password" required>
            <div style="display: flex; gap: 10px;">
                <button type="submit" class="btn" style="flex: 1; margin: 0;">Add User</button>
                <button type="button" onclick="closeAddUserModal()" style="flex: 1; background: #ccc; color: #333;">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit User Modal -->
<div id="editUserModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Edit User</h2>
            <button class="close-btn" onclick="closeEditUserModal()">&times;</button>
        </div>
        <form class="modal-form" id="editUserForm" method="POST">
            @csrf
            @method('PUT')
            <input type="text" name="name" id="editUserName" placeholder="User Name" required>
            <input type="email" name="email" id="editUserEmail" placeholder="Email Address" required>
            <select name="role" id="editUserRole" required>
                <option value="User">User</option>
                <option value="Admin">Admin</option>
            </select>
            <input type="password" name="password" placeholder="Password (leave blank to keep current)" >
            <div style="display: flex; gap: 10px;">
                <button type="submit" class="btn" style="flex: 1; margin: 0;">Update User</button>
                <button type="button" onclick="closeEditUserModal()" style="flex: 1; background: #ccc; color: #333;">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openAddUserModal() {
        document.getElementById('addUserModal').classList.add('active');
    }

    function closeAddUserModal() {
        document.getElementById('addUserModal').classList.remove('active');
    }

    function openEditUserModal(button) {
        const user = JSON.parse(button.dataset.user);
        document.getElementById('editUserName').value = user.name || '';
        document.getElementById('editUserEmail').value = user.email || '';
        document.getElementById('editUserRole').value = user.role || 'User';
        
        document.getElementById('editUserForm').action = '/admin/users/update/' + user.id;
        document.getElementById('editUserModal').classList.add('active');
    }

    function closeEditUserModal() {
        document.getElementById('editUserModal').classList.remove('active');
    }

    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        const addModal = document.getElementById('addUserModal');
        const editModal = document.getElementById('editUserModal');

        if (event.target === addModal) {
            closeAddUserModal();
        }
        if (event.target === editModal) {
            closeEditUserModal();
        }
    });

    // Close alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });
</script>

@endsection
