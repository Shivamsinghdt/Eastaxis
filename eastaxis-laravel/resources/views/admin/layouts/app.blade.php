<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard') | EastAxis Admin</title>
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<div class="admin-wrap">
  <aside class="admin-sidebar">
    <div class="brand">EastAxis Admin</div>
    <nav>
      <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
      <a href="{{ route('admin.articles.index') }}" class="{{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">Research Articles</a>
      <a href="{{ route('admin.events.index') }}" class="{{ request()->routeIs('admin.events.*') ? 'active' : '' }}">Events</a>
      <a href="{{ route('admin.programs.index') }}" class="{{ request()->routeIs('admin.programs.*') ? 'active' : '' }}">Programs</a>
      <a href="{{ route('admin.experts.index') }}" class="{{ request()->routeIs('admin.experts.*') ? 'active' : '' }}">Experts</a>
      <a href="{{ route('admin.subscribers.index') }}" class="{{ request()->routeIs('admin.subscribers.*') ? 'active' : '' }}">Newsletter Subscribers</a>
      <a href="{{ route('home') }}" target="_blank">View Site &#8599;</a>
      <form method="POST" action="{{ route('admin.logout') }}" style="padding:12px 24px;">
        @csrf
        <button type="submit" class="btn outline" style="width:100%;background:transparent;color:#fff;border-color:rgba(255,255,255,.3);">Log Out</button>
      </form>
    </nav>
  </aside>

  <main class="admin-main">
    <div class="admin-topbar">
      <h1>@yield('title', 'Dashboard')</h1>
      @hasSection('actions') @yield('actions') @endif
    </div>

    @if (session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
          <div>{{ $error }}</div>
        @endforeach
      </div>
    @endif

    @yield('content')
  </main>
</div>
</body>
</html>
