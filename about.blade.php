@extends('layouts.app')
@section('title', 'About Dr. R. Sharma — General Physician Mumbai')

@push('styles')
<style>
.about-grid { display: grid; grid-template-columns: 1fr 1.4fr; gap: 80px; align-items: start; max-width: 1200px; margin: 0 auto; }
.doctor-profile-card {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: 24px;
    padding: 40px;
    position: sticky;
    top: 100px;
    text-align: center;
}
.profile-avatar {
    width: 120px; height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--accent), var(--gold));
    display: flex; align-items: center; justify-content: center;
    font-size: 50px;
    margin: 0 auto 24px;
    box-shadow: 0 0 50px var(--accent-glow);
}
.profile-name { font-family: 'Cormorant Garamond', serif; font-size: 26px; font-weight: 600; margin-bottom: 6px; }
.profile-qual { font-size: 13px; color: var(--accent); letter-spacing: 0.5px; margin-bottom: 20px; }
.profile-divider { height: 1px; background: var(--border-subtle); margin: 20px 0; }
.profile-stat { display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; font-size: 14px; }
.profile-stat span { color: var(--text-secondary); }
.profile-stat strong { color: var(--text-primary); }

.credentials-list { display: flex; flex-direction: column; gap: 16px; margin-bottom: 40px; }
.cred-item {
    display: flex; align-items: flex-start; gap: 16px;
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius);
    padding: 20px;
    transition: all 0.3s;
}
.cred-item:hover { border-color: var(--border); }
.cred-icon {
    width: 44px; height: 44px;
    border-radius: 10px;
    background: var(--accent-soft);
    display: flex; align-items: center; justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
}
.cred-text strong { display: block; font-size: 15px; margin-bottom: 3px; }
.cred-text span { font-size: 13px; color: var(--text-secondary); }

.mission-box {
    background: linear-gradient(135deg, var(--accent-soft), rgba(201,168,76,0.08));
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 32px;
    margin-bottom: 40px;
}
.mission-box h3 { font-family: 'Cormorant Garamond', serif; font-size: 22px; font-weight: 600; margin-bottom: 12px; }
.mission-box p { font-size: 15px; color: var(--text-secondary); line-height: 1.8; font-style: italic; }

.specialties-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
.specialty-tag {
    display: flex; align-items: center; gap: 8px;
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 13px;
    color: var(--text-secondary);
}
.specialty-tag i { color: var(--accent); font-size: 11px; }

.reveal { opacity: 0; transform: translateY(20px); transition: all 0.6s ease; }
.reveal.visible { opacity: 1; transform: translateY(0); }

@media (max-width: 900px) {
    .about-grid { grid-template-columns: 1fr; }
    .doctor-profile-card { position: static; }
    .specialties-grid { grid-template-columns: 1fr 1fr; }
}
</style>
@endpush

@section('content')
<div class="page-hero">
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <i class="fas fa-chevron-right"></i>
        <span>About</span>
    </div>
    <h1 class="page-title">Meet the <span>Doctor</span></h1>
    <p style="color: var(--text-secondary); font-size: 15px; margin-top: 12px;">15+ years of dedicated care for Mumbai families</p>
</div>

<section class="section" style="padding-top: 40px;">
    <div class="about-grid">

        <!-- Sticky Profile Card -->
        <div class="doctor-profile-card reveal">
            <div class="profile-avatar">👨‍⚕️</div>
            <div class="profile-name">Dr. Rajesh Sharma</div>
            <div class="profile-qual">MBBS, MD · General Medicine · FCPS</div>
            <a href="{{ route('appointment') }}" class="btn btn-primary" style="width:100%; justify-content:center; margin-bottom: 16px;">
                <i class="fas fa-calendar-check"></i> Book Appointment
            </a>
            <a href="https://wa.me/919999999999" class="btn btn-outline" style="width:100%; justify-content:center;">
                <i class="fab fa-whatsapp"></i> WhatsApp
            </a>
            <div class="profile-divider"></div>
            <div class="profile-stat"><span>Experience</span><strong>15+ Years</strong></div>
            <div class="profile-stat"><span>Patients Treated</span><strong>8,000+</strong></div>
            <div class="profile-stat"><span>Languages</span><strong>Hindi, Marathi, English</strong></div>
            <div class="profile-stat"><span>Registration</span><strong>MMC/12345/2009</strong></div>
            <div class="profile-stat"><span>Rating</span><strong>4.9 / 5 ★</strong></div>
        </div>

        <!-- Right Side Content -->
        <div>
            <div class="reveal">
                <div class="section-label">About the Physician</div>
                <h2 class="section-title">Healing with <span>Science</span> & Heart</h2>
                <p style="font-size:15px; color:var(--text-secondary); line-height:1.9; margin-bottom: 20px;">
                    Dr. Rajesh Sharma is a distinguished General Physician based in Shivaji Nagar, Mumbai, with over 15 years
                    of clinical experience serving the community. A proud alumnus of Grant Medical College (one of India's premier
                    medical institutions), he completed his residency at KEM Hospital where he honed his expertise in acute medicine,
                    chronic disease management, and preventive care.
                </p>
                <p style="font-size:15px; color:var(--text-secondary); line-height:1.9; margin-bottom: 32px;">
                    His practice is built on a foundation of evidence-based medicine, honest communication, and genuine patient
                    empathy. He believes that a good physician treats the person, not just the disease — and this philosophy
                    shines through in every consultation.
                </p>
            </div>

            <!-- Mission -->
            <div class="mission-box reveal">
                <h3>Our Mission</h3>
                <p>"To provide accessible, compassionate, and evidence-based healthcare to every individual — regardless of age or background — and to empower patients with the knowledge to lead healthier lives."</p>
            </div>

            <!-- Credentials -->
            <h3 style="font-family:'Cormorant Garamond',serif; font-size:22px; margin-bottom:20px;" class="reveal">
                Education & Training
            </h3>
            <div class="credentials-list">
                @php $creds = [
                    ['icon'=>'🎓','title'=>'MBBS — Grant Medical College, Mumbai','sub'=>'Mumbai University · 2004–2009 · First Class with Distinction'],
                    ['icon'=>'🏥','title'=>'MD General Medicine — KEM Hospital','sub'=>'Senior Residency · 2010–2013 · Gold Medalist'],
                    ['icon'=>'🏆','title'=>'FCPS — Fellowship in Clinical Practice','sub'=>'Maharashtra Medical Council · 2014'],
                    ['icon'=>'📜','title'=>'Certified Diabetes Educator (CDE)','sub'=>'Diabetes India · 2016 · Renewed 2023'],
                ]; @endphp
                @foreach($creds as $i => $c)
                <div class="cred-item reveal" style="transition-delay:{{$i*0.1}}s">
                    <div class="cred-icon">{{ $c['icon'] }}</div>
                    <div class="cred-text">
                        <strong>{{ $c['title'] }}</strong>
                        <span>{{ $c['sub'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Specialties -->
            <h3 style="font-family:'Cormorant Garamond',serif; font-size:22px; margin-bottom:20px;" class="reveal">
                Areas of Specialisation
            </h3>
            <div class="specialties-grid reveal">
                @php $specs = ['General Medicine','Diabetes & Endocrinology','Hypertension','Respiratory Disorders','Fever & Infections','Thyroid Disorders','Preventive Healthcare','Geriatric Care']; @endphp
                @foreach($specs as $s)
                <div class="specialty-tag"><i class="fas fa-check-circle"></i> {{ $s }}</div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
const obs = new IntersectionObserver(e => e.forEach(x => { if(x.isIntersecting){x.target.classList.add('visible');obs.unobserve(x.target);} }), {threshold:0.1});
document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
</script>
@endpush
