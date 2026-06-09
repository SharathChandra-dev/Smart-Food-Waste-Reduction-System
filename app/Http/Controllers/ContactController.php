<?php

namespace App\Http\Controllers;

use App\Mail\ContactReplyMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Contact::create([
            'name_sfwr' => $request->name,
            'email_sfwr' => $request->email,
            'subject_sfwr' => $request->input('subject', 'Contact Form Submission'),
            'message_sfwr' => $request->message,
        ]);

        return back()->with('success', 'Message sent successfully.');
    }

    public function index()
    {
        $contacts = Contact::latest()->get();

        return view('Admin.admin_contacts', compact('contacts'));
    }

    public function reply(Request $request, Contact $contact)
    {
        $request->validate([
            'admin_response' => 'required|string',
        ]);

        $contact->admin_response_sfwr = $request->admin_response;
        $contact->replied_at_sfwr = now();
        $contact->save();

        Mail::to($contact->email_sfwr)->send(new ContactReplyMail($contact));

        return back()->with('success', 'Reply sent successfully to ' . $contact->email_sfwr);
    }
}