<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function index()
    {
        return view('pages.appointment');
    }

    public function store(Request $request)
    {
        // ── VALIDATION ──
        $validated = $request->validate([
    'name'    => 'required|string|max:100',
    'phone'   => 'required|digits:10',
    'date'    => 'required|date|after_or_equal:today',
    'time'    => 'required|string',
    'reason'  => 'required|string',
    'message' => 'nullable|string|max:500',
], [
    'phone.digits'        => 'Please enter a valid 10-digit mobile number.',
    'date.after_or_equal' => 'Please select today or a future date.',
]);

        //  STEP 1 — Save to database
        Appointment::create($validated);

        //  STEP 2 — Send email to doctor
        try {
            Mail::raw(
                "New Appointment Request — Dr. Sharma Clinic\n\n"
                . "Name    : {$validated['name']}\n"
                . "Phone   : {$validated['phone']}\n"
                . "Date    : {$validated['date']}\n"
                . "Time    : {$validated['time']}\n"
                . "Reason  : {$validated['reason']}\n\n"
                . "Message :\n" . ($validated['message'] ?? 'No additional message'),
                fn($msg) => $msg
                    ->to('doravoice77@gmail.com')
                    ->subject("📅 New Appointment: {$validated['name']} on {$validated['date']}")
            );
        } catch (\Exception $e) {
            Log::error('Appointment email failed: ' . $e->getMessage());
        }

        return redirect()->route('appointment')
            ->with('success', "Thank you {$validated['name']}! Your appointment request for {$validated['date']} at {$validated['time']} has been received. We'll confirm via call or WhatsApp shortly.");
    }
}