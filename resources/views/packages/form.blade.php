@csrf
<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Package Title</label>
            <input name="title" value="{{ old('title', $package->title ?? '') }}" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" required placeholder="e.g. Royal Rajasthan Tour">
        </div>
        
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Destination</label>
            <select name="destination_id" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white appearance-none">
                <option value="">No destination (Multi-city)</option>
                @foreach($destinations as $destination)
                    <option value="{{ $destination->id }}" @selected(old('destination_id', $package->destination_id ?? '') == $destination->id)>{{ $destination->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Price (₹)</label>
            <input name="price" type="number" value="{{ old('price', $package->price ?? '') }}" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" required placeholder="e.g. 25000">
        </div>
        
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Duration (Days)</label>
            <input name="duration_days" type="number" min="1" value="{{ old('duration_days', $package->duration_days ?? '') }}" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" required placeholder="e.g. 5">
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Image URL</label>
            <input name="image" value="{{ old('image', $package->image ?? '') }}" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" placeholder="https://...">
        </div>
    </div>

    <div>
        <label class="block text-sm font-bold text-slate-700 mb-2">Description</label>
        <textarea name="description" rows="5" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" required placeholder="Describe the package itinerary and inclusions...">{{ old('description', $package->description ?? '') }}</textarea>
    </div>

    <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
        <a href="{{ route('packages.index') }}" class="px-6 py-3 bg-white text-slate-700 border border-slate-200 font-bold rounded-xl hover:bg-slate-50 transition shadow-sm">
            Cancel
        </a>
        <button type="submit" class="px-8 py-3 bg-teal-600 text-white font-bold rounded-xl hover:bg-teal-700 transition shadow-sm flex items-center gap-2">
            <i class="bi bi-save"></i> Save Package
        </button>
    </div>
</div>
