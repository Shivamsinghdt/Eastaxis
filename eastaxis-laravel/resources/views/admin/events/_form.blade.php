@csrf
@if(isset($event)) @method('PUT') @endif

<div class="card" style="max-width:640px;">
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" id="title" name="title" value="{{ old('title', $event->title ?? '') }}" required>
    @error('title')<div class="error-text">{{ $message }}</div>@enderror
  </div>

  <div class="form-group">
    <label for="event_date">Date &amp; Time</label>
    <input type="datetime-local" id="event_date" name="event_date"
      value="{{ old('event_date', isset($event) ? $event->event_date->format('Y-m-d\TH:i') : '') }}" required>
    @error('event_date')<div class="error-text">{{ $message }}</div>@enderror
  </div>

  <div class="form-group">
    <label for="speakers">Speakers</label>
    <input type="text" id="speakers" name="speakers" value="{{ old('speakers', $event->speakers ?? '') }}" placeholder="Comma-separated names">
    @error('speakers')<div class="error-text">{{ $message }}</div>@enderror
  </div>

  <div class="form-group">
    <label for="description">Description</label>
    <textarea id="description" name="description">{{ old('description', $event->description ?? '') }}</textarea>
    @error('description')<div class="error-text">{{ $message }}</div>@enderror
  </div>

  <div class="form-group">
    <label for="image">Image {{ isset($event) && $event->image ? '(leave blank to keep current)' : '' }}</label>
    @if (isset($event) && $event->image)
      <img class="thumb" style="width:120px;height:80px;margin-bottom:8px;" src="{{ str_starts_with($event->image, 'http') ? $event->image : asset('storage/'.$event->image) }}" alt="">
    @endif
    <input type="file" id="image" name="image" accept="image/*">
    @error('image')<div class="error-text">{{ $message }}</div>@enderror
  </div>

  <div class="form-group checkbox-row">
    <input type="checkbox" id="is_published" name="is_published" value="1" @checked(old('is_published', $event->is_published ?? true))>
    <label for="is_published" style="margin:0;font-weight:400;">Published (visible on site)</label>
  </div>

  <button type="submit" class="btn">{{ isset($event) ? 'Update Event' : 'Create Event' }}</button>
  <a href="{{ route('admin.events.index') }}" class="btn outline">Cancel</a>
</div>
