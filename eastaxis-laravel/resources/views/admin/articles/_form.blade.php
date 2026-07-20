@csrf
@if(isset($article)) @method('PUT') @endif

<div class="card" style="max-width:640px;">
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" id="title" name="title" value="{{ old('title', $article->title ?? '') }}" required>
    @error('title')<div class="error-text">{{ $message }}</div>@enderror
  </div>

  <div class="form-group">
    <label for="type">Type</label>
    <select id="type" name="type">
      @foreach (['Paper', 'Report', 'Article'] as $type)
        <option value="{{ $type }}" @selected(old('type', $article->type ?? 'Article') === $type)>{{ $type }}</option>
      @endforeach
    </select>
    @error('type')<div class="error-text">{{ $message }}</div>@enderror
  </div>

  <div class="form-group">
    <label for="excerpt">Excerpt (short summary shown on cards)</label>
    <textarea id="excerpt" name="excerpt" style="min-height:80px;">{{ old('excerpt', $article->excerpt ?? '') }}</textarea>
    @error('excerpt')<div class="error-text">{{ $message }}</div>@enderror
  </div>

  <div class="form-group">
    <label for="body">Full Body</label>
    <textarea id="body" name="body">{{ old('body', $article->body ?? '') }}</textarea>
    @error('body')<div class="error-text">{{ $message }}</div>@enderror
  </div>

  <div class="form-group">
    <label for="image">Image {{ isset($article) && $article->image ? '(leave blank to keep current)' : '' }}</label>
    @if (isset($article) && $article->image)
      <img class="thumb" style="width:120px;height:80px;margin-bottom:8px;" src="{{ str_starts_with($article->image, 'http') ? $article->image : asset('storage/'.$article->image) }}" alt="">
    @endif
    <input type="file" id="image" name="image" accept="image/*">
    @error('image')<div class="error-text">{{ $message }}</div>@enderror
  </div>

  <div class="form-group">
    <label for="published_at">Published Date</label>
    <input type="date" id="published_at" name="published_at" value="{{ old('published_at', isset($article->published_at) ? $article->published_at->format('Y-m-d') : '') }}">
  </div>

  <div class="form-group checkbox-row">
    <input type="checkbox" id="is_featured" name="is_featured" value="1" @checked(old('is_featured', $article->is_featured ?? false))>
    <label for="is_featured" style="margin:0;font-weight:400;">Feature this article</label>
  </div>

  <div class="form-group checkbox-row">
    <input type="checkbox" id="is_published" name="is_published" value="1" @checked(old('is_published', $article->is_published ?? true))>
    <label for="is_published" style="margin:0;font-weight:400;">Published (visible on site)</label>
  </div>

  <button type="submit" class="btn">{{ isset($article) ? 'Update Article' : 'Create Article' }}</button>
  <a href="{{ route('admin.articles.index') }}" class="btn outline">Cancel</a>
</div>
