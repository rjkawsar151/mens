@extends('layouts.admin')

@section('title', 'Carousel Images')
@section('page_title', 'Homepage Carousel Images')

@section('admin_content')
@if(session('success'))
    <div class="mb-6 p-4 bg-[#EEF7F4] text-[#006F5C] rounded-2xl text-sm font-semibold border border-[#006F5C]/20">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="mb-6 p-4 bg-[#FDF2F5] text-[#CC205C] rounded-2xl text-sm border border-[#CC205C]/20">
        <ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
@endif

@if(request()->boolean('upload_too_large'))
    <div class="mb-6 p-4 bg-[#FDF2F5] text-[#CC205C] rounded-2xl text-sm border border-[#CC205C]/20">
        The selected upload was too large. Upload up to 20MB per image and keep the total selection under 120MB.
    </div>
@endif

<!-- Upload Form -->
<div class="bg-white border border-[#EEF7F4] rounded-[24px] p-6 sm:p-8 shadow-sm space-y-6 mb-8">
    <h3 class="font-extrabold text-lg text-[#111827] border-b border-[#EEF7F4] pb-4">Add Carousel Images</h3>

    <form action="{{ url('/admin/carousel') }}" method="POST" enctype="multipart/form-data" id="carousel-upload-form">
        @csrf
        <div>
            <label class="block text-xs font-bold text-[#111827] uppercase tracking-wider mb-2">Images * (1920x700 recommended, select multiple)</label>
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed border-[#D1D5DB] rounded-2xl hover:border-[#006F5C] transition-colors cursor-pointer bg-[#F9FAFB]" onclick="document.getElementById('image-input').click()">
                <div class="space-y-2 text-center">
                    <svg class="mx-auto h-12 w-12 text-[#9CA3AF]" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <div class="text-sm text-[#6B7280]">
                        <span class="font-semibold text-[#006F5C]">Click to upload</span>
                        <span> or drag and drop</span>
                    </div>
                    <p class="text-xs text-[#9CA3AF]">JPEG, PNG, WebP, GIF up to 20MB each. Total selection under 120MB.</p>
                    <p id="file-count" class="text-xs font-bold text-[#006F5C] hidden"></p>
                    <p id="file-size-error" class="text-xs font-bold text-[#CC205C] hidden"></p>
                </div>
            </div>
            <input id="image-input" type="file" name="images[]" accept="image/*" multiple required class="hidden">
        </div>
        <div class="mt-6">
            <button type="submit" class="inline-flex items-center justify-center px-6 py-3 text-sm font-bold rounded-full text-white bg-[#006F5C] hover:bg-[#005547] shadow-md transition-all">
                Upload Images
            </button>
        </div>
    </form>
</div>

<!-- Image List -->
<div class="bg-white border border-[#EEF7F4] rounded-[24px] p-6 sm:p-8 shadow-sm space-y-6">
    <h3 class="font-extrabold text-lg text-[#111827] border-b border-[#EEF7F4] pb-4">
        Current Carousel Images ({{ count($images) }})
    </h3>

    @if(count($images) > 0)
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4" id="carousel-grid">
        @foreach($images as $img)
        <div class="bg-[#F4FAF8] border border-[#EEF7F4] rounded-[16px] overflow-hidden shadow-sm relative group">
            <div class="aspect-[16/10] overflow-hidden bg-[#EEF7F4]">
                <img src="{{ asset($img->image_path) }}" alt="{{ $img->alt_text ?? 'Carousel' }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            </div>
            <form action="{{ url('/admin/carousel/' . $img->id) }}" method="POST" class="p-3 space-y-2">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-[#6B7280] mb-1">Slide Title</label>
                    <input type="text" name="title" value="{{ old('title', $img->title) }}" placeholder="e.g. Private Physiotherapy Care" class="w-full px-3 py-2 bg-white border border-[#EEF7F4] rounded-xl text-xs focus:outline-none focus:border-[#006F5C]">
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-[#6B7280] mb-1">Slide Subtitle</label>
                    <input type="text" name="subtitle" value="{{ old('subtitle', $img->subtitle) }}" placeholder="Short supporting text for this image" class="w-full px-3 py-2 bg-white border border-[#EEF7F4] rounded-xl text-xs focus:outline-none focus:border-[#006F5C]">
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-[#6B7280] mb-1">Alt Text</label>
                    <input type="text" name="alt_text" value="{{ old('alt_text', $img->alt_text) }}" class="w-full px-3 py-2 bg-white border border-[#EEF7F4] rounded-xl text-xs focus:outline-none focus:border-[#006F5C]">
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-[#6B7280] mb-1">Link URL</label>
                    <input type="text" name="link_url" value="{{ old('link_url', $img->link_url) }}" placeholder="#booking-form or https://..." class="w-full px-3 py-2 bg-white border border-[#EEF7F4] rounded-xl text-xs focus:outline-none focus:border-[#006F5C]">
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-[#6B7280] mb-1">Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $img->sort_order) }}" min="0" class="w-full px-3 py-2 bg-white border border-[#EEF7F4] rounded-xl text-xs focus:outline-none focus:border-[#006F5C]">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-[#6B7280] mb-1">Status</label>
                        <select name="status" class="w-full px-3 py-2 bg-white border border-[#EEF7F4] rounded-xl text-xs focus:outline-none focus:border-[#006F5C]">
                            <option value="active" {{ old('status', $img->status) === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $img->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 rounded-full bg-[#006F5C] text-white hover:bg-[#005547] transition-colors text-xs font-bold">
                    Save
                </button>
            </form>
            <form action="{{ url('/admin/carousel/' . $img->id) }}" method="POST" class="px-3 pb-3" onsubmit="return confirm('Remove this carousel image?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-full bg-[#CC205C] text-white shadow-md hover:bg-[#A61A4B] transition-colors text-xs font-bold uppercase tracking-wider">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Delete Image
                </button>
            </form>
        </div>
        @endforeach
    </div>

    <p class="text-xs text-[#6B7280] pt-4 border-t border-[#EEF7F4]">
        Images display in a carousel on the homepage, auto-scrolling every 4 seconds.
    </p>
    @else
    <div class="text-center py-12">
        <p class="text-[#6B7280]">No carousel images yet. Upload some above.</p>
    </div>
    @endif
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('carousel-upload-form');
        const input = document.getElementById('image-input');
        const fileCount = document.getElementById('file-count');
        const fileSizeError = document.getElementById('file-size-error');
        if (!form || !input || !fileCount || !fileSizeError) return;

        const maxEach = 20 * 1024 * 1024;
        const maxTotal = 120 * 1024 * 1024;

        function validateFiles() {
            const files = Array.from(input.files || []);
            const total = files.reduce((sum, file) => sum + file.size, 0);
            const tooLarge = files.find((file) => file.size > maxEach);

            fileCount.textContent = files.length ? `${files.length} file(s) selected` : '';
            fileCount.classList.toggle('hidden', files.length === 0);

            if (tooLarge) {
                fileSizeError.textContent = `${tooLarge.name} is larger than 20MB.`;
            } else if (total > maxTotal) {
                fileSizeError.textContent = 'Total selected files must be under 120MB.';
            } else {
                fileSizeError.textContent = '';
            }

            fileSizeError.classList.toggle('hidden', fileSizeError.textContent === '');
            return fileSizeError.textContent === '';
        }

        input.addEventListener('change', validateFiles);
        form.addEventListener('submit', (event) => {
            if (!validateFiles()) {
                event.preventDefault();
            }
        });
    });
</script>
@endsection
