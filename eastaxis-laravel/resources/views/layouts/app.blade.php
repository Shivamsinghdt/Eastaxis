<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'EastAxis Research and Consultancy')</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:opsz,wght@8..60,400;8..60,500;8..60,600;8..60,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

<header>
  <div class="nav-bar">
    <a href="{{ route('home') }}" class="logo"><span class="logo-mark">EA</span>EastAxis</a>
    <nav class="primary" id="primaryNav">
      <a href="{{ route('home') }}#research">Research</a>
      <a href="{{ route('home') }}#insights">Insights</a>
      <a href="{{ route('home') }}#who-we-are">Who We Are</a>
      <a href="{{ route('home') }}#experts">Experts</a>
      <a href="{{ route('home') }}#programs">Programs</a>
      <a href="{{ route('home') }}#contact" class="nav-cta nav-cta-mobile">Get in Touch</a>
    </nav>
    <a href="{{ route('home') }}#contact" class="nav-cta nav-cta-desktop">Get in Touch</a>
    <button class="mobile-toggle" id="mobileToggle" aria-label="Toggle menu" aria-expanded="false" aria-controls="primaryNav">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </button>
  </div>
  <div class="nav-overlay" id="navOverlay"></div>
</header>

@yield('content')

<footer id="contact">
  <div class="wrap">
    <div class="footer-top reveal">
      <div class="footer-brand">
        <a href="{{ route('home') }}" class="logo"><span class="logo-mark">EA</span>EastAxis</a>
        <p>EastAxis Research and Consultancy delivers independent analysis on trade, governance, technology, and security to help institutions navigate a changing region.</p>
        <address>
          14th Floor, Axis Tower, Cyber City<br>
          Gurugram, Haryana, 122002, India<br>
          Phone: +91 124 456 7890
        </address>
      </div>
      <div class="footer-col">
        <h5>Explore</h5>
        <a href="{{ route('articles.index') }}">Research</a>
        <a href="{{ route('home') }}#insights">Insights</a>
        <a href="{{ route('home') }}#who-we-are">Who We Are</a>
        <a href="{{ route('home') }}#experts">Experts</a>
      </div>
      <div class="footer-col">
        <h5>Company</h5>
        <a href="{{ route('home') }}#programs">Programs</a>
        <a href="{{ route('home') }}#insights">Events</a>
        <a href="#">Careers</a>
        <a href="{{ route('home') }}#contact">Contact</a>
      </div>
      <div class="footer-col">
        <h5>Legal</h5>
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Use</a>
      </div>
    </div>
    <p style="margin-top:32px;opacity:.6;font-size:13px;">&copy; {{ date('Y') }} EastAxis Research and Consultancy. All rights reserved.</p>
  </div>
</footer>

<script>
  // ===== Mobile nav toggle =====
  (function(){
    const toggle = document.getElementById('mobileToggle');
    const nav = document.getElementById('primaryNav');
    const overlay = document.getElementById('navOverlay');
    if(!toggle) return;
    function close(){
      toggle.setAttribute('aria-expanded','false');
      nav.classList.remove('open');
      overlay.classList.remove('open');
    }
    toggle.addEventListener('click', () => {
      const open = nav.classList.toggle('open');
      overlay.classList.toggle('open', open);
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
    overlay.addEventListener('click', close);
  })();

  // ===== Scroll reveal animations =====
  (function(){
    const targets = document.querySelectorAll('.reveal');
    if(!('IntersectionObserver' in window)){
      targets.forEach(t => t.classList.add('visible'));
      return;
    }
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if(entry.isIntersecting){
          entry.target.classList.add('visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -60px 0px' });
    targets.forEach(t => observer.observe(t));
  })();
</script>
@yield('scripts')
</body>
</html>
