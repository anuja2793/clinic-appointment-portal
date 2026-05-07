@extends('layouts.app')

@section('title', 'Dr. R. Sharma — Trusted Family Physician Mumbai')
@section('meta_desc', 'Expert General Physician in Mumbai. 15+ years experience. Book appointment today for diabetes, BP, fever, and general health care.')

@push('styles')
<style>
/* ── HERO ── */
.hero {
    min-height: calc(100vh - 80px);
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
    padding: 60px 5%;
}
.hero-bg {
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 60% 60% at 70% 50%, rgba(78,205,196,0.08) 0%, transparent 60%),
        radial-gradient(ellipse 40% 40% at 20% 80%, rgba(201,168,76,0.06) 0%, transparent 50%);
}
.hero-grid {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    align-items: center;
    position: relative;
    z-index: 1;
    width: 100%;
}
.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--accent-soft);
    border: 1px solid var(--border);
    border-radius: 50px;
    padding: 6px 16px;
    font-size: 12px;
    color: var(--accent);
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 24px;
    animation: fadeInDown 0.8s ease both;
}
.hero-badge::before { content: '●'; font-size: 8px; animation: blink 1.5s infinite; }
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.3} }

.hero h1 {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(2.8rem, 5vw, 4.8rem);
    font-weight: 600;
    line-height: 1.05;
    margin-bottom: 24px;
    animation: fadeInDown 0.8s 0.1s ease both;
}
.hero h1 .accent { color: var(--accent); font-style: italic; display: block; }
.hero h1 .gold { color: var(--gold); }

.hero-desc {
    font-size: 16px;
    color: var(--text-secondary);
    line-height: 1.8;
    max-width: 480px;
    margin-bottom: 36px;
    animation: fadeInDown 0.8s 0.2s ease both;
}

.hero-actions {
    display: flex;
    gap: 14px;
    flex-wrap: wrap;
    animation: fadeInDown 0.8s 0.3s ease both;
}

.hero-trust {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-top: 48px;
    padding-top: 32px;
    border-top: 1px solid var(--border-subtle);
    animation: fadeInDown 0.8s 0.4s ease both;
}
.trust-item { text-align: center; }
.trust-num {
    font-family: 'Cormorant Garamond', serif;
    font-size: 28px;
    font-weight: 600;
    color: var(--accent);
    line-height: 1;
}
.trust-label { font-size: 11px; color: var(--text-muted); margin-top: 4px; text-transform: uppercase; letter-spacing: 1px; }
.trust-divider { width: 1px; height: 40px; background: var(--border-subtle); }

/* ── HERO CARD ── */
.hero-visual {
    position: relative;
    animation: fadeInRight 1s 0.2s ease both;
}
.doctor-card {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: 24px;
    padding: 40px;
    position: relative;
    overflow: hidden;
}
.doctor-card::before {
    content: '';
    position: absolute;
    top: -60px; right: -60px;
    width: 200px; height: 200px;
    background: radial-gradient(circle, var(--accent-glow) 0%, transparent 70%);
    pointer-events: none;
}
.doctor-avatar {
    width: 100px; height: 100px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--accent), var(--gold));
    display: flex; align-items: center; justify-content: center;
    font-size: 40px;
    margin-bottom: 20px;
    box-shadow: 0 0 40px var(--accent-glow);
}
.doctor-card h3 {
    font-family: 'Cormorant Garamond', serif;
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 4px;
}
.doctor-card .qual {
    font-size: 13px;
    color: var(--accent);
    letter-spacing: 0.5px;
    margin-bottom: 20px;
}
.doctor-info-row {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 24px;
}
.info-item {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 13px;
    color: var(--text-secondary);
}
.info-item i { color: var(--accent); width: 16px; text-align: center; }

.status-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(78,205,196,0.1);
    border: 1px solid var(--border);
    border-radius: 50px;
    padding: 8px 16px;
    font-size: 13px;
    color: var(--accent);
    width: fit-content;
}
.status-dot {
    width: 8px; height: 8px;
    border-radius: 50%;
    background: #4ade80;
    animation: blink 1.5s infinite;
    box-shadow: 0 0 8px rgba(74,222,128,0.8);
}

.floating-badge {
    position: absolute;
    background: var(--bg-secondary);
    border: 1px solid var(--border-subtle);
    border-radius: 12px;
    padding: 12px 16px;
    font-size: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.3);
}
.badge-top { top: -16px; right: 20px; }
.badge-bottom { bottom: -16px; left: 20px; }
.badge-icon { font-size: 18px; }
.badge-text { display: flex; flex-direction: column; }
.badge-text strong { font-size: 13px; color: var(--text-primary); line-height: 1; }
.badge-text span { font-size: 11px; color: var(--text-muted); }

/* ── SERVICES PREVIEW ── */
.services-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    max-width: 1200px;
    margin: 0 auto;
}
.service-mini-card {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius);
    padding: 28px;
    transition: all 0.3s ease;
    cursor: default;
    position: relative;
    overflow: hidden;
}
.service-mini-card::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 2px;
    background: linear-gradient(90deg, var(--accent), transparent);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.3s ease;
}
.service-mini-card:hover { border-color: var(--border); background: var(--bg-card-hover); transform: translateY(-4px); }
.service-mini-card:hover::after { transform: scaleX(1); }
.service-icon {
    width: 52px; height: 52px;
    border-radius: 12px;
    background: var(--accent-soft);
    display: flex; align-items: center; justify-content: center;
    font-size: 22px;
    margin-bottom: 18px;
    transition: all 0.3s;
}
.service-mini-card:hover .service-icon { background: var(--accent); }
.service-mini-card h3 { font-size: 16px; font-weight: 500; margin-bottom: 8px; }
.service-mini-card p { font-size: 13px; color: var(--text-secondary); line-height: 1.6; }

/* ── TESTIMONIALS ── */
.testimonials-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    max-width: 1200px;
    margin: 0 auto;
}
.testimonial-card {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius);
    padding: 28px;
    transition: all 0.3s;
}
.testimonial-card:hover { border-color: var(--border); transform: translateY(-3px); }
.stars { color: var(--gold); font-size: 14px; margin-bottom: 14px; letter-spacing: 2px; }
.testimonial-card p { font-size: 14px; color: var(--text-secondary); line-height: 1.8; font-style: italic; margin-bottom: 20px; }
.reviewer { display: flex; align-items: center; gap: 12px; }
.reviewer-avatar {
    width: 38px; height: 38px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--accent), var(--gold));
    display: flex; align-items: center; justify-content: center;
    font-size: 14px; font-weight: 600; color: #0a0c10;
    flex-shrink: 0;
}
.reviewer-info strong { display: block; font-size: 14px; font-weight: 500; }
.reviewer-info span { font-size: 12px; color: var(--text-muted); }

/* ── CTA SECTION ── */
.cta-section {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: 24px;
    padding: 60px;
    text-align: center;
    position: relative;
    overflow: hidden;
    max-width: 1200px;
    margin: 0 auto;
}
.cta-section::before {
    content: '';
    position: absolute;
    top: -100px; left: 50%;
    transform: translateX(-50%);
    width: 500px; height: 300px;
    background: radial-gradient(ellipse, var(--accent-glow) 0%, transparent 70%);
    pointer-events: none;
}
.cta-actions { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; margin-top: 32px; }

/* ── ANIMATIONS ── */
@keyframes fadeInDown {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes fadeInRight {
    from { opacity: 0; transform: translateX(30px); }
    to { opacity: 1; transform: translateX(0); }
}
.reveal {
    opacity: 0;
    transform: translateY(24px);
    transition: opacity 0.7s ease, transform 0.7s ease;
}
.reveal.visible { opacity: 1; transform: translateY(0); }

@media (max-width: 900px) {
    .hero-grid { grid-template-columns: 1fr; gap: 48px; }
    .hero-visual { order: -1; }
    .services-grid { grid-template-columns: 1fr 1fr; }
    .testimonials-grid { grid-template-columns: 1fr; }
}
@media (max-width: 600px) {
    .services-grid { grid-template-columns: 1fr; }
    .hero-trust { gap: 12px; }
    .cta-section { padding: 40px 24px; }
}
</style>
@endpush

@section('content')

<!-- ── HERO ── -->
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-grid">
        <div class="hero-content">
            <div class="hero-badge">Mumbai's Trusted Physician Since 2009</div>
            <h1>
                Your Health,<br>Our
                <span class="accent">Deepest</span>
                <span class="gold">Commitment.</span>
            </h1>
            <p class="hero-desc">
                Expert general medicine and family healthcare with compassion.
                Dr. R. Sharma brings 15+ years of clinical excellence to every consultation.
            </p>
            <div class="hero-actions">
                <a href="{{ route('appointment') }}" class="btn btn-primary">
                    <i class="fas fa-calendar-check"></i> Book Appointment
                </a>
                <a href="https://wa.me/919999999999" class="btn btn-outline" target="_blank">
                    <i class="fab fa-whatsapp"></i> WhatsApp Us
                </a>
            </div>
            <div class="hero-trust">
                <div class="trust-item">
                    <div class="trust-num">15+</div>
                    <div class="trust-label">Years Exp.</div>
                </div>
                <div class="trust-divider"></div>
                <div class="trust-item">
                    <div class="trust-num">8K+</div>
                    <div class="trust-label">Patients</div>
                </div>
                <div class="trust-divider"></div>
                <div class="trust-item">
                    <div class="trust-num">4.9★</div>
                    <div class="trust-label">Rating</div>
                </div>
                <div class="trust-divider"></div>
                <div class="trust-item">
                    <div class="trust-num">6</div>
                    <div class="trust-label">Days/Week</div>
                </div>
            </div>
        </div>

        
            <div class="doctor-card">
                <div class="doctor-avatar">👨‍⚕️</div>
                <h3>Dr. Rajesh Sharma</h3>
                <div class="qual">MBBS, MD (General Medicine) · FCPS</div>
                <div class="doctor-info-row">
                    <div class="info-item"><i class="fas fa-graduation-cap"></i> Grant Medical College, Mumbai</div>
                    <div class="info-item"><i class="fas fa-hospital"></i> KEM Hospital — Sr. Resident</div>
                    <div class="info-item"><i class="fas fa-stethoscope"></i> General Medicine & Family Care</div>
                    <div class="info-item"><i class="fas fa-map-marker-alt"></i> Shivaji Nagar, Mumbai</div>
                </div>
                <div class="status-pill">
                    <span class="status-dot"></span>
                    Accepting new patients today
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- ── SERVICES PREVIEW ── -->
<section class="section">
    <div class="container">
        <div style="text-align:center; margin-bottom: 56px;" class="reveal">
            <div class="section-label" style="justify-content:center;">What We Treat</div>
            <h2 class="section-title">Comprehensive <span>Care</span> for Every Concern</h2>
            <p class="section-subtitle" style="margin: 0 auto;">From routine check-ups to chronic disease management — we cover it all with precision and care.</p>
        </div>
        <div class="services-grid">
            @php
            $services = [
                ['icon'=>'🩺','name'=>'General Medicine','desc'=>'Fever, cold, infections, body pain — same-day consultations available.'],
                ['icon'=>'🩸','name'=>'Diabetes Management','desc'=>'Blood sugar monitoring, medication, diet planning & lifestyle guidance.'],
                ['icon'=>'❤️','name'=>'Blood Pressure Care','desc'=>'Hypertension diagnosis, treatment and long-term monitoring plans.'],
                ['icon'=>'🫁','name'=>'Respiratory Issues','desc'=>'Asthma, COPD, bronchitis, allergies and breathing difficulty treatment.'],
                ['icon'=>'🔬','name'=>'Preventive Checkups','desc'=>'Annual health packages, blood work, ECG and early disease screening.'],
                ['icon'=>'💊','name'=>'Chronic Disease Care','desc'=>'Thyroid, cholesterol, kidney function — ongoing management & support.'],
            ];
            @endphp
            @foreach($services as $i => $s)
            <div class="service-mini-card reveal" style="transition-delay: {{ $i * 0.08 }}s">
                <div class="service-icon">{{ $s['icon'] }}</div>
                <h3>{{ $s['name'] }}</h3>
                <p>{{ $s['desc'] }}</p>
            </div>
            @endforeach
        </div>
        <div style="text-align:center; margin-top: 40px;" class="reveal">
            <a href="{{ route('services') }}" class="btn btn-outline">View All Services <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</section>

<!-- ── TESTIMONIALS ── -->
<section class="section" style="background: var(--bg-secondary);">
    <div class="container">
        <div style="text-align:center; margin-bottom: 56px;" class="reveal">
            <div class="section-label" style="justify-content:center;">Patient Stories</div>
            <h2 class="section-title">Trusted by <span>Thousands</span> of Families</h2>
        </div>
        <div class="testimonials-grid">
            @php
            $testimonials = [
                ['initial'=>'P','name'=>'Priya Desai','loc'=>'Dadar, Mumbai','review'=>'"Dr. Sharma is incredibly patient and thorough. He took 30 minutes to explain my diabetes management plan. I have never felt more confident about my health."'],
                ['initial'=>'R','name'=>'Ramesh Patil','loc'=>'Shivaji Nagar','review'=>'"We have been visiting for 5 years as a family. The doctor remembers every detail about each of us. Truly exceptional, old-school personal care."'],
                ['initial'=>'S','name'=>'Sunita Kulkarni','loc'=>'Parel, Mumbai','review'=>'"I was worried about my BP readings. Doctor put me completely at ease, explained everything clearly and suggested the right lifestyle changes. Highly recommended!"'],
            ];
            @endphp
            @foreach($testimonials as $i => $t)
            <div class="testimonial-card reveal" style="transition-delay: {{ $i * 0.1 }}s">
                <div class="stars">★★★★★</div>
                <p>{{ $t['review'] }}</p>
                <div class="reviewer">
                    <div class="reviewer-avatar">{{ $t['initial'] }}</div>
                    <div class="reviewer-info">
                        <strong>{{ $t['name'] }}</strong>
                        <span>{{ $t['loc'] }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ── CTA SECTION ── -->
<section class="section">
    <div class="cta-section reveal">
        <div class="section-label" style="justify-content:center;">Ready to Begin?</div>
        <h2 class="section-title" style="margin-bottom: 12px;">Book Your Consultation <span>Today</span></h2>
        <p class="section-subtitle" style="margin: 0 auto; text-align:center;">
            Don't wait — your health deserves immediate attention. Book online or walk in during clinic hours.
        </p>
        <div class="cta-actions">
            <a href="{{ route('appointment') }}" class="btn btn-primary"><i class="fas fa-calendar-check"></i> Book Appointment</a>
            <a href="{{ route('timings') }}" class="btn btn-outline"><i class="fas fa-clock"></i> Clinic Timings</a>
            <a href="tel:+919999999999" class="btn btn-gold"><i class="fas fa-phone"></i> Call Now</a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
// Re-init observer for this page
const obs = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); } });
}, { threshold: 0.1 });
document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
</script>
@endpush
