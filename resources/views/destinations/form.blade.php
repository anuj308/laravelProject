@csrf
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Destination Name</label>
        <input name="name" class="form-control" value="{{ old('name', $destination->name ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Location</label>
        <input name="location" class="form-control" value="{{ old('location', $destination->location ?? '') }}" required>
    </div>
    <div class="col-md-8">
        <label class="form-label">Image URL</label>
        <input name="image" class="form-control" value="{{ old('image', $destination->image ?? '') }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Rating</label>
        <input name="rating" type="number" step="0.1" min="0" max="5" class="form-control" value="{{ old('rating', $destination->rating ?? 4) }}" required>
    </div>
    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea name="description" rows="5" class="form-control" required>{{ old('description', $destination->description ?? '') }}</textarea>
    </div>
    <div class="col-12">
        <button class="btn btn-success">Save Destination</button>
        <a href="{{ route('destinations.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </div>
</div>
