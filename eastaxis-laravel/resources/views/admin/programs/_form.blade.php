@csrf
@if(isset($program)) @method('PUT') @endif

<div class="card" style="max-width:640px;">
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" id="title" name="title" value="{{ old('title', $program->title ?? '') }}" required>
    @error('title')<div class="error-text">{{ $message }}</div>@enderror
  </div>

  <div class="form-group">
    <label for="description">Description (optional)</label>
    <textarea id="description" name="description">{{ old('description', $program->description ?? '') }}</textarea>
    @error('description')<div class="error-text">{{ $message }}</div>@enderror
  </div>

  <div class="form-group">
    <label for="sort_order">Sort Order</label>
    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $program->sort_order ?? 0) }}">
    @error('sort_order')<div class="error-text">{{ $message }}</div>@enderror
  </div>

  <div class="form-group checkbox-row">
    <input type="checkbox" id="is_published" name="is_published" value="1" @checked(old('is_published', $program->is_published ?? true))>
    <label for="is_published" style="margin:0;font-weight:400;">Published (visible on site)</label>
  </div>

  <button type="submit" class="btn">{{ isset($program) ? 'Update Program' : 'Create Program' }}</button>
  <a href="{{ route('admin.programs.index') }}" class="btn outline">Cancel</a>
</div>
