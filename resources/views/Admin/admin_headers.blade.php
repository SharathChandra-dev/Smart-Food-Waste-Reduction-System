@extends('admin.layout')

@section('styles')
    @vite('resources/css/Admin/admin_users.css')
    <style>
        .headers-container {
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

        .header-card {
            background: rgba(255,255,255,0.9);
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            margin-bottom: 20px;
        }

        .header-card h3 {
            margin: 0 0 10px;
            font-size: 18px;
            color: #5d4037;
        }

        .header-card p {
            margin: 0;
            color: #6c5647;
            font-size: 14px;
            line-height: 1.7;
        }

        .headers-table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(255,255,255,0.9);
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            border-radius: 20px;
            overflow: hidden;
        }

        .headers-table thead {
            background: #f4ebe5;
        }

        .headers-table th,
        .headers-table td {
            padding: 16px 18px;
            text-align: left;
        }

        .headers-table th {
            font-weight: 600;
            color: #5d4037;
        }

        .headers-table tbody tr:nth-child(even) {
            background: rgba(244,235,229,0.8);
        }

        .header-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .header-actions button,
        .header-actions form button {
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
        }

        .delete-btn {
            background: rgba(220, 80, 80, 0.2);
            color: #d4483d;
            border: 1px solid rgba(220, 80, 80, 0.3);
        }

        .delete-btn:hover {
            background: rgba(220, 80, 80, 0.3);
        }

        .no-headers {
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
            }

            .headers-table th,
            .headers-table td {
                padding: 12px 10px;
            }
        }
    </style>
@endsection

@section('content')

<div class="headers-container">
    <div class="header-section">
        <h1>Header Management</h1>
        <button class="add-user-btn" onclick="openAddHeaderModal()">+ Add Header</button>
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

    @if(isset($headers) && count($headers) > 0)
        <table class="headers-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Page Type</th>
                    <th>Heading</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($headers as $header)
                    <tr>
                        <td>{{ $header->id_header_sfwr }}</td>
                        <td>{{ ucfirst($header->page_type_sfwr) }}</td>
                        <td>{{ $header->heading_sfwr }}</td>
                        <td>{{ $header->created_at?->format('Y-m-d') ?? 'N/A' }}</td>
                        <td>
                            <div class="header-actions">
                                <button class="edit-btn" data-header='@json($header)' onclick="openEditHeaderModal(this)">Edit</button>
                                <form action="{{ route('admin.headers.delete', $header->id_header_sfwr) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn" onclick="return confirm('Delete this header?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-headers">
            <p>📋 No headers found. Click "Add Header" to create one.</p>
        </div>
    @endif
</div>

<div id="addHeaderModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Add Header</h2>
            <button class="close-btn" onclick="closeAddHeaderModal()">&times;</button>
        </div>
        <form class="modal-form" action="{{ route('admin.headers.store') }}" method="POST">
            @csrf
            <select name="page_type" required>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
            <input type="text" name="heading" placeholder="Header Text" required>
            <div style="display:flex;gap:10px;flex-wrap:wrap;">
                <button type="submit" class="btn" style="flex:1;">Add Header</button>
                <button type="button" onclick="closeAddHeaderModal()" style="flex:1;background:#ccc;color:#333;">Cancel</button>
            </div>
        </form>
    </div>
</div>

<div id="editHeaderModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Edit Header</h2>
            <button class="close-btn" onclick="closeEditHeaderModal()">&times;</button>
        </div>
        <form class="modal-form" id="editHeaderForm" method="POST">
            @csrf
            @method('PUT')
            <input type="text" name="heading" id="editHeaderHeading" placeholder="Header Text" required>
            <div style="display:flex;gap:10px;flex-wrap:wrap;">
                <button type="submit" class="btn" style="flex:1;">Update Header</button>
                <button type="button" onclick="closeEditHeaderModal()" style="flex:1;background:#ccc;color:#333;">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openAddHeaderModal() {
        document.getElementById('addHeaderModal').classList.add('active');
    }

    function closeAddHeaderModal() {
        document.getElementById('addHeaderModal').classList.remove('active');
    }

    function openEditHeaderModal(button) {
        const header = JSON.parse(button.dataset.header);
        document.getElementById('editHeaderHeading').value = header.heading_sfwr || '';
        document.getElementById('editHeaderForm').action = '/admin/headers/update/' + header.id_header_sfwr;
        document.getElementById('editHeaderModal').classList.add('active');
    }

    function closeEditHeaderModal() {
        document.getElementById('editHeaderModal').classList.remove('active');
    }

    window.addEventListener('click', function(event) {
        const addModal = document.getElementById('addHeaderModal');
        const editModal = document.getElementById('editHeaderModal');

        if (event.target === addModal) {
            closeAddHeaderModal();
        }
        if (event.target === editModal) {
            closeEditHeaderModal();
        }
    });
</script>

@endsection
