@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="stats-grid">
  <div class="stat-card"><div class="num">{{ $stats['articles'] }}</div><div class="label">Research Articles</div></div>
  <div class="stat-card"><div class="num">{{ $stats['events'] }}</div><div class="label">Events</div></div>
  <div class="stat-card"><div class="num">{{ $stats['programs'] }}</div><div class="label">Programs</div></div>
  <div class="stat-card"><div class="num">{{ $stats['experts'] }}</div><div class="label">Experts</div></div>
  <div class="stat-card"><div class="num">{{ $stats['subscribers'] }}</div><div class="label">Subscribers</div></div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">
  <div class="card">
    <h3 style="margin-top:0;">Recent Articles</h3>
    <table>
      <thead><tr><th>Title</th><th>Type</th><th>Status</th></tr></thead>
      <tbody>
        @forelse ($recentArticles as $article)
          <tr>
            <td>{{ $article->title }}</td>
            <td>{{ $article->type }}</td>
            <td>{{ $article->is_published ? 'Published' : 'Draft' }}</td>
          </tr>
        @empty
          <tr><td colspan="3">No articles yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="card">
    <h3 style="margin-top:0;">Recent Subscribers</h3>
    <table>
      <thead><tr><th>Email</th><th>Subscribed</th></tr></thead>
      <tbody>
        @forelse ($recentSubscribers as $subscriber)
          <tr>
            <td>{{ $subscriber->email }}</td>
            <td>{{ $subscriber->created_at->diffForHumans() }}</td>
          </tr>
        @empty
          <tr><td colspan="2">No subscribers yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
