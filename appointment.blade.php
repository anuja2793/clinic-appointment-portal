@extends('layouts.app')
@section('title', 'Book Appointment — Dr. R. Sharma Clinic')

@push('styles')
<style>
.appt-grid { display: grid; grid-template-columns: 1.4fr 1fr; gap: 60px; max-width: 1100px; margin: 0 auto; align-items: start; }

.appt-form-card {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: 24px;
    padding: 48px;
}
.appt-form-card h2 {
    font-family: 'Cormorant Garamond', serif;
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 8px;
}
.appt-form-card .sub { font-size: 14px; color: var(--text-secondary); margin-bottom: 32px; }

.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

.submit-btn {
    width: 100%;
    justify-content: center;
    padding: 16px;
    font-size: 15px;
    border-radius: var(--radius-sm);
    margin-top: 8px;
}

.side-info { position: sticky; top: 100px; display: flex; flex-direction: column; gap: 16px; }

.info-card {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius);
    padding: 24px;
}
.info-card h4 {
    font-size: 12px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--accent);
    margin-bottom: 16px;
    font-weight: 500;
}
.timing-row {
    display: flex; justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid var(--border-subtle);
    font-size: 13px;
}
.timing-row:last-child { border: none; }
.timing-row span { color: var(--text-secondary); }
.timing-row strong { color: var(--accent); }
.timing-row.closed strong { color: var(--text-muted); }

.wa-book-btn {
    display: flex; align-items: center; gap: 12px;
    background: rgba(37,211,102,0.1);
    border: 1px solid rgba(37,211,102,0.3);
    border-radius: var(--radius);
    padding: 18px;
    text-decoration: none;
    color: #4ade80;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.25s;
}
.wa-book-btn:hover { background: rgba(37,211,102,0.2); transform: translateY(-2px); }
.wa-book-btn i { font-size: 22px; }

.note-box {
    background: var(--accent-soft);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    padding: 14px 16px;
    font-size: 13px;
    color: var(--accent);
    display: flex; gap: 10px; align-items: flex-start;
}
.note-box i { margin-top: 2px; flex-shrink: 0; }

@media (max-width: 900px) { .appt-grid { grid-template-columns: 1fr; } .side-info { position: static; } }
@media (max-width: 600px) { .appt-form-card { padding: 28px; } .form-row { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<div class="page-hero">
    <div class="breadcrumb"><a href="{{ route('home') }}">Home</a><i class="fas fa-chevron-right"></i><span>Book Appointment</span></div>
    <h1 class="page-title">Book an <span>Appointment</span></h1>
    <p style="color:var(--text-secondary);font-size:15px;margin-top:12px;">Fill the form below — we'll confirm within 1 hour</p>
</div>

<section class="section" style="padding-top: 40px;">
    <div class="appt-grid">

        <!-- FORM -->
        <div class="appt-form-card">
            <h2>Appointment Request</h2>
            <p class="sub">All fields marked with * are required. We'll confirm via call or WhatsApp.</p>

            @if($errors->any())
                <div class="flash-error" style="margin-bottom:20px;">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>
                        @foreach($errors->all() as $err)
                            <div>{{ $err }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            <form action="{{ route('appointment.store') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label>Full Name *</label>
                        <input type="text" name="name" placeholder="Your full name" value="{{ old('name') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number *</label>
                        <input type="tel" name="phone" placeholder="+91 XXXXX XXXXX" value="{{ old('phone') }}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Preferred Date *</label>
                        <input type="date" name="date" value="{{ old('date') }}" min="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Preferred Time *</label>
                        <select name="time" required>
                            <option value="">Select Time Slot</option>
                            <optgroup label="Morning (9am–1pm)">
                                <option value="9:00 AM" {{ old('time')=='9:00 AM'?'selected':'' }}>9:00 AM</option>
                                <option value="9:30 AM" {{ old('time')=='9:30 AM'?'selected':'' }}>9:30 AM</option>
                                <option value="10:00 AM" {{ old('time')=='10:00 AM'?'selected':'' }}>10:00 AM</option>
                                <option value="10:30 AM" {{ old('time')=='10:30 AM'?'selected':'' }}>10:30 AM</option>
                                <option value="11:00 AM" {{ old('time')=='11:00 AM'?'selected':'' }}>11:00 AM</option>
                                <option value="11:30 AM" {{ old('time')=='11:30 AM'?'selected':'' }}>11:30 AM</option>
                                <option value="12:00 PM" {{ old('time')=='12:00 PM'?'selected':'' }}>12:00 PM</option>
                                <option value="12:30 PM" {{ old('time')=='12:30 PM'?'selected':'' }}>12:30 PM</option>
                            </optgroup>
                            <optgroup label="Evening (5pm–9pm)">
                                <option value="5:00 PM" {{ old('time')=='5:00 PM'?'selected':'' }}>5:00 PM</option>
                                <option value="5:30 PM" {{ old('time')=='5:30 PM'?'selected':'' }}>5:30 PM</option>
                                <option value="6:00 PM" {{ old('time')=='6:00 PM'?'selected':'' }}>6:00 PM</option>
                                <option value="6:30 PM" {{ old('time')=='6:30 PM'?'selected':'' }}>6:30 PM</option>
                                <option value="7:00 PM" {{ old('time')=='7:00 PM'?'selected':'' }}>7:00 PM</option>
                                <option value="7:30 PM" {{ old('time')=='7:30 PM'?'selected':'' }}>7:30 PM</option>
                                <option value="8:00 PM" {{ old('time')=='8:00 PM'?'selected':'' }}>8:00 PM</option>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Reason for Visit *</label>
                    <select name="reason" required>
                        <option value="">Select reason</option>
                        <option value="General Checkup">General Checkup</option>
                        <option value="Fever / Infection">Fever / Infection</option>
                        <option value="Diabetes Consultation">Diabetes Consultation</option>
                        <option value="Blood Pressure">Blood Pressure</option>
                        <option value="Respiratory Issues">Respiratory Issues</option>
                        <option value="Follow-up Visit">Follow-up Visit</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Additional Message (Optional)</label>
                    <textarea name="message" placeholder="Any specific symptoms or things the doctor should know beforehand...">{{ old('message') }}</textarea>
                </div>
                <div class="note-box" style="margin-bottom: 20px;">
                    <i class="fas fa-info-circle"></i>
                    <span>Your appointment is not confirmed until you receive a call/WhatsApp from our clinic. Please keep your phone reachable.</span>
                </div>
                <button type="submit" class="btn btn-primary submit-btn">
                    <i class="fas fa-calendar-check"></i> Submit Appointment Request
                </button>
            </form>
        </div>

        <!-- SIDE INFO -->
        <div class="side-info">
            <div class="info-card">
                <h4>Clinic Timings</h4>
                <div class="timing-row"><span>Mon – Fri</span><strong>9:00 AM – 1:00 PM</strong></div>
                <div class="timing-row"><span>Mon – Fri</span><strong>5:00 PM – 9:00 PM</strong></div>
                <div class="timing-row"><span>Saturday</span><strong>9:00 AM – 1:00 PM</strong></div>
                <div class="timing-row closed"><span>Sunday</span><strong>Closed</strong></div>
            </div>

            <a href="https://wa.me/919999999999?text=Hi%20Doctor,%20I%20want%20to%20book%20an%20appointment" class="wa-book-btn" target="_blank">
                <i class="fab fa-whatsapp"></i>
                <div>
                    <div style="font-size:15px;font-weight:500;">Book via WhatsApp</div>
                    <div style="font-size:12px;color:rgba(74,222,128,0.7);margin-top:2px;">Fastest response — usually in 15 mins</div>
                </div>
            </a>

            <div class="info-card">
                <h4>Contact Directly</h4>
                <div style="display:flex;flex-direction:column;gap:12px;">
                    <a href="tel:+919999999999" style="display:flex;align-items:center;gap:10px;color:var(--text-secondary);text-decoration:none;font-size:14px;transition:color 0.2s;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-secondary)'">
                        <i class="fas fa-phone" style="color:var(--accent);width:16px;"></i> +91 99999 99999
                    </a>
                    <a href="mailto:dr.sharma@clinic.com" style="display:flex;align-items:center;gap:10px;color:var(--text-secondary);text-decoration:none;font-size:14px;transition:color 0.2s;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-secondary)'">
                        <i class="fas fa-envelope" style="color:var(--accent);width:16px;"></i> dr.sharma@clinic.com
                    </a>
                    <div style="display:flex;align-items:flex-start;gap:10px;font-size:13px;color:var(--text-secondary);">
                        <i class="fas fa-map-marker-alt" style="color:var(--accent);width:16px;margin-top:3px;flex-shrink:0;"></i>
                        123, Shivaji Nagar, Near City Hospital, Mumbai - 400001
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
