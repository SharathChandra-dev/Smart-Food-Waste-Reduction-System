@extends('Admin.layout')

@section('styles')
    @vite('resources/css/Admin/admin_dashboard.css')
@endsection

@section('content')

<div class="dashboard-container">
    <h1>Contact Requests</h1>

    @if(session('success'))
        <div class="alert alert-success" style="margin-bottom: 20px; padding: 12px; background: #e6ffed; border: 1px solid #b8f3c8; color: #1a6f38;">
            {{ session('success') }}
        </div>
    @endif

    @if($contacts->isEmpty())
        <p>No contact requests have been submitted yet.</p>
    @else
        <div class="contacts-table" style="overflow-x:auto;">
            <table style="width:100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="text-align:left; padding: 12px; border-bottom: 1px solid #ddd;">Name</th>
                        <th style="text-align:left; padding: 12px; border-bottom: 1px solid #ddd;">Email</th>
                        <th style="text-align:left; padding: 12px; border-bottom: 1px solid #ddd;">Message</th>
                        <th style="text-align:left; padding: 12px; border-bottom: 1px solid #ddd;">Status</th>
                        <th style="text-align:left; padding: 12px; border-bottom: 1px solid #ddd;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                            <td style="padding: 12px; border-bottom: 1px solid #f0f0f0;">{{ $contact->name_sfwr }}</td>
                            <td style="padding: 12px; border-bottom: 1px solid #f0f0f0;">{{ $contact->email_sfwr }}</td>
                            <td style="padding: 12px; border-bottom: 1px solid #f0f0f0;">{{ \Illuminate\Support\Str::limit($contact->message_sfwr, 120) }}</td>
                            <td style="padding: 12px; border-bottom: 1px solid #f0f0f0;">
                                @if($contact->replied_at_sfwr)
                                    Replied on {{ $contact->replied_at_sfwr->format('Y-m-d H:i') }}
                                @else
                                    Pending reply
                                @endif
                            </td>
                            <td style="padding: 12px; border-bottom: 1px solid #f0f0f0;">
                                <form method="POST" action="{{ route('admin.contacts.reply', $contact) }}">
                                    @csrf
                                    <textarea name="admin_response" rows="3" placeholder="Reply to {{ $contact->name_sfwr }}" required style="width:100%; padding:10px; margin-bottom:8px;">{{ old('admin_response', $contact->admin_response_sfwr) }}</textarea>
                                    <button type="submit" style="padding: 10px 14px; background:#1f4d9a; color:#fff; border:none; cursor:pointer;">Send Reply</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@endsection
