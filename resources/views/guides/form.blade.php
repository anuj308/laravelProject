@csrf

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $guide->name ?? '') }}" required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Destination (Optional)</label>
        <select name="destination_id" class="form-select @error('destination_id') is-invalid @enderror">
            <option value="">-- Any Destination --</option>
            @foreach($destinations as $destination)
                <option value="{{ $destination->id }}" {{ old('destination_id', $guide->destination_id ?? '') == $destination->id ? 'selected' : '' }}>
                    {{ $destination->name }}
                </option>
            @endforeach
        </select>
        @error('destination_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Phone</label>
        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $guide->phone ?? '') }}" required>
        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $guide->email ?? '') }}" required>
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Languages (e.g., Hindi, English)</label>
        <input type="text" name="languages" class="form-control @error('languages') is-invalid @enderror" value="{{ old('languages', $guide->languages ?? '') }}" required>
        @error('languages') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3">
        <label class="form-label">Fee per Day (₹)</label>
        <input type="number" step="0.01" name="fee_per_day" class="form-control @error('fee_per_day') is-invalid @enderror" value="{{ old('fee_per_day', $guide->fee_per_day ?? '') }}" required>
        @error('fee_per_day') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3">
        <label class="form-label">Rating (0 - 5)</label>
        <input type="number" step="0.1" max="5" name="rating" class="form-control @error('rating') is-invalid @enderror" value="{{ old('rating', $guide->rating ?? '0') }}" required>
        @error('rating') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>
