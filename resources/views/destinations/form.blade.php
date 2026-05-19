@csrf
<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Destination Name</label>
            <input name="name" value="{{ old('name', $destination->name ?? '') }}" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" required placeholder="e.g. Udaipur">
        </div>
        
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Location/State</label>
            <input name="location" value="{{ old('location', $destination->location ?? '') }}" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" required placeholder="e.g. Rajasthan, India">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Image URL</label>
            <input name="image" value="{{ old('image', $destination->image ?? '') }}" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" placeholder="https://...">
        </div>
        
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Rating</label>
            <input name="rating" type="number" step="0.1" min="0" max="5" value="{{ old('rating', $destination->rating ?? '5.0') }}" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" required placeholder="e.g. 4.8">
        </div>
    </div>

    <div>
        <label class="block text-sm font-bold text-slate-700 mb-2">Description</label>
        <textarea name="description" rows="5" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" required placeholder="Describe the destination...">{{ old('description', $destination->description ?? '') }}</textarea>
    </div>

    <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
        <a href="{{ route('destinations.index') }}" class="px-6 py-3 bg-white text-slate-700 border border-slate-200 font-bold rounded-xl hover:bg-slate-50 transition shadow-sm">
            Cancel
        </a>
        <button type="submit" class="px-8 py-3 bg-teal-600 text-white font-bold rounded-xl hover:bg-teal-700 transition shadow-sm flex items-center gap-2">
            <i class="bi bi-save"></i> Save Destination
        </button>
    </div>
</div>
