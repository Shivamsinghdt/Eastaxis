@extends('admin.layouts.app')

@section('title', 'Experts')

@section('actions')
  <a href="{{ route('admin.experts.create') }}" class="btn">+ New Expert</a>
@endsection

@section('content')
<div class="card">
  <table>
    <thead>
      <tr><th>Photo</th><th>Name</th><th>Role</th><th>Status</th><th>Actions</th></tr>
    </thead>
    <tbody>
      @forelse ($experts as $expert)
        <tr>
          <td>@if($expert->photo)<img class="thumb" src="{{ asset('storage/'.$expert->photo) }}" alt="">@endif</td>
          <td>{{ $expert->name }}</td>
          <td>{{ $expert->role }}</td>
          <td>{{ $expert->is_published ? 'Published' : 'Draft' }}</td>
          <td class="actions">
            <a href="{{ route('admin.experts.edit', $expert) }}" class="btn outline">Edit</a>
            <form method="POST" action="{{ route('admin.experts.destroy', $expert) }}" onsubmit="return confirm('Remove this expert?');">
              @csrf @method('DELETE')
              <button type="submit" class="btn danger">Delete</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="5">No experts yet. <a href="{{ route('admin.experts.create') }}">Add one</a>.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
<div style="margin-top:20px;">{{ $experts->links() }}</div>
@endsection
