@csrf
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Package Title</label>
        <input name="title" class="form-control" value="{{ old('title', $package->title ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Destination</label>
        <select name="destination_id" class="form-select">
            <option value="">No destination</option>
            @foreach($destinations as $destination)
                <option value="{{ $destination->id }}" @selected(old('destination_id', $package->destination_id ?? '') == $destination->id)>{{ $destination->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">Price</label>
        <input name="price" type="number" class="form-control" value="{{ old('price', $package->price ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Duration Days</label>
        <input name="duration_days" type="number" class="form-control" value="{{ old('duration_days', $package->duration_days ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Image URL</label>
        <input name="image" class="form-control" value="{{ old('image', $package->image ?? '') }}">
    </div>
    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea name="description" rows="4" class="form-control" required>{{ old('description', $package->description ?? '') }}</textarea>
    </div>
    <div class="col-12">
        <button class="btn btn-success">Save Package</button>
        <a href="{{ route('packages.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </div>
</div>
