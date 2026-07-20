@extends('layouts.app')

@section('title', $article->title.' | EastAxis')

@section('content')
<section id="research">
  <div class="wrap" style="max-width:760px;">
    <span class="eyebrow">{{ $article->type }}</span>
    <h1>{{ $article->title }}</h1>
    <p style="opacity:.6;font-size:14px;">
      Published {{ optional($article->published_at)->format('F j, Y') }}
    </p>

    @if ($article->image_url)
      <img src="{{ $article->image_url }}" alt="{{ $article->title }}" style="width:100%;border-radius:12px;margin:24px 0;">
    @endif

    <div class="article-body" style="line-height:1.75;">
      {!! nl2br(e($article->body)) !!}
    </div>

    <p style="margin-top:32px;">
      <a href="{{ route('articles.index') }}" class="link">&larr; Back to all research</a>
    </p>
  </div>
</section>
@endsection
