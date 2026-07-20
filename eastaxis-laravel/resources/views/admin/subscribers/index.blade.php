@extends('admin.layouts.app')

@section('title', 'Newsletter Subscribers')

@section('actions')
  <a href="{{ route('admin.subscribers.export') }}" class="btn">Export CSV</a>
@endsection

@section('content')
<div class="card">
  <table>
    <thead>
      <tr><th>Email</th><th>Subscribed On</th><th>Actions</th></tr>
    </thead>
    <tbody>
      @forelse ($subscribers as $subscriber)
        <tr>
          <td>{{ $subscriber->email }}</td>
          <td>{{ $subscriber->created_at->format('d M Y, g:i A') }}</td>
          <td class="actions">
            <form method="POST" action="{{ route('admin.subscribers.destroy', $subscriber) }}" onsubmit="return confirm('Remove this subscriber?');">
              @csrf @method('DELETE')
              <button type="submit" class="btn danger">Remove</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="3">No subscribers yet.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
<div style="margin-top:20px;">{{ $subscribers->links() }}</div>
@endsection
