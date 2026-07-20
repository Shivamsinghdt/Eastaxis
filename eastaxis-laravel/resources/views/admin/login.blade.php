<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login | EastAxis</title>
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
  <div class="login-wrap">
    <div class="login-card">
      <h1>EastAxis Admin</h1>
      <p>Sign in to manage your site content.</p>

      @if ($errors->any())
        <div class="alert alert-danger">
          @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
          @endforeach
        </div>
      @endif

      <form method="POST" action="{{ route('admin.login.attempt') }}">
        @csrf
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group checkbox-row">
          <input type="checkbox" id="remember" name="remember">
          <label for="remember" style="margin:0;font-weight:400;">Remember me</label>
        </div>
        <button type="submit" class="btn" style="width:100%;">Log In</button>
      </form>
    </div>
  </div>
</body>
</html>
