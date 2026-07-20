@extends('admin.layouts.app')

@section('title', 'Programs')

@section('actions')
  <a href="{{ route('admin.programs.create') }}" class="btn">+ New Program</a>
@endsection

@section('content')
<div class="card">
  <table>
    <thead>
      <tr><th>Order</th><th>Title</th><th>Status</th><th>Actions</th></tr>
    </thead>
    <tbody>
      @forelse ($programs as $program)
        <tr>
          <td>{{ $program->sort_order }}</td>
          <td>{{ $program->title }}</td>
          <td>{{ $program->is_published ? 'Published' : 'Draft' }}</td>
          <td class="actions">
            <a href="{{ route('admin.programs.edit', $program) }}" class="btn outline">Edit</a>
            <form method="POST" action="{{ route('admin.programs.destroy', $program) }}" onsubmit="return confirm('Delete this program?');">
              @csrf @method('DELETE')
              <button type="submit" class="btn danger">Delete</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="4">No programs yet. <a href="{{ route('admin.programs.create') }}">Create one</a>.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
<div style="margin-top:20px;">{{ $programs->links() }}</div>
@endsection
