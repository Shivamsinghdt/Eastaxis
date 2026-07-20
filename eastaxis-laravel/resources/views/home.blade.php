@extends('layouts.app')

@section('content')

<section class="hero">
  <div class="wrap">
    <span class="eyebrow">Independent Research &amp; Advisory</span>
    <h1>Rigorous analysis for a changing region</h1>
    <p>EastAxis delivers unbiased research on trade, technology, climate, and security to help institutions make better decisions.</p>
  </div>
</section>

<!-- ===== ABOUT ===== -->
<section class="about" id="who-we-are">
  <div class="wrap about-grid">
    <div class="about-copy reveal">
      <span class="eyebrow">Who We Are</span>
      <h2>EastAxis Research and Advisory (EARA)</h2>
      <p>EastAxis Research and Advisory (EARA) is an independent, non-partisan think tank dedicated to advancing research, policy analysis, and strategic dialogue on Northeast India and its wider eastern neighbourhood — Southeast Asia, East Asia, and Australia.</p>
      <p>EARA closely tracks developments in India's eastern neighbourhood policy and the implementation of the Act East Policy.</p>
      <a href="#research" class="btn">Learn More</a>
      <a href="#contact" class="btn outline">Talk to Our Team</a>
    </div>
    <div class="about-media reveal">
      <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=800&auto=format&fit=crop" alt="Analysts in discussion">
    </div>
  </div>
</section>

<!-- ===== RESEARCH (dynamic) ===== -->
<section id="research">
  <div class="wrap">
    <div class="section-head reveal">
      <h2>We deliver unbiased research to decision-makers shaping the region's future</h2>
      <a href="{{ route('articles.index') }}" class="more">See our research &rarr;</a>
    </div>

    @foreach ($articles as $index => $article)
    <div class="pillar {{ $index % 2 == 1 ? 'reverse' : '' }} reveal">
      <div class="pillar-media">
        <img src="{{ $article->image_url ?? 'https://images.unsplash.com/photo-1518186285589-2f7649de83e0?q=80&w=700&auto=format&fit=crop' }}" alt="{{ $article->title }}">
      </div>
      <div class="pillar-copy">
        <span class="eyebrow">{{ $article->type }}</span>
        <h3>{{ $article->title }}</h3>
        <p>{{ $article->excerpt }}</p>
        <a href="{{ route('articles.show', $article) }}" class="link">Read the {{ strtolower($article->type) }} &rarr;</a>
      </div>
    </div>
    @endforeach

    @if ($articles->isEmpty())
      <p>No research published yet.</p>
    @endif
  </div>
</section>

<!-- ===== TOPICS ===== -->
<section class="topics">
  <div class="wrap">
    <div class="section-head reveal" style="border-bottom:none;padding-bottom:0;margin-bottom:22px;">
      <h2 style="font-size:22px;">Trending Topics &amp; Regions</h2>
    </div>
    <div class="chip-row reveal-stagger reveal">
      <a href="#" class="chip stagger-item">Trade Policy</a>
      <a href="#" class="chip stagger-item">Technology &amp; AI</a>
      <a href="#" class="chip stagger-item">South Asia</a>
      <a href="#" class="chip stagger-item">Southeast Asia</a>
      <a href="#" class="chip stagger-item">Climate &amp; Energy</a>
      <a href="#" class="chip stagger-item">Governance</a>
      <a href="#" class="chip stagger-item">Security</a>
      <a href="#" class="chip stagger-item">Africa</a>
    </div>
  </div>
</section>

<!-- ===== PROGRAMS (dynamic) ===== -->
<section id="programs">
  <div class="wrap">
    <div class="section-head reveal">
      <h2>Cross-cutting practices across key regions</h2>
    </div>
    <div class="programs-grid reveal-stagger reveal">
      @foreach ($programs as $program)
        <a href="#" class="program-card stagger-item">{{ $program->title }}</a>
      @endforeach
    </div>
  </div>
</section>

<!-- ===== EXPERTS (dynamic) ===== -->
<section class="topics" id="experts">
  <div class="wrap">
    <div class="section-head reveal">
      <h2>Our Experts</h2>
    </div>
    <div class="programs-grid reveal-stagger reveal">
      @foreach ($experts as $expert)
        <div class="program-card stagger-item">
          <strong>{{ $expert->name }}</strong>
          @if ($expert->role)<br><small>{{ $expert->role }}</small>@endif
        </div>
      @endforeach
      @if ($experts->isEmpty())
        <p>Expert profiles coming soon.</p>
      @endif
    </div>
  </div>
</section>

<!-- ===== EVENTS (dynamic) ===== -->
<section class="topics" id="insights">
  <div class="wrap">
    <div class="section-head reveal">
      <h2>Events convening leaders across the region</h2>
    </div>
    <div class="events-grid reveal-stagger reveal">
      @foreach ($events as $event)
      <div class="event-card stagger-item">
        <img src="{{ $event->image_url ?? 'https://images.unsplash.com/photo-1591115765373-5207764f72e7?q=80&w=500&auto=format&fit=crop' }}" alt="{{ $event->title }}">
        <div class="event-body">
          <div class="event-date">{{ $event->event_date->format('F j, Y \a\t g:i A') }} IST</div>
          <h4>{{ $event->title }}</h4>
          <p>{{ $event->speakers }}</p>
        </div>
      </div>
      @endforeach
      @if ($events->isEmpty())
        <p>No upcoming events right now.</p>
      @endif
    </div>
  </div>
</section>

<!-- ===== NEWSLETTER (dynamic) ===== -->
<section class="newsletter reveal">
  <div class="wrap">
    <h2>Get research and analysis from EastAxis</h2>
    <p>A curated briefing in your inbox, twice a month.</p>

    @if (session('subscribed'))
      <p style="color:#2f9e44;font-weight:600;">Subscribed &check; Thank you!</p>
    @endif
    @error('email')
      <p style="color:#e03131;font-weight:600;">{{ $message }}</p>
    @enderror

    <form class="newsletter-form" method="POST" action="{{ route('newsletter.store') }}">
      @csrf
      <input type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required>
      <button type="submit">Subscribe</button>
    </form>
  </div>
</section>

@endsection
