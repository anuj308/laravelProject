@csrf
<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Transport Type</label>
            <select name="type" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white appearance-none" required>
                <option value="Flight" @selected(old('type', $transport->type ?? '') == 'Flight')>Flight</option>
                <option value="Train" @selected(old('type', $transport->type ?? '') == 'Train')>Train</option>
                <option value="Bus" @selected(old('type', $transport->type ?? '') == 'Bus')>Bus</option>
                <option value="Cab" @selected(old('type', $transport->type ?? '') == 'Cab')>Cab</option>
            </select>
        </div>
        
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Provider Name</label>
            <input name="provider" value="{{ old('provider', $transport->provider ?? '') }}" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" required placeholder="e.g. Indigo Airlines">
        </div>
    </div>

    <div>
        <label class="block text-sm font-bold text-slate-700 mb-2">Route Details</label>
        <input name="route" value="{{ old('route', $transport->route ?? '') }}" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" required placeholder="e.g. Delhi to Mumbai">
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Price (₹)</label>
            <input name="price" type="number" value="{{ old('price', $transport->price ?? '') }}" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" required placeholder="e.g. 3500">
        </div>
        
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Departure Time</label>
            <input name="departure_time" type="time" value="{{ old('departure_time', isset($transport) ? \Carbon\Carbon::parse($transport->departure_time)->format('H:i') : '') }}" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" required>
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Available Seats</label>
            <input name="available_seats" type="number" min="0" value="{{ old('available_seats', $transport->available_seats ?? '') }}" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition focus:bg-white" required placeholder="e.g. 40">
        </div>
    </div>

    <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
        <a href="{{ route('transports.index') }}" class="px-6 py-3 bg-white text-slate-700 border border-slate-200 font-bold rounded-xl hover:bg-slate-50 transition shadow-sm">
            Cancel
        </a>
        <button type="submit" class="px-8 py-3 bg-teal-600 text-white font-bold rounded-xl hover:bg-teal-700 transition shadow-sm flex items-center gap-2">
            <i class="bi bi-save"></i> Save Transport
        </button>
    </div>
</div>
