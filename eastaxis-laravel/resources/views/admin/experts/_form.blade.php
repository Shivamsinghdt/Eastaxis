@csrf
@if(isset($expert)) @method('PUT') @endif

<div class="card" style="max-width:640px;">
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" value="{{ old('name', $expert->name ?? '') }}" required>
    @error('name')<div class="error-text">{{ $message }}</div>@enderror
  </div>

  <div class="form-group">
    <label for="role">Role / Title</label>
    <input type="text" id="role" name="role" value="{{ old('role', $expert->role ?? '') }}">
    @error('role')<div class="error-text">{{ $message }}</div>@enderror
  </div>

  <div class="form-group">
    <label for="bio">Bio</label>
    <textarea id="bio" name="bio">{{ old('bio', $expert->bio ?? '') }}</textarea>
    @error('bio')<div class="error-text">{{ $message }}</div>@enderror
  </div>

  <div class="form-group">
    <label for="photo">Photo {{ isset($expert) && $expert->photo ? '(leave blank to keep current)' : '' }}</label>
    @if (isset($expert) && $expert->photo)
      <img class="thumb" style="width:80px;height:80px;margin-bottom:8px;" src="{{ asset('storage/'.$expert->photo) }}" alt="">
    @endif
    <input type="file" id="photo" name="photo" accept="image/*">
    @error('photo')<div class="error-text">{{ $message }}</div>@enderror
  </div>

  <div class="form-group">
    <label for="sort_order">Sort Order</label>
    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $expert->sort_order ?? 0) }}">
    @error('sort_order')<div class="error-text">{{ $message }}</div>@enderror
  </div>

  <div class="form-group checkbox-row">
    <input type="checkbox" id="is_published" name="is_published" value="1" @checked(old('is_published', $expert->is_published ?? true))>
    <label for="is_published" style="margin:0;font-weight:400;">Published (visible on site)</label>
  </div>

  <button type="submit" class="btn">{{ isset($expert) ? 'Update Expert' : 'Add Expert' }}</button>
  <a href="{{ route('admin.experts.index') }}" class="btn outline">Cancel</a>
</div>
