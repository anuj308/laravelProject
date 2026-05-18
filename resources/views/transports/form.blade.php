@csrf

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Type (e.g., Bus, Flight, Cab)</label>
        <input type="text" name="type" class="form-control @error('type') is-invalid @enderror" value="{{ old('type', $transport->type ?? '') }}" required>
        @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Provider (Company Name)</label>
        <input type="text" name="provider" class="form-control @error('provider') is-invalid @enderror" value="{{ old('provider', $transport->provider ?? '') }}" required>
        @error('provider') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-12">
        <label class="form-label">Route (e.g., Delhi to Jaipur)</label>
        <input type="text" name="route" class="form-control @error('route') is-invalid @enderror" value="{{ old('route', $transport->route ?? '') }}" required>
        @error('route') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Departure Time</label>
        <input type="time" name="departure_time" class="form-control @error('departure_time') is-invalid @enderror" value="{{ old('departure_time', (isset($transport) ? \Carbon\Carbon::parse($transport->departure_time)->format('H:i') : '')) }}" required>
        @error('departure_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Available Seats</label>
        <input type="number" min="1" name="available_seats" class="form-control @error('available_seats') is-invalid @enderror" value="{{ old('available_seats', $transport->available_seats ?? '') }}" required>
        @error('available_seats') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Price (₹)</label>
        <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $transport->price ?? '') }}" required>
        @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>
