@csrf
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Hotel Name</label>
        <input name="name" class="form-control" value="{{ old('name', $hotel->name ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Destination</label>
        <select name="destination_id" class="form-select">
            <option value="">No destination</option>
            @foreach($destinations as $destination)
                <option value="{{ $destination->id }}" @selected(old('destination_id', $hotel->destination_id ?? '') == $destination->id)>{{ $destination->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Location</label>
        <input name="location" class="form-control" value="{{ old('location', $hotel->location ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Image URL</label>
        <input name="image" class="form-control" value="{{ old('image', $hotel->image ?? '') }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Price Per Night</label>
        <input name="price_per_night" type="number" class="form-control" value="{{ old('price_per_night', $hotel->price_per_night ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Available Rooms</label>
        <input name="available_rooms" type="number" class="form-control" value="{{ old('available_rooms', $hotel->available_rooms ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Rating</label>
        <input name="rating" type="number" step="0.1" min="0" max="5" class="form-control" value="{{ old('rating', $hotel->rating ?? 4) }}" required>
    </div>
    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea name="description" rows="4" class="form-control" required>{{ old('description', $hotel->description ?? '') }}</textarea>
    </div>
    <div class="col-12">
        <button class="btn btn-success">Save Hotel</button>
        <a href="{{ route('hotels.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </div>
</div>
