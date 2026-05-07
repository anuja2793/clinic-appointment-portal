@extends('layouts.app')
@section('title', 'Contact Us — Dr. R. Sharma Clinic')

@push('styles')
<style>
.contact-grid { display: grid; grid-template-columns: 1fr 1.3fr; gap: 60px; max-width: 1100px; margin: 0 auto; align-items: start; }
.contact-left { display: flex; flex-direction: column; gap: 20px; }

.contact-method-card {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius);
    padding: 24px;
    display: flex;
    align-items: flex-start;
    gap: 18px;
    text-decoration: none;
    transition: all 0.25s;
}
.contact-method-card:hover { border-color: var(--border); transform: translateX(4px); }
.cm-icon {
    width: 48px; height: 48px;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
}
.cm-icon.phone { background: rgba(78,205,196,0.15); }
.cm-icon.wa { background: rgba(37,211,102,0.15); }
.cm-icon.email { background: rgba(201,168,76,0.15); }
.cm-icon.maps { background: rgba(239,68,68,0.1); }
.cm-text strong { display: block; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; color: var(--text-secondary); margin-bottom: 4px; }
.cm-text span { font-size: 15px; color: var(--text-primary); font-weight: 500; }
.cm-text small { display: block; font-size: 12px; color: var(--text-muted); margin-top: 3px; }

.social-row { display: flex; gap: 10px; }
.social-btn {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius);
    padding: 16px;
    text-decoration: none;
    color: var(--text-secondary);
    font-size: 12px;
    transition: all 0.25s;
}
.social-btn i { font-size: 20px; }
.social-btn:hover { border-color: var(--border); color: var(--text-primary); background: var(--bg-card-hover); }
.social-btn.fb:hover i { color: #1877f2; }
.social-btn.ig:hover i { color: #e1306c; }
.social-btn.wa:hover i { color: #25d366; }
.social-btn.yt:hover i { color: #ff0000; }

.contact-form-card {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: 24px;
    padding: 48px;
}
.contact-form-card h2 { font-family: 'Cormorant Garamond', serif; font-size: 28px; margin-bottom: 8px; }
.contact-form-card .sub { font-size: 14px; color: var(--text-secondary); margin-bottom: 32px; }

.reveal { opacity:0; transform:translateY(20px); transition:all 0.6s ease; }
.reveal.visible { opacity:1; transform:translateY(0); }

@media (max-width: 900px) { .contact-grid { grid-template-columns: 1fr; } }
@media (max-width: 500px) { .contact-form-card { padding: 28px; } }
</style>
@endpush

@section('content')
<div class="page-hero">
    <div class="breadcrumb"><a href="{{ route('home') }}">Home</a><i class="fas fa-chevron-right"></i><span>Contact</span></div>
    <h1 class="page-title">Get in <span>Touch</span></h1>
    <p style="color:var(--text-secondary);font-size:15px;margin-top:12px;">We're here to help — reach us through any channel</p>
</div>

<section class="section" style="padding-top:40px;">
    <div class="contact-grid">

        <!-- LEFT -->
        <div class="contact-left">
            <a href="tel:+919999999999" class="contact-method-card reveal">
                <div class="cm-icon phone"><i class="fas fa-phone" style="color:var(--accent)"></i></div>
                <div class="cm-text">
                    <strong>Call Us</strong>
                    <span>+91 99999 99999</span>
                    <small>Mon–Sat · 9am–1pm & 5pm–9pm</small>
                </div>
            </a>
            <a href="https://wa.me/919999999999?text=Hello%20Doctor" target="_blank" class="contact-method-card reveal" style="transition-delay:0.1s">
                <div class="cm-icon wa"><i class="fab fa-whatsapp" style="color:#25d366"></i></div>
                <div class="cm-text">
                    <strong>WhatsApp</strong>
                    <span>+91 99999 99999</span>
                    <small>Fastest response — usually within 15 mins</small>
                </div>
            </a>
            <a href="mailto:dr.sharma@clinic.com" class="contact-method-card reveal" style="transition-delay:0.15s">
                <div class="cm-icon email"><i class="fas fa-envelope" style="color:var(--gold)"></i></div>
                <div class="cm-text">
                    <strong>Email</strong>
                    <span>dr.sharma@clinic.com</span>
                    <small>Response within 24 hours</small>
                </div>
            </a>
            <a href="https://maps.google.com/?q=Shivaji+Nagar+Mumbai" target="_blank" class="contact-method-card reveal" style="transition-delay:0.2s">
                <div class="cm-icon maps"><i class="fas fa-map-marker-alt" style="color:#ef4444"></i></div>
                <div class="cm-text">
                    <strong>Visit Us</strong>
                    <span>123, Shivaji Nagar, Mumbai</span>
                    <small>Near City Hospital · Get directions →</small>
                </div>
            </a>

            <!-- Social Media -->
            <div class="reveal" style="transition-delay:0.25s">
                <p style="font-size:12px;text-transform:uppercase;letter-spacing:2px;color:var(--accent);margin-bottom:14px;font-weight:500;">Follow Us</p>
                <div class="social-row">
                    <a href="#" class="social-btn fb"><i class="fab fa-facebook-f"></i><span>Facebook</span></a>
                    <a href="#" class="social-btn ig"><i class="fab fa-instagram"></i><span>Instagram</span></a>
                    <a href="https://wa.me/919999999999" class="social-btn wa" target="_blank"><i class="fab fa-whatsapp"></i><span>WhatsApp</span></a>
                    <a href="#" class="social-btn yt"><i class="fab fa-youtube"></i><span>YouTube</span></a>
                </div>
            </div>
        </div>

        <!-- CONTACT FORM -->
        <div class="contact-form-card reveal" style="transition-delay:0.1s">
            <h2>Send a Message</h2>
            <p class="sub">Have a question or feedback? We'd love to hear from you.</p>

            @if($errors->any())
            <div class="flash-error" style="margin-bottom:20px;">
                <i class="fas fa-exclamation-circle"></i>
                <div>@foreach($errors->all() as $e)<div>{{$e}}</div>@endforeach</div>
            </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Your Name *</label>
                    <input type="text" name="name" placeholder="Full name" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label>Phone / WhatsApp *</label>
                    <input type="tel" name="phone" placeholder="+91 XXXXX XXXXX" value="{{ old('phone') }}" required>
                </div>
                <div class="form-group">
                    <label>Email (Optional)</label>
                    <input type="email" name="email" placeholder="your@email.com" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label>Subject *</label>
                    <select name="subject" required>
                        <option value="">Select a subject</option>
                        <option value="Appointment Query">Appointment Query</option>
                        <option value="Medical Question">Medical Question</option>
                        <option value="Feedback">Feedback</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Message *</label>
                    <textarea name="message" placeholder="Write your message here..." required>{{ old('message') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:15px;border-radius:var(--radius-sm);">
                    <i class="fas fa-paper-plane"></i> Send Message
                </button>
            </form>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
const obs = new IntersectionObserver(e=>e.forEach(x=>{if(x.isIntersecting){x.target.classList.add('visible');obs.unobserve(x.target);}}),{threshold:0.1});
document.querySelectorAll('.reveal').forEach(el=>obs.observe(el));
</script>
@endpush
