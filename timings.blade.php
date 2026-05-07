@extends('layouts.app')
@section('title', 'Timings & Location — Dr. R. Sharma Clinic')

@push('styles')
<style>
.timings-grid { display: grid; grid-template-columns: 1fr 1.6fr; gap: 48px; max-width: 1200px; margin: 0 auto; align-items: start; }

.timings-card {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: 24px;
    padding: 40px;
    position: sticky;
    top: 100px;
}
.timings-card h3 { font-family: 'Cormorant Garamond', serif; font-size: 24px; font-weight: 600; margin-bottom: 24px; }

.day-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 0;
    border-bottom: 1px solid var(--border-subtle);
}
.day-row:last-child { border: none; }
.day-name { font-size: 14px; font-weight: 500; }
.day-slots { display: flex; flex-direction: column; align-items: flex-end; gap: 4px; }
.slot-pill {
    display: inline-block;
    background: var(--accent-soft);
    border: 1px solid var(--border);
    border-radius: 50px;
    padding: 3px 12px;
    font-size: 12px;
    color: var(--accent);
}
.slot-pill.closed {
    background: rgba(255,255,255,0.03);
    border-color: var(--border-subtle);
    color: var(--text-muted);
}
.today-badge {
    background: rgba(74,222,128,0.1);
    border: 1px solid rgba(74,222,128,0.3);
    border-radius: 4px;
    padding: 2px 8px;
    font-size: 11px;
    color: #4ade80;
    margin-left: 8px;
}

.location-card {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: 24px;
    overflow: hidden;
}
.map-embed {
    width: 100%;
    height: 360px;
    display: block;
    border: none;
    filter: invert(90%) hue-rotate(180deg);
}
.location-details { padding: 32px; }
.location-details h3 { font-family: 'Cormorant Garamond', serif; font-size: 22px; margin-bottom: 20px; }
.location-item { display: flex; align-items: flex-start; gap: 14px; margin-bottom: 16px; }
.location-item i { color: var(--accent); width: 18px; margin-top: 3px; flex-shrink: 0; }
.location-item div strong { display: block; font-size: 13px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 3px; }
.location-item div span { font-size: 14px; color: var(--text-secondary); }
.location-actions { display: flex; gap: 10px; margin-top: 24px; flex-wrap: wrap; }

.nearby-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; max-width: 1200px; margin: 0 auto; }
.nearby-card {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius);
    padding: 20px;
    text-align: center;
    font-size: 13px;
}
.nearby-card .nb-icon { font-size: 28px; margin-bottom: 10px; }
.nearby-card strong { display: block; font-size: 14px; margin-bottom: 4px; }
.nearby-card span { color: var(--text-secondary); }

.reveal { opacity:0; transform:translateY(20px); transition:all 0.6s ease; }
.reveal.visible { opacity:1; transform:translateY(0); }

@media (max-width: 900px) { .timings-grid { grid-template-columns: 1fr; } .timings-card { position: static; } .nearby-grid { grid-template-columns: 1fr 1fr; } }
@media (max-width: 500px) { .nearby-grid { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<div class="page-hero">
    <div class="breadcrumb"><a href="{{ route('home') }}">Home</a><i class="fas fa-chevron-right"></i><span>Timings & Location</span></div>
    <h1 class="page-title">Timings & <span>Location</span></h1>
    <p style="color:var(--text-secondary);font-size:15px;margin-top:12px;">Find us easily — we're right in the heart of Shivaji Nagar</p>
</div>

<section class="section" style="padding-top:40px;">
    <div class="timings-grid">

        <!-- TIMINGS -->
        <div class="timings-card reveal">
            <h3>Clinic Hours</h3>
            @php
            $today = strtolower(date('l'));
            $days = [
                'Monday'    => [['9:00 AM','1:00 PM'],['5:00 PM','9:00 PM']],
                'Tuesday'   => [['9:00 AM','1:00 PM'],['5:00 PM','9:00 PM']],
                'Wednesday' => [['9:00 AM','1:00 PM'],['5:00 PM','9:00 PM']],
                'Thursday'  => [['9:00 AM','1:00 PM'],['5:00 PM','9:00 PM']],
                'Friday'    => [['9:00 AM','1:00 PM'],['5:00 PM','9:00 PM']],
                'Saturday'  => [['9:00 AM','1:00 PM']],
                'Sunday'    => [],
            ];
            @endphp
            @foreach($days as $day => $slots)
            <div class="day-row">
                <div class="day-name">
                    {{ $day }}
                    @if(strtolower($day) === $today)
                    <span class="today-badge">Today</span>
                    @endif
                </div>
                <div class="day-slots">
                    @if(count($slots) === 0)
                        <span class="slot-pill closed">Closed</span>
                    @else
                        @foreach($slots as $slot)
                        <span class="slot-pill">{{ $slot[0] }} – {{ $slot[1] }}</span>
                        @endforeach
                    @endif
                </div>
            </div>
            @endforeach

            <div style="margin-top:24px;padding-top:20px;border-top:1px solid var(--border-subtle);">
                <p style="font-size:13px;color:var(--text-secondary);margin-bottom:16px;">
                    <i class="fas fa-info-circle" style="color:var(--accent);margin-right:6px;"></i>
                    For emergencies, call directly. Walk-ins accepted but appointment preferred.
                </p>
                <a href="{{ route('appointment') }}" class="btn btn-primary" style="width:100%;justify-content:center;">
                    <i class="fas fa-calendar-check"></i> Book Appointment
                </a>
            </div>
        </div>

        <!-- MAP + LOCATION -->
        <div class="location-card reveal" style="transition-delay:0.1s">
            <!-- Google Maps Embed — replace YOUR_API_KEY and coordinates -->
            <iframe
                class="map-embed"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3772.4!2d72.8347!3d19.0176!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTnCsDAxJzAzLjQiTiA3MsKwNTAnMDUuMiJF!5e0!3m2!1sen!2sin!4v1609459200000!5m2!1sen!2sin"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="Dr. Sharma Clinic Location">
            </iframe>
            <div class="location-details">
                <h3>Find Us Here</h3>
                <div class="location-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <strong>Address</strong>
                        <span>123, Shivaji Nagar, Near City Hospital & SBI Bank, Mumbai – 400001, Maharashtra</span>
                    </div>
                </div>
                <div class="location-item">
                    <i class="fas fa-phone"></i>
                    <div>
                        <strong>Phone</strong>
                        <span>+91 99999 99999</span>
                    </div>
                </div>
                <div class="location-item">
                    <i class="fas fa-train"></i>
                    <div>
                        <strong>Nearest Station</strong>
                        <span>Dadar Railway Station — 10 min walk (Central & Western line)</span>
                    </div>
                </div>
                <div class="location-item">
                    <i class="fas fa-bus"></i>
                    <div>
                        <strong>Bus Stop</strong>
                        <span>Shivaji Nagar Bus Stop — 2 min walk (BEST routes 35, 66, 175)</span>
                    </div>
                </div>
                <div class="location-item">
                    <i class="fas fa-parking"></i>
                    <div>
                        <strong>Parking</strong>
                        <span>Free 2-wheeler parking available. Car parking at City Hospital (5 min walk)</span>
                    </div>
                </div>
                <div class="location-actions">
                    <a href="https://maps.google.com/?q=Shivaji+Nagar+Mumbai" target="_blank" class="btn btn-primary" style="font-size:13px;padding:11px 20px;">
                        <i class="fas fa-directions"></i> Get Directions
                    </a>
                    <a href="https://wa.me/919999999999" target="_blank" class="btn btn-outline" style="font-size:13px;padding:11px 20px;">
                        <i class="fab fa-whatsapp"></i> WhatsApp Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- NEARBY LANDMARKS -->
<section class="section-sm">
    <div class="container">
        <div style="text-align:center;margin-bottom:36px;" class="reveal">
            <div class="section-label" style="justify-content:center;">Landmarks Nearby</div>
            <h2 class="section-title" style="font-size:1.8rem;">Easy to <span>Find</span></h2>
        </div>
        <div class="nearby-grid">
            @php $nearby = [
                ['🏥','City Hospital','100 metres away'],
                ['🏦','SBI Bank','200 metres away'],
                ['🚉','Dadar Station','10 min walk'],
                ['🕌','Shivaji Park','5 min walk'],
                ['🏫','Municipal School','Opposite lane'],
                ['🅿️','Public Parking','City Hospital compound'],
            ]; @endphp
            @foreach($nearby as $n)
            <div class="nearby-card reveal">
                <div class="nb-icon">{{ $n[0] }}</div>
                <strong>{{ $n[1] }}</strong>
                <span>{{ $n[2] }}</span>
            </div>
            @endforeach
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
