@extends('layouts.app')

@section('title', 'Research | EastAxis')

@section('content')
<section id="research">
  <div class="wrap">
    <div class="section-head reveal">
      <h2>Research &amp; Insights</h2>
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

    <div style="margin-top:32px;">
      {{ $articles->links() }}
    </div>
  </div>
</section>
@endsection
