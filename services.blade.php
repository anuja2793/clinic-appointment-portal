@extends('layouts.app')
@section('title', 'Services — Dr. R. Sharma Clinic')

@push('styles')
<style>
.services-full-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; max-width: 1200px; margin: 0 auto; }
.service-card {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius);
    padding: 36px 30px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}
.service-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--accent), var(--gold));
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.4s ease;
}
.service-card:hover { border-color: var(--border); background: var(--bg-card-hover); transform: translateY(-5px); box-shadow: 0 20px 50px rgba(0,0,0,0.3), 0 0 30px var(--accent-glow); }
.service-card:hover::before { transform: scaleX(1); }
.svc-icon {
    width: 60px; height: 60px;
    border-radius: 14px;
    background: var(--accent-soft);
    display: flex; align-items: center; justify-content: center;
    font-size: 26px;
    margin-bottom: 22px;
    transition: all 0.3s;
}
.service-card:hover .svc-icon { background: linear-gradient(135deg, var(--accent), #38b2ac); transform: scale(1.05); }
.service-card h3 { font-size: 18px; font-weight: 500; margin-bottom: 10px; }
.service-card p { font-size: 13px; color: var(--text-secondary); line-height: 1.8; margin-bottom: 18px; }
.svc-tags { display: flex; flex-wrap: wrap; gap: 6px; }
.svc-tag { background: var(--bg-primary); border: 1px solid var(--border-subtle); border-radius: 4px; padding: 3px 10px; font-size: 11px; color: var(--text-muted); }

.process-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; max-width: 1200px; margin: 0 auto; }
.process-step {
    text-align: center;
    position: relative;
}
.process-step::after {
    content: '→';
    position: absolute;
    top: 22px; right: -20px;
    color: var(--text-muted);
    font-size: 18px;
}
.process-step:last-child::after { display: none; }
.step-num {
    width: 48px; height: 48px;
    border-radius: 50%;
    background: var(--accent-soft);
    border: 1px solid var(--border);
    display: flex; align-items: center; justify-content: center;
    font-family: 'Cormorant Garamond', serif;
    font-size: 20px;
    font-weight: 600;
    color: var(--accent);
    margin: 0 auto 16px;
}
.process-step h4 { font-size: 15px; font-weight: 500; margin-bottom: 6px; }
.process-step p { font-size: 13px; color: var(--text-secondary); }

.reveal { opacity:0; transform:translateY(20px); transition:all 0.6s ease; }
.reveal.visible { opacity:1; transform:translateY(0); }

@media (max-width: 1000px) { .services-full-grid { grid-template-columns: 1fr 1fr; } .process-grid { grid-template-columns: 1fr 1fr; } .process-step::after { display:none; } }
@media (max-width: 600px) { .services-full-grid { grid-template-columns: 1fr; } .process-grid { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<div class="page-hero">
    <div class="breadcrumb"><a href="{{ route('home') }}">Home</a><i class="fas fa-chevron-right"></i><span>Services</span></div>
    <h1 class="page-title">Our <span>Services</span></h1>
    <p style="color:var(--text-secondary);font-size:15px;margin-top:12px;">Comprehensive care for every health concern</p>
</div>

<section class="section" style="padding-top:40px;">
    <div class="container">
        @php $services = [
            ['icon'=>'🩺','name'=>'General Medicine','desc'=>'From everyday ailments to complex presentations — same day appointments for fever, infections, fatigue, body pain and more.','tags'=>['Fever','Cold & Cough','Body Pain','Infections','Same-day OPD']],
            ['icon'=>'🩸','name'=>'Diabetes Management','desc'=>'Comprehensive diabetes care including HbA1c monitoring, medication review, insulin management, diet counselling and complication prevention.','tags'=>['Type 1 & 2','HbA1c','Diet Plan','Insulin','Foot Care']],
            ['icon'=>'❤️','name'=>'Hypertension (BP) Care','desc'=>'Accurate BP monitoring, personalised treatment plans, medication management and lifestyle guidance for long-term heart health.','tags'=>['Diagnosis','Medication','ECG','Lifestyle','Monitoring']],
            ['icon'=>'🫁','name'=>'Respiratory Disorders','desc'=>'Expert management of asthma, COPD, bronchitis, chronic cough, seasonal allergies and breathing difficulties.','tags'=>['Asthma','COPD','Bronchitis','Allergy','Nebulisation']],
            ['icon'=>'🔬','name'=>'Preventive Health Checkups','desc'=>'Annual wellness packages including blood work, urine analysis, ECG, lipid profile, thyroid and blood sugar screening.','tags'=>['Annual Package','Blood Work','ECG','Lipid','Thyroid']],
            ['icon'=>'🦠','name'=>'Fever & Infections','desc'=>'Rapid diagnosis and treatment of viral/bacterial infections, dengue, typhoid, malaria and seasonal fevers.','tags'=>['Viral Fever','Dengue','Typhoid','UTI','Skin Infections']],
            ['icon'=>'🦋','name'=>'Thyroid Disorders','desc'=>'Hypothyroidism and hyperthyroidism management with TSH monitoring, medication and lifestyle advice.','tags'=>['Hypothyroid','Hyperthyroid','TSH','Medication','Diet']],
            ['icon'=>'🧓','name'=>'Geriatric Care','desc'=>'Specialised care for elderly patients including multiple disease management, fall prevention and palliative support.','tags'=>['Elderly Care','Multi-disease','Home Visit','Palliative']],
            ['icon'=>'💊','name'=>'Medication Management','desc'=>'Review of existing prescriptions, drug interaction checks, generic alternatives and optimal dosage guidance.','tags'=>['Review','Interactions','Generic','Dosage','Cost']],
        ]; @endphp

        <div class="services-full-grid">
            @foreach($services as $i => $s)
            <div class="service-card reveal" style="transition-delay:{{($i%3)*0.1}}s">
                <div class="svc-icon">{{ $s['icon'] }}</div>
                <h3>{{ $s['name'] }}</h3>
                <p>{{ $s['desc'] }}</p>
                <div class="svc-tags">
                    @foreach($s['tags'] as $t)
                    <span class="svc-tag">{{ $t }}</span>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section class="section" style="background:var(--bg-secondary);">
    <div class="container">
        <div style="text-align:center;margin-bottom:56px;" class="reveal">
            <div class="section-label" style="justify-content:center;">Process</div>
            <h2 class="section-title">How to <span>Visit Us</span></h2>
        </div>
        <div class="process-grid">
            @php $steps = [
                ['n'=>'01','title'=>'Book Appointment','desc'=>'Online form, WhatsApp or phone call. Takes 2 minutes.'],
                ['n'=>'02','title'=>'Visit the Clinic','desc'=>'Arrive 5 mins early. Bring previous records if any.'],
                ['n'=>'03','title'=>'Consultation','desc'=>'Thorough 1-on-1 with Dr. Sharma. No rush, no hurry.'],
                ['n'=>'04','title'=>'Prescription & Follow-up','desc'=>'Clear prescription, diet tips and follow-up schedule.'],
            ]; @endphp
            @foreach($steps as $s)
            <div class="process-step reveal">
                <div class="step-num">{{ $s['n'] }}</div>
                <h4>{{ $s['title'] }}</h4>
                <p>{{ $s['desc'] }}</p>
            </div>
            @endforeach
        </div>
        <div style="text-align:center;margin-top:48px;" class="reveal">
            <a href="{{ route('appointment') }}" class="btn btn-primary"><i class="fas fa-calendar-check"></i> Book Your Appointment</a>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
const obs = new IntersectionObserver(e => e.forEach(x=>{if(x.isIntersecting){x.target.classList.add('visible');obs.unobserve(x.target);}}),{threshold:0.08});
document.querySelectorAll('.reveal').forEach(el=>obs.observe(el));
</script>
@endpush
