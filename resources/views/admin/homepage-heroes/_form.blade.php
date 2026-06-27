@csrf
@if($method !== 'POST')
    @method($method)
@endif

@if($errors->any())
    <div class="mb-6 p-4 bg-[#FDF2F5] text-[#CC205C] rounded-2xl text-sm border border-[#CC205C]/20">
        <ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
@endif

<div class="bg-white border border-[#EEF7F4] rounded-[24px] p-8 shadow-sm space-y-6">
    <h3 class="font-extrabold text-lg text-[#111827] border-b border-[#EEF7F4] pb-4">Hero Content</h3>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div>
            <label class="block text-xs font-bold text-[#111827] uppercase tracking-wider mb-2">Badge Text *</label>
            <input type="text" name="badge_text" value="{{ old('badge_text', $hero->badge_text) }}" required class="w-full px-4 py-3 bg-[#F4FAF8] border border-[#EEF7F4] rounded-2xl text-sm focus:outline-none focus:border-[#006F5C] transition-colors">
        </div>
        <div>
            <label class="block text-xs font-bold text-[#111827] uppercase tracking-wider mb-2">Second Title Line</label>
            <input type="text" name="highlighted_title_text" value="{{ old('highlighted_title_text', $hero->highlighted_title_text) }}" class="w-full px-4 py-3 bg-[#F4FAF8] border border-[#EEF7F4] rounded-2xl text-sm focus:outline-none focus:border-[#006F5C] transition-colors">
        </div>
    </div>

    <div>
        <label class="block text-xs font-bold text-[#111827] uppercase tracking-wider mb-2">Main Title / First Title Line *</label>
        <input type="text" name="main_title" value="{{ old('main_title', $hero->main_title) }}" required class="w-full px-4 py-3 bg-[#F4FAF8] border border-[#EEF7F4] rounded-2xl text-sm focus:outline-none focus:border-[#006F5C] transition-colors">
    </div>

    <div>
        <label class="block text-xs font-bold text-[#111827] uppercase tracking-wider mb-2">Description *</label>
        <textarea name="description" rows="4" required class="w-full px-4 py-3 bg-[#F4FAF8] border border-[#EEF7F4] rounded-2xl text-sm focus:outline-none focus:border-[#006F5C] transition-colors">{{ old('description', $hero->description) }}</textarea>
    </div>
</div>

<div class="bg-white border border-[#EEF7F4] rounded-[24px] p-8 shadow-sm space-y-6">
    <h3 class="font-extrabold text-lg text-[#111827] border-b border-[#EEF7F4] pb-4">Buttons & Stats</h3>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div>
            <label class="block text-xs font-bold text-[#111827] uppercase tracking-wider mb-2">Discover Button Text *</label>
            <input type="text" name="primary_button_text" value="{{ old('primary_button_text', $hero->primary_button_text) }}" required class="w-full px-4 py-3 bg-[#F4FAF8] border border-[#EEF7F4] rounded-2xl text-sm focus:outline-none focus:border-[#006F5C] transition-colors">
        </div>
        <div>
            <label class="block text-xs font-bold text-[#111827] uppercase tracking-wider mb-2">Discover Button Link *</label>
            <input type="text" name="primary_button_link" value="{{ old('primary_button_link', $hero->primary_button_link) }}" required class="w-full px-4 py-3 bg-[#F4FAF8] border border-[#EEF7F4] rounded-2xl text-sm focus:outline-none focus:border-[#006F5C] transition-colors">
            <p class="text-xs text-[#6B7280] mt-1">Use #services or #booking-form for same-page sections. /explore and /open redirect to services.</p>
        </div>
        <div>
            <label class="block text-xs font-bold text-[#111827] uppercase tracking-wider mb-2">Secondary Button 1 Text *</label>
            <input type="text" name="secondary_button_1_text" value="{{ old('secondary_button_1_text', $hero->secondary_button_1_text) }}" required class="w-full px-4 py-3 bg-[#F4FAF8] border border-[#EEF7F4] rounded-2xl text-sm focus:outline-none focus:border-[#006F5C] transition-colors">
        </div>
        <div>
            <label class="block text-xs font-bold text-[#111827] uppercase tracking-wider mb-2">Secondary Button 1 Link *</label>
            <input type="text" name="secondary_button_1_link" value="{{ old('secondary_button_1_link', $hero->secondary_button_1_link) }}" required class="w-full px-4 py-3 bg-[#F4FAF8] border border-[#EEF7F4] rounded-2xl text-sm focus:outline-none focus:border-[#006F5C] transition-colors">
        </div>
        <div>
            <label class="block text-xs font-bold text-[#111827] uppercase tracking-wider mb-2">Secondary Button 2 Text</label>
            <input type="text" name="secondary_button_2_text" value="{{ old('secondary_button_2_text', $hero->secondary_button_2_text) }}" class="w-full px-4 py-3 bg-[#F4FAF8] border border-[#EEF7F4] rounded-2xl text-sm focus:outline-none focus:border-[#006F5C] transition-colors">
        </div>
        <div>
            <label class="block text-xs font-bold text-[#111827] uppercase tracking-wider mb-2">Secondary Button 2 Link</label>
            <input type="text" name="secondary_button_2_link" value="{{ old('secondary_button_2_link', $hero->secondary_button_2_link) }}" class="w-full px-4 py-3 bg-[#F4FAF8] border border-[#EEF7F4] rounded-2xl text-sm focus:outline-none focus:border-[#006F5C] transition-colors">
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div>
            <label class="block text-xs font-bold text-[#111827] uppercase tracking-wider mb-2">Stats Card Number *</label>
            <input type="text" name="happy_patients_number" value="{{ old('happy_patients_number', $hero->happy_patients_number) }}" required class="w-full px-4 py-3 bg-[#F4FAF8] border border-[#EEF7F4] rounded-2xl text-sm focus:outline-none focus:border-[#006F5C] transition-colors">
        </div>
        <div>
            <label class="block text-xs font-bold text-[#111827] uppercase tracking-wider mb-2">Satisfaction Number *</label>
            <input type="text" name="services_number" value="{{ old('services_number', $hero->services_number) }}" required class="w-full px-4 py-3 bg-[#F4FAF8] border border-[#EEF7F4] rounded-2xl text-sm focus:outline-none focus:border-[#006F5C] transition-colors">
        </div>
        <div>
            <label class="block text-xs font-bold text-[#111827] uppercase tracking-wider mb-2">Satisfaction Label *</label>
            <input type="text" name="years_of_excellence_number" value="{{ old('years_of_excellence_number', $hero->years_of_excellence_number) }}" required class="w-full px-4 py-3 bg-[#F4FAF8] border border-[#EEF7F4] rounded-2xl text-sm focus:outline-none focus:border-[#006F5C] transition-colors">
        </div>
    </div>
</div>

<div class="bg-white border border-[#EEF7F4] rounded-[24px] p-8 shadow-sm space-y-6">
    <h3 class="font-extrabold text-lg text-[#111827] border-b border-[#EEF7F4] pb-4">Visual Card</h3>

    @if($hero->hero_image)
        <div class="flex items-center space-x-4">
            <img src="{{ asset($hero->hero_image) }}" alt="Hero" class="h-24 w-36 object-cover border border-[#EEF7F4] rounded-xl p-1">
            <span class="text-xs text-[#6B7280]">Current hero image. Upload a new image to replace it.</span>
        </div>
    @endif

    <div>
        <label class="block text-xs font-bold text-[#111827] uppercase tracking-wider mb-2">Hero Image</label>
        <input type="file" name="hero_image" accept="image/*" class="block w-full text-sm text-[#6B7280] file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-[#EEF7F4] file:text-[#006F5C] hover:file:bg-[#006F5C] hover:file:text-white transition-all">
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div>
            <label class="block text-xs font-bold text-[#111827] uppercase tracking-wider mb-2">Rating Number *</label>
            <input type="text" name="floating_rating_text" value="{{ old('floating_rating_text', $hero->floating_rating_text) }}" required class="w-full px-4 py-3 bg-[#F4FAF8] border border-[#EEF7F4] rounded-2xl text-sm focus:outline-none focus:border-[#006F5C] transition-colors">
        </div>
        <div>
            <label class="block text-xs font-bold text-[#111827] uppercase tracking-wider mb-2">Rating Count Label *</label>
            <input type="text" name="floating_rating_label" value="{{ old('floating_rating_label', $hero->floating_rating_label) }}" required class="w-full px-4 py-3 bg-[#F4FAF8] border border-[#EEF7F4] rounded-2xl text-sm focus:outline-none focus:border-[#006F5C] transition-colors">
        </div>
        <div>
            <label class="block text-xs font-bold text-[#111827] uppercase tracking-wider mb-2">Stats Card Text *</label>
            <input type="text" name="floating_service_card_title" value="{{ old('floating_service_card_title', $hero->floating_service_card_title) }}" required class="w-full px-4 py-3 bg-[#F4FAF8] border border-[#EEF7F4] rounded-2xl text-sm focus:outline-none focus:border-[#006F5C] transition-colors">
        </div>
        <div>
            <label class="block text-xs font-bold text-[#111827] uppercase tracking-wider mb-2">Doctor Team Text *</label>
            <input type="text" name="floating_service_card_subtitle" value="{{ old('floating_service_card_subtitle', $hero->floating_service_card_subtitle) }}" required class="w-full px-4 py-3 bg-[#F4FAF8] border border-[#EEF7F4] rounded-2xl text-sm focus:outline-none focus:border-[#006F5C] transition-colors">
        </div>
    </div>

    <div>
        <label class="block text-xs font-bold text-[#111827] uppercase tracking-wider mb-2">Floating Service List</label>
        <textarea name="floating_service_list" rows="5" class="w-full px-4 py-3 bg-[#F4FAF8] border border-[#EEF7F4] rounded-2xl text-sm focus:outline-none focus:border-[#006F5C] transition-colors">{{ old('floating_service_list', $hero->floating_service_list) }}</textarea>
        <p class="text-xs text-[#6B7280] mt-1">Add one service per line.</p>
    </div>
</div>

<div class="bg-white border border-[#EEF7F4] rounded-[24px] p-8 shadow-sm space-y-6">
    <h3 class="font-extrabold text-lg text-[#111827] border-b border-[#EEF7F4] pb-4">Publishing</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div>
            <label class="block text-xs font-bold text-[#111827] uppercase tracking-wider mb-2">Status *</label>
            <select name="status" required class="w-full px-4 py-3 bg-[#F4FAF8] border border-[#EEF7F4] rounded-2xl text-sm focus:outline-none focus:border-[#006F5C] transition-colors appearance-none">
                <option value="active" {{ old('status', $hero->status) === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', $hero->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <div>
            <label class="block text-xs font-bold text-[#111827] uppercase tracking-wider mb-2">Sort Order</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $hero->sort_order ?? 0) }}" class="w-full px-4 py-3 bg-[#F4FAF8] border border-[#EEF7F4] rounded-2xl text-sm focus:outline-none focus:border-[#006F5C] transition-colors">
        </div>
    </div>
</div>

<div class="flex space-x-4">
    <button type="submit" class="inline-flex items-center justify-center px-8 py-3.5 text-sm font-bold rounded-full text-white bg-[#006F5C] hover:bg-[#005547] shadow-md transition-all">
        Save Homepage Hero
    </button>
    <a href="{{ url('/admin/homepage-heroes') }}" class="inline-flex items-center justify-center px-8 py-3.5 text-sm font-bold rounded-full text-[#6B7280] bg-white border border-[#EEF7F4] hover:bg-[#F4FAF8] transition-all">
        Cancel
    </a>
</div>
