@csrf
<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Hotel Name</label>
            <input name="name" value="{{ old('name', $hotel->name ?? '') }}" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" required placeholder="e.g. Taj Lake Palace">
        </div>
        
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Destination</label>
            <select name="destination_id" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white appearance-none">
                <option value="">No specific destination</option>
                @foreach($destinations as $destination)
                    <option value="{{ $destination->id }}" @selected(old('destination_id', $hotel->destination_id ?? '') == $destination->id)>{{ $destination->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Location Address</label>
            <input name="location" value="{{ old('location', $hotel->location ?? '') }}" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" required placeholder="e.g. Pichola, Udaipur">
        </div>
        
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Image URL</label>
            <input name="image" value="{{ old('image', $hotel->image ?? '') }}" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" placeholder="https://...">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Price Per Night (₹)</label>
            <input name="price_per_night" type="number" value="{{ old('price_per_night', $hotel->price_per_night ?? '') }}" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" required placeholder="e.g. 8500">
        </div>
        
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Available Rooms</label>
            <input name="available_rooms" type="number" min="0" value="{{ old('available_rooms', $hotel->available_rooms ?? '') }}" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" required placeholder="e.g. 10">
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Rating</label>
            <input name="rating" type="number" step="0.1" min="0" max="5" value="{{ old('rating', $hotel->rating ?? '5.0') }}" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" required placeholder="e.g. 4.8">
        </div>
    </div>

    <div>
        <label class="block text-sm font-bold text-slate-700 mb-2">Description</label>
        <textarea name="description" rows="5" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" required placeholder="Describe the hotel amenities and experience...">{{ old('description', $hotel->description ?? '') }}</textarea>
    </div>

    <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
        <a href="{{ route('hotels.index') }}" class="px-6 py-3 bg-white text-slate-700 border border-slate-200 font-bold rounded-xl hover:bg-slate-50 transition shadow-sm">
            Cancel
        </a>
        <button type="submit" class="px-8 py-3 bg-teal-600 text-white font-bold rounded-xl hover:bg-teal-700 transition shadow-sm flex items-center gap-2">
            <i class="bi bi-save"></i> Save Hotel
        </button>
    </div>
</div>
