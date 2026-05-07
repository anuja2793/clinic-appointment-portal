<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_desc', 'Dr. R. Sharma — General Physician in Mumbai. Book appointment for diabetes, BP, fever and general healthcare.')">
    <title>@yield('title', 'Dr. Sharma Clinic') — Premium Healthcare</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg-primary:    #F8FAF9;
            --bg-secondary:  #EEF4F0;
            --bg-card:       #FFFFFF;
            --bg-card-hover: #F0F7F2;
            --accent:        #2D6A4F;
            --accent-glow:   rgba(45, 106, 79, 0.2);
            --accent-soft:   rgba(45, 106, 79, 0.08);
            --gold:          #52B788;
            --gold-glow:     rgba(82, 183, 136, 0.25);
            --text-primary:  #1B4332;
            --text-secondary:#40916C;
            --text-muted:    #74C69D;
            --border:        rgba(45, 106, 79, 0.25);
            --border-subtle: rgba(45, 106, 79, 0.1);
            --nav-height:    80px;
            --radius:        16px;
            --radius-sm:     8px;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.7;
            overflow-x: hidden;
        }

        /* ── SCROLLBAR ── */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: var(--bg-secondary); }
        ::-webkit-scrollbar-thumb { background: var(--accent); border-radius: 10px; }

        /* ── NAVBAR ── */
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            height: var(--nav-height);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 5%;
            background: rgba(248, 250, 249, 0.9);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-subtle);
            transition: all 0.3s ease;
        }
        nav.scrolled {
            background: rgba(248, 250, 249, 0.98);
            box-shadow: 0 4px 20px rgba(45, 106, 79, 0.1);
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        .nav-logo-icon {
            width: 42px; height: 42px;
            background: linear-gradient(135deg, var(--accent), var(--gold));
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
            color: #ffffff;
            box-shadow: 0 0 20px var(--accent-glow);
        }
        .nav-logo-text { display: flex; flex-direction: column; }
        .nav-logo-text .name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 18px;
            font-weight: 600;
            color: var(--text-primary);
            line-height: 1.1;
        }
        .nav-logo-text .tagline {
            font-size: 10px;
            color: var(--accent);
            letter-spacing: 2px;
            text-transform: uppercase;
            font-weight: 500;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2px;
            list-style: none;
        }
        .nav-links a {
            display: block;
            padding: 8px 16px;
            text-decoration: none;
            color: var(--text-secondary);
            font-size: 14px;
            font-weight: 400;
            border-radius: var(--radius-sm);
            transition: all 0.25s ease;
            letter-spacing: 0.3px;
        }
        .nav-links a:hover,
        .nav-links a.active {
            color: var(--accent);
            background: var(--accent-soft);
        }

        .nav-cta {
            background: linear-gradient(135deg, var(--accent), #52B788) !important;
            color: #ffffff !important;
            font-weight: 500 !important;
            padding: 9px 22px !important;
            box-shadow: 0 0 20px var(--accent-glow);
        }
        .nav-cta:hover {
            background: var(--accent-soft) !important;
            color: var(--accent) !important;
            box-shadow: none;
        }

        /* ── HAMBURGER ── */
        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 5px;
            background: none;
            border: none;
        }
        .hamburger span {
            display: block;
            width: 24px; height: 2px;
            background: var(--text-primary);
            border-radius: 2px;
            transition: all 0.3s ease;
        }
        .hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
        .hamburger.open span:nth-child(2) { opacity: 0; }
        .hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

        /* ── MOBILE MENU ── */
        .mobile-menu {
            display: none;
            position: fixed;
            top: var(--nav-height);
            left: 0; right: 0;
            background: rgba(248, 250, 249, 0.98);
            backdrop-filter: blur(20px);
            padding: 24px 5%;
            border-bottom: 1px solid var(--border-subtle);
            z-index: 999;
            flex-direction: column;
            gap: 4px;
        }
        .mobile-menu.open { display: flex; }
        .mobile-menu a {
            display: block;
            padding: 12px 16px;
            text-decoration: none;
            color: var(--text-secondary);
            font-size: 15px;
            border-radius: var(--radius-sm);
            transition: all 0.2s;
        }
        .mobile-menu a:hover { color: var(--accent); background: var(--accent-soft); }
        .mobile-menu .mob-cta {
            margin-top: 12px;
            background: linear-gradient(135deg, var(--accent), #52B788);
            color: #ffffff !important;
            font-weight: 500;
            text-align: center;
            border-radius: var(--radius-sm);
        }

        /* ── MAIN CONTENT ── */
        main { padding-top: var(--nav-height); position: relative; z-index: 1; }

        /* ── SECTION HELPERS ── */
        .section { padding: 100px 5%; }
        .section-sm { padding: 60px 5%; }
        .container { max-width: 1200px; margin: 0 auto; }
        .section-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--accent);
            font-weight: 500;
            margin-bottom: 16px;
        }
        .section-label::before {
            content: '';
            display: block;
            width: 24px; height: 1px;
            background: var(--accent);
        }
        .section-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2rem, 4vw, 3.2rem);
            font-weight: 600;
            line-height: 1.15;
            color: var(--text-primary);
            margin-bottom: 20px;
        }
        .section-title span { color: var(--accent); font-style: italic; }
        .section-subtitle {
            font-size: 15px;
            color: var(--text-secondary);
            max-width: 520px;
            line-height: 1.8;
        }

        /* ── BUTTONS ── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 32px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            letter-spacing: 0.3px;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--accent), #52B788);
            color: #ffffff;
            box-shadow: 0 4px 20px var(--accent-glow);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px var(--accent-glow);
        }
        .btn-outline {
            background: transparent;
            color: var(--text-primary);
            border: 1px solid var(--border);
        }
        .btn-outline:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: var(--accent-soft);
        }
        .btn-gold {
            background: linear-gradient(135deg, var(--gold), #74C69D);
            color: #1B4332;
            box-shadow: 0 4px 20px var(--gold-glow);
        }
        .btn-gold:hover { transform: translateY(-2px); box-shadow: 0 8px 30px var(--gold-glow); }

        /* ── CARDS ── */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border-subtle);
            border-radius: var(--radius);
            padding: 32px;
            transition: all 0.3s ease;
        }
        .card:hover {
            border-color: var(--border);
            background: var(--bg-card-hover);
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(45, 106, 79, 0.12);
        }

        /* ── FOOTER ── */
        footer {
            background: var(--bg-secondary);
            border-top: 1px solid var(--border-subtle);
            padding: 60px 5% 30px;
            position: relative;
            z-index: 1;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 48px;
            max-width: 1200px;
            margin: 0 auto 48px;
        }
        .footer-brand .desc {
            font-size: 14px;
            color: var(--text-secondary);
            line-height: 1.8;
            margin: 16px 0 24px;
        }
        .footer-socials { display: flex; gap: 10px; }
        .footer-socials a {
            width: 38px; height: 38px;
            border-radius: 8px;
            background: var(--bg-card);
            border: 1px solid var(--border-subtle);
            display: flex; align-items: center; justify-content: center;
            color: var(--text-secondary);
            font-size: 15px;
            text-decoration: none;
            transition: all 0.25s;
        }
        .footer-socials a:hover { border-color: var(--accent); color: var(--accent); background: var(--accent-soft); }
        .footer-col h4 {
            font-size: 12px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 20px;
            font-weight: 500;
        }
        .footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 10px; }
        .footer-col ul a {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.2s;
        }
        .footer-col ul a:hover { color: var(--text-primary); }
        .footer-contact-item {
            display: flex; align-items: flex-start; gap: 12px;
            margin-bottom: 14px;
        }
        .footer-contact-item i {
            color: var(--accent);
            font-size: 14px;
            margin-top: 3px;
            flex-shrink: 0;
        }
        .footer-contact-item span { font-size: 14px; color: var(--text-secondary); line-height: 1.6; }
        .footer-bottom {
            border-top: 1px solid var(--border-subtle);
            padding-top: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
        }
        .footer-bottom p { font-size: 13px; color: var(--text-muted); }
        .footer-bottom span { color: var(--accent); }

        /* ── WHATSAPP FLOAT ── */
        .whatsapp-float {
            position: fixed;
            bottom: 28px;
            right: 28px;
            width: 56px; height: 56px;
            background: #25d366;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: white;
            font-size: 24px;
            text-decoration: none;
            box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
            z-index: 999;
            transition: all 0.3s ease;
            animation: whatsapp-pulse 2.5s infinite;
        }
        .whatsapp-float:hover { transform: scale(1.1); box-shadow: 0 8px 30px rgba(37, 211, 102, 0.6); }
        @keyframes whatsapp-pulse {
            0%, 100% { box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4); }
            50% { box-shadow: 0 4px 40px rgba(37, 211, 102, 0.7), 0 0 0 8px rgba(37, 211, 102, 0.1); }
        }

        /* ── FORM STYLES ── */
        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block;
            font-size: 12px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--text-secondary);
            margin-bottom: 8px;
            font-weight: 500;
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 13px 18px;
            background: var(--bg-primary);
            border: 1px solid var(--border-subtle);
            border-radius: var(--radius-sm);
            color: var(--text-primary);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            transition: all 0.25s;
            outline: none;
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-soft);
        }
        .form-group select option { background: #ffffff; color: #1B4332; }
        .form-group textarea { resize: vertical; min-height: 120px; }

        /* ── PAGE HERO ── */
        .page-hero {
            padding: 80px 5% 60px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .page-hero::before {
            content: '';
            position: absolute;
            top: -100px; left: 50%;
            transform: translateX(-50%);
            width: 600px; height: 400px;
            background: radial-gradient(ellipse, var(--accent-glow) 0%, transparent 70%);
            pointer-events: none;
        }
        .page-hero .page-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            font-weight: 600;
            line-height: 1.1;
        }
        .page-hero .page-title span { color: var(--accent); font-style: italic; }
        .breadcrumb {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 16px;
            font-size: 13px;
            color: var(--text-muted);
        }
        .breadcrumb a { color: var(--text-secondary); text-decoration: none; }
        .breadcrumb a:hover { color: var(--accent); }
        .breadcrumb i { font-size: 10px; }

        /* ── FLASH MESSAGES ── */
        .flash-success, .flash-error {
            padding: 14px 20px;
            border-radius: var(--radius-sm);
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .flash-success { background: rgba(45,106,79,0.08); border: 1px solid var(--accent); color: var(--accent); }
        .flash-error { background: rgba(239,68,68,0.08); border: 1px solid #dc2626; color: #dc2626; }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            .nav-links { display: none; }
            .hamburger { display: flex; }
            .footer-grid { grid-template-columns: 1fr 1fr; gap: 32px; }
        }
        @media (max-width: 600px) {
            .section { padding: 70px 5%; }
            .footer-grid { grid-template-columns: 1fr; }
            .footer-bottom { flex-direction: column; gap: 8px; text-align: center; }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- NAVBAR -->
    <nav id="navbar">
        <a href="{{ route('home') }}" class="nav-logo">
            <div class="nav-logo-icon">⚕</div>
            <div class="nav-logo-text">
                <span class="name">Dr. R. Sharma</span>
                <span class="tagline">General Physician</span>
            </div>
        </a>
        <ul class="nav-links">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
            <li><a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">Services</a></li>
            <li><a href="{{ route('timings') }}" class="{{ request()->routeIs('timings') ? 'active' : '' }}">Timings</a></li>
            <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
            <li><a href="{{ route('appointment') }}" class="nav-cta {{ request()->routeIs('appointment') ? 'active' : '' }}">Book Appointment</a></li>
        </ul>
        <button class="hamburger" id="hamburger" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>
    </nav>

    <!-- MOBILE MENU -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('about') }}">About</a>
        <a href="{{ route('services') }}">Services</a>
        <a href="{{ route('timings') }}">Timings & Location</a>
        <a href="{{ route('contact') }}">Contact</a>
        <a href="{{ route('appointment') }}" class="mob-cta">📅 Book Appointment</a>
    </div>

    <!-- MAIN CONTENT -->
    <main>
        @if(session('success'))
            <div style="padding: 0 5%; padding-top: 20px; max-width: 1200px; margin: 0 auto;">
                <div class="flash-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
            </div>
        @endif
        @if(session('error'))
            <div style="padding: 0 5%; padding-top: 20px; max-width: 1200px; margin: 0 auto;">
                <div class="flash-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer>
        <div class="footer-grid">
            <div class="footer-brand">
                <a href="{{ route('home') }}" class="nav-logo" style="display:inline-flex; margin-bottom: 4px;">
                    <div class="nav-logo-icon">⚕</div>
                    <div class="nav-logo-text">
                        <span class="name">Dr. R. Sharma</span>
                        <span class="tagline">General Physician</span>
                    </div>
                </a>
                <p class="desc">Compassionate, evidence-based healthcare for every stage of life. Your health is our highest priority.</p>
                <div class="footer-socials">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://wa.me/919999999999" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                    <a href="#" aria-label="Google"><i class="fab fa-google"></i></a>
                </div>
            </div>
            <div class="footer-col">
                <h4>Navigation</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Doctor</a></li>
                    <li><a href="{{ route('services') }}">Services</a></li>
                    <li><a href="{{ route('timings') }}">Timings</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Services</h4>
                <ul>
                    <li><a href="{{ route('services') }}">General Medicine</a></li>
                    <li><a href="{{ route('services') }}">Diabetes Care</a></li>
                    <li><a href="{{ route('services') }}">Blood Pressure</a></li>
                    <li><a href="{{ route('services') }}">Fever & Infections</a></li>
                    <li><a href="{{ route('services') }}">Health Checkup</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Contact</h4>
                <div class="footer-contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>123, Shivaji Nagar, Near City Hospital, Mumbai - 400001</span>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-phone"></i>
                    <span>+91 99999 99999</span>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-clock"></i>
                    <span>Mon–Sat: 9am–1pm & 5pm–9pm</span>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-envelope"></i>
                    <span>dr.sharma@clinic.com</span>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© {{ date('Y') }} Dr. R. Sharma Clinic. All rights reserved. Made with <span>♥</span> in Mumbai.</p>
            <p>Designed for <span>premium healthcare</span></p>
        </div>
    </footer>

    <!-- WHATSAPP FLOAT BUTTON -->
    <a href="https://wa.me/919999999999?text=Hello%20Doctor,%20I%20would%20like%20to%20book%20an%20appointment."
       class="whatsapp-float" target="_blank" rel="noopener" aria-label="Chat on WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script>
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 30);
        });

        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobileMenu');
        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('open');
            mobileMenu.classList.toggle('open');
        });

        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                hamburger.classList.remove('open');
                mobileMenu.classList.remove('open');
            });
        });

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>

    @stack('scripts')
</body>
</html>