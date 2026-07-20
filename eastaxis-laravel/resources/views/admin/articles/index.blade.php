@extends('admin.layouts.app')

@section('title', 'Research Articles')

@section('actions')
  <a href="{{ route('admin.articles.create') }}" class="btn">+ New Article</a>
@endsection

@section('content')
<div class="card">
  <table>
    <thead>
      <tr><th>Image</th><th>Title</th><th>Type</th><th>Status</th><th>Published</th><th>Actions</th></tr>
    </thead>
    <tbody>
      @forelse ($articles as $article)
        <tr>
          <td>@if($article->image)<img class="thumb" src="{{ str_starts_with($article->image, 'http') ? $article->image : asset('storage/'.$article->image) }}" alt="">@endif</td>
          <td>{{ $article->title }}</td>
          <td>{{ $article->type }}</td>
          <td>{{ $article->is_published ? 'Published' : 'Draft' }}</td>
          <td>{{ optional($article->published_at)->format('d M Y') }}</td>
          <td class="actions">
            <a href="{{ route('admin.articles.edit', $article) }}" class="btn outline">Edit</a>
            <form method="POST" action="{{ route('admin.articles.destroy', $article) }}" onsubmit="return confirm('Delete this article?');">
              @csrf @method('DELETE')
              <button type="submit" class="btn danger">Delete</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="6">No articles yet. <a href="{{ route('admin.articles.create') }}">Create one</a>.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
<div style="margin-top:20px;">{{ $articles->links() }}</div>
@endsection
