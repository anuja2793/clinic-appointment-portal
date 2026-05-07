<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'phone'   => ['required', 'regex:/^[6-9]\d{9}$/'],
            'email'   => 'nullable|email|max:100',
            'subject' => 'required|string',
            'message' => 'required|string|max:1000',
        ], [
            'phone.regex' => 'Please enter a valid 10-digit Indian mobile number.',
        ]);

        // ✅ STEP 1 — Save to database
        ContactMessage::create($validated);

        // ✅ STEP 2 — Send email to doctor
        try {
            Mail::raw(
                "New Contact Message — Dr. Sharma Clinic\n\n"
                . "Name    : {$validated['name']}\n"
                . "Phone   : {$validated['phone']}\n"
                . "Email   : " . ($validated['email'] ?? 'Not provided') . "\n"
                . "Subject : {$validated['subject']}\n\n"
                . "Message :\n{$validated['message']}",
                fn($msg) => $msg
                    ->to('doravoice77@gmail.com')
                    ->subject("📋 Clinic Contact: {$validated['subject']}")
            );
        } catch (\Exception $e) {
            Log::error('Email failed: ' . $e->getMessage());
        }

        return redirect()->route('contact')
            ->with('success', "Thank you {$validated['name']}! We'll get back to you within 24 hours.");
    }
}