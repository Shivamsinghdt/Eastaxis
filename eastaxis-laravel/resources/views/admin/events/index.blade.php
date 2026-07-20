@extends('admin.layouts.app')

@section('title', 'Events')

@section('actions')
  <a href="{{ route('admin.events.create') }}" class="btn">+ New Event</a>
@endsection

@section('content')
<div class="card">
  <table>
    <thead>
      <tr><th>Image</th><th>Title</th><th>Date</th><th>Speakers</th><th>Status</th><th>Actions</th></tr>
    </thead>
    <tbody>
      @forelse ($events as $event)
        <tr>
          <td>@if($event->image)<img class="thumb" src="{{ str_starts_with($event->image, 'http') ? $event->image : asset('storage/'.$event->image) }}" alt="">@endif</td>
          <td>{{ $event->title }}</td>
          <td>{{ $event->event_date->format('d M Y, g:i A') }}</td>
          <td>{{ $event->speakers }}</td>
          <td>{{ $event->is_published ? 'Published' : 'Draft' }}</td>
          <td class="actions">
            <a href="{{ route('admin.events.edit', $event) }}" class="btn outline">Edit</a>
            <form method="POST" action="{{ route('admin.events.destroy', $event) }}" onsubmit="return confirm('Delete this event?');">
              @csrf @method('DELETE')
              <button type="submit" class="btn danger">Delete</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="6">No events yet. <a href="{{ route('admin.events.create') }}">Create one</a>.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
<div style="margin-top:20px;">{{ $events->links() }}</div>
@endsection
