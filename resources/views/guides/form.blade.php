@csrf
<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Guide Name</label>
            <input name="name" value="{{ old('name', $guide->name ?? '') }}" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" required placeholder="e.g. Ramesh Kumar">
        </div>
        
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Destination</label>
            <select name="destination_id" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white appearance-none">
                <option value="">No specific destination</option>
                @foreach($destinations as $destination)
                    <option value="{{ $destination->id }}" @selected(old('destination_id', $guide->destination_id ?? '') == $destination->id)>{{ $destination->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Email Address</label>
            <input name="email" type="email" value="{{ old('email', $guide->email ?? '') }}" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" required placeholder="e.g. ramesh@example.com">
        </div>
        
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Phone Number</label>
            <input name="phone" value="{{ old('phone', $guide->phone ?? '') }}" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" required placeholder="e.g. +91 9876543210">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-2">
            <label class="block text-sm font-bold text-slate-700 mb-2">Languages Spoken</label>
            <input name="languages" value="{{ old('languages', $guide->languages ?? '') }}" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" required placeholder="e.g. English, Hindi, Spanish">
            <p class="text-xs text-slate-500 mt-1">Comma-separated values.</p>
        </div>
        
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Fee Per Day (₹)</label>
            <input name="fee_per_day" type="number" value="{{ old('fee_per_day', $guide->fee_per_day ?? '') }}" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" required placeholder="e.g. 1500">
        </div>
    </div>

    <div>
        <label class="block text-sm font-bold text-slate-700 mb-2">Rating</label>
        <input name="rating" type="number" step="0.1" min="0" max="5" value="{{ old('rating', $guide->rating ?? '5.0') }}" class="block w-full md:w-1/3 px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" required placeholder="e.g. 4.8">
    </div>

    <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
        <a href="{{ route('guides.index') }}" class="px-6 py-3 bg-white text-slate-700 border border-slate-200 font-bold rounded-xl hover:bg-slate-50 transition shadow-sm">
            Cancel
        </a>
        <button type="submit" class="px-8 py-3 bg-teal-600 text-white font-bold rounded-xl hover:bg-teal-700 transition shadow-sm flex items-center gap-2">
            <i class="bi bi-save"></i> Save Guide
        </button>
    </div>
</div>
