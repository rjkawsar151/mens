@extends('layouts.app')

@section('title', "Mayfair Wellness Clinic - Home")

@section('content')
@php
    $heroBackgroundImages = collect($carouselImages ?? [])->pluck('image_path')->filter()->values();
    if ($heroBackgroundImages->isEmpty() && !empty($websiteSettings->hero_image)) {
        $heroBackgroundImages = collect([$websiteSettings->hero_image]);
    }
@endphp
<!-- Hero Section -->
<section class="home-hero relative bg-[#006F5C] text-white py-24 sm:py-32 overflow-hidden rounded-b-[40px] shadow-lg">
    @if($heroBackgroundImages->isNotEmpty())
    <div class="home-hero-media absolute inset-0">
        @foreach($heroBackgroundImages as $index => $image)
        <img src="{{ asset($image) }}" alt="" class="hero-bg-slide absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}" data-index="{{ $index }}">
        @endforeach
        <div class="home-hero-overlay absolute inset-0 bg-gradient-to-r from-[#005547] to-transparent opacity-85"></div>
    </div>
    @else
    <!-- Gradient Overlay -->
    <div class="home-hero-overlay absolute inset-0 bg-gradient-to-r from-[#005547] to-transparent opacity-85"></div>
    
    <!-- Hero Image Placeholder (Confidential Consultation SVG Accent) -->
    <div class="absolute right-0 bottom-0 top-0 w-full lg:w-1/2 opacity-20 lg:opacity-30 pointer-events-none">
        <svg class="w-full h-full object-cover" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <linearGradient id="grid-grad" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" stop-color="#CC205C" />
                    <stop offset="100%" stop-color="#006F5C" />
                </linearGradient>
            </defs>
            <rect width="100" height="100" fill="url(#grid-grad)" opacity="0.1"/>
            <circle cx="50" cy="50" r="30" stroke="white" stroke-width="0.5" stroke-dasharray="2 2"/>
            <path d="M20 50 C40 20, 60 80, 80 50" stroke="white" stroke-width="1"/>
        </svg>
    </div>
    @endif

    <div class="home-hero-content max-w-7xl mx-auto px-6 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-2xl lg:max-w-xl">
            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold bg-white/10 text-white border border-white/20 mb-6 uppercase tracking-wider">
                Men's Health Services
            </span>
            <h1 id="hero-title" class="home-hero-title text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white mb-6 leading-tight min-h-[135px] sm:min-h-[180px] lg:min-h-[225px]">
                <span id="hero-title-text"></span><span id="hero-cursor" class="animate-pulse">|</span>
            </h1>
            <p class="text-lg text-white/80 mb-8 leading-relaxed">
                Mayfair Wellness Clinic provides specialized, respectful, and evidence-based physiotherapy for pelvic floor dysfunction, chronic pain, and post-surgery recovery.
            </p>
            <div class="home-hero-actions flex flex-col sm:flex-row gap-4">
                <a href="#services" class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-3.5 border border-transparent text-base font-bold rounded-full text-white bg-[#CC205C] hover:bg-[#A61A4B] shadow-md hover:shadow-lg transition-all duration-200">
                    Discover Our Services
                </a>
                <a href="#booking-form" class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-3.5 border-2 border-white text-base font-bold rounded-full text-white hover:bg-white hover:text-[#006F5C] transition-all duration-200">
                    Book Appointment
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Confidentiality Intro -->
<section class="py-16 bg-[#F4FAF8]">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 text-center">
        <h2 class="text-3xl font-extrabold text-[#111827] tracking-tight sm:text-4xl">
            Private, Respectful, & Comprehensive
        </h2>
        <p class="mt-4 text-lg text-[#6B7280] max-w-3xl mx-auto leading-relaxed">
            We understand that many men delay seeking help for pelvic, urinary, or sexual health problems due to embarrassment or discomfort. Our clinic provides a secure environment with medical specialists who deliver confidential assessment and personalized physiotherapy support to restore your comfort and confidence.
        </p>
    </div>
</section>

<!-- Services Grid -->
<section id="services" class="services-section py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#111827] tracking-tight">
                Our Mens Health Services
            </h2>
            <p class="mt-4 text-base text-[#6B7280]">
                Select a service to view specialized recovery plans, step guides, and FAQ resources.
            </p>
        </div>

        <div class="services-grid">
            @if(isset($featuredServices) && count($featuredServices) > 0)
                @foreach($featuredServices as $service)
                    @php
                        $serviceImage = $service->main_image
                            ? asset($service->main_image)
                            : ($service->image_path ? asset('storage/' . $service->image_path) : null);
                    @endphp
                    <div class="service-card flex flex-col">
                        <a href="{{ url('/services/' . $service->slug) }}" class="service-card-media block overflow-hidden bg-[#EEF7F4] group">
                            @if($serviceImage)
                                <img src="{{ $serviceImage }}" alt="{{ $service->title }}" class="transition-transform duration-500 group-hover:scale-105">
                            @else
                                <div class="w-full h-full bg-[#EEF7F4] flex items-center justify-center p-8 text-[#006F5C]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                            @endif
                        </a>
                        <div class="service-card-content flex-grow">
                            <h3 class="text-xl font-bold text-[#111827] mb-3">{{ $service->title }}</h3>
                            <p class="text-sm text-[#6B7280] leading-relaxed line-clamp-3">
                                {{ $service->short_description }}
                            </p>
                        </div>
                        <div class="px-[22px] pb-[22px] pt-0">
                            <a href="{{ url('/services/' . $service->slug) }}" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-bold rounded-full text-white bg-[#006F5C] hover:bg-[#005547] shadow-sm hover:shadow-md transition-all duration-200">
                                <span>Learn More</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Fallback card -->
                <div class="bg-white border border-[#EEF7F4] rounded-[24px] overflow-hidden shadow-sm p-8 text-center col-span-3">
                    <p class="text-[#6B7280]">No services found in database. Please run seeders.</p>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="py-20 bg-[#EEF7F4] rounded-[40px] mx-4 sm:mx-8 my-8 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <span class="text-[#006F5C] font-bold text-xs uppercase tracking-widest block mb-2">Our Advantage</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#111827] mb-6">Why Patients Trust Mayfair Clinic</h2>
                <p class="text-base text-[#6B7280] leading-relaxed mb-8">
                    We employ experienced male physiotherapists who specialize in pelvic floor health. Our treatments are supported by medical evidence and conducted in completely private, single-patient clinical suites.
                </p>
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0 w-6 h-6 rounded-full bg-[#006F5C] text-white flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-[#111827]">Strict Confidentiality</h4>
                            <p class="text-xs text-[#6B7280] mt-1">Discreet records, private suites, and personal consultation protocols.</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0 w-6 h-6 rounded-full bg-[#006F5C] text-white flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-[#111827]">Qualified Male Clinicians</h4>
                            <p class="text-xs text-[#6B7280] mt-1">Physiotherapy treatments conducted by male specialists experienced in pelvic therapy.</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0 w-6 h-6 rounded-full bg-[#006F5C] text-white flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-[#111827]">Modern Medical Tech</h4>
                            <p class="text-xs text-[#6B7280] mt-1">Advanced pelvic floor assessment tools and customized rehabilitation protocols.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Graphics Card -->
            <div class="relative bg-white border border-[#EEF7F4] rounded-[32px] p-8 shadow-md">
                <h3 class="text-lg font-bold text-[#111827] mb-6">Confidential Care Cycle</h3>
                <div class="space-y-6">
                    <div class="flex items-center space-x-4 border-b border-[#EEF7F4] pb-4">
                        <span class="text-xl font-black text-[#CC205C]">01</span>
                        <div>
                            <h4 class="font-bold text-sm text-[#111827]">Private Online Booking</h4>
                            <p class="text-xs text-[#6B7280]">Book your slot securely using our Bangladesh phone-verified scheduling form.</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4 border-b border-[#EEF7F4] pb-4">
                        <span class="text-xl font-black text-[#006F5C]">02</span>
                        <div>
                            <h4 class="font-bold text-sm text-[#111827]">Initial Diagnostic Assessment</h4>
                            <p class="text-xs text-[#6B7280]">A thorough medical evaluation in a private, supportive workspace.</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-xl font-black text-[#FF8A00]">03</span>
                        <div>
                            <h4 class="font-bold text-sm text-[#111827]">Evidence-Guided Treatment</h4>
                            <p class="text-xs text-[#6B7280]">Progressive exercises, lifestyle changes, and therapy support.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- General CTA Form Section -->
<section id="booking-form" class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <div class="bg-white border border-[#EEF7F4] rounded-[32px] p-8 sm:p-12 shadow-xl">
            <div class="text-center mb-8">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#111827]">Schedule Your Appointment</h2>
                <p class="text-sm text-[#6B7280] mt-2">All submissions are strictly confidential. We will call you within 1-2 hours.</p>
            </div>

            <!-- Validation Errors -->
            <div id="booking-errors" class="hidden mb-6 p-4 bg-[#FDF2F5] text-[#CC205C] rounded-2xl text-sm border border-[#CC205C]/20"></div>
            <!-- Success Message -->
            <div id="booking-success" class="hidden mb-6 p-4 bg-[#EEF7F4] text-[#006F5C] rounded-2xl text-sm border border-[#006F5C]/20"></div>

            <form action="{{ url('/appointments') }}" method="POST" id="main-appointment-form" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-[#111827] mb-2">Name *</label>
                        <input type="text" name="name" id="name" required class="w-full px-4 py-3 bg-[#F4FAF8] border border-[#EEF7F4] rounded-full text-sm focus:outline-none focus:border-[#006F5C] transition-colors" placeholder="e.g. Rahat Ahmed">
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-[#111827] mb-2">Phone Number *</label>
                        <input type="text" name="phone" id="phone" required class="w-full px-4 py-3 bg-[#F4FAF8] border border-[#EEF7F4] rounded-full text-sm focus:outline-none focus:border-[#006F5C] transition-colors" placeholder="e.g. 01712345678">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="email" class="block text-sm font-semibold text-[#111827] mb-2">Email Address (Optional)</label>
                        <input type="email" name="email" id="email" class="w-full px-4 py-3 bg-[#F4FAF8] border border-[#EEF7F4] rounded-full text-sm focus:outline-none focus:border-[#006F5C] transition-colors" placeholder="e.g. name@domain.com">
                    </div>
                    <div>
                        <label for="service_id" class="block text-sm font-semibold text-[#111827] mb-2">Select Treatment Service *</label>
                        <select name="service_id" id="service_id" required class="w-full px-4 py-3 bg-[#F4FAF8] border border-[#EEF7F4] rounded-full text-sm focus:outline-none focus:border-[#006F5C] transition-colors appearance-none">
                            <option value="">Choose a treatment...</option>
                            @if(isset($featuredServices))
                                @foreach($featuredServices as $serv)
                                    <option value="{{ $serv->id }}" {{ $serv->slug === 'mens-health-physiotherapy' ? 'selected' : '' }}>{{ $serv->title }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="preferred_date" class="block text-sm font-semibold text-[#111827] mb-2">Preferred Date *</label>
                        <input type="date" name="preferred_date" id="preferred_date" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" value="{{ date('Y-m-d', strtotime('+1 day')) }}" class="w-full px-4 py-3 bg-[#F4FAF8] border border-[#EEF7F4] rounded-full text-sm focus:outline-none focus:border-[#006F5C] transition-colors">
                    </div>
                    <div>
                        <label for="preferred_time" class="block text-sm font-semibold text-[#111827] mb-2">Preferred Time *</label>
                        <select name="preferred_time" id="preferred_time" required class="w-full px-4 py-3 bg-[#F4FAF8] border border-[#EEF7F4] rounded-full text-sm focus:outline-none focus:border-[#006F5C] transition-colors appearance-none">
                            <option value="10:00 AM">10:00 AM</option>
                            <option value="11:00 AM">11:00 AM</option>
                            <option value="12:00 PM">12:00 PM</option>
                            <option value="03:00 PM">03:00 PM</option>
                            <option value="04:00 PM">04:00 PM</option>
                            <option value="05:00 PM">05:00 PM</option>
                            <option value="06:00 PM">06:00 PM</option>
                            <option value="07:00 PM">07:00 PM</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="note" class="block text-sm font-semibold text-[#111827] mb-2">Brief Message / Symptoms (Optional)</label>
                    <textarea name="note" id="note" rows="3" class="w-full px-5 py-4 bg-[#F4FAF8] border border-[#EEF7F4] rounded-3xl text-sm focus:outline-none focus:border-[#006F5C] transition-colors" placeholder="Describe your situation in a few words..."></textarea>
                </div>

                <div class="text-center pt-4">
                    <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3.5 border border-transparent text-sm font-bold rounded-full text-white bg-[#006F5C] hover:bg-[#005547] shadow-md hover:shadow-lg transition-all duration-200">
                        Confirm Appointment Booking
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Appointment Script -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('main-appointment-form');
        const errorsDiv = document.getElementById('booking-errors');
        const successDiv = document.getElementById('booking-success');

        if (form) {
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                errorsDiv.classList.add('hidden');
                successDiv.classList.add('hidden');

                const formData = new FormData(form);
                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    const data = await response.json();
                    if (response.ok) {
                        successDiv.textContent = data.message || 'Appointment requested successfully!';
                        successDiv.classList.remove('hidden');
                        form.reset();
                    } else {
                        let errMsg = data.message || 'Something went wrong.';
                        if (data.errors) {
                            const firstErrKey = Object.keys(data.errors)[0];
                            errMsg = data.errors[firstErrKey][0];
                        }
                        errorsDiv.textContent = errMsg;
                        errorsDiv.classList.remove('hidden');
                    }
                } catch (err) {
                    errorsDiv.textContent = 'Server connection error. Please try again.';
                    errorsDiv.classList.remove('hidden');
                }
            });
        }
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const heroSlides = document.querySelectorAll('.hero-bg-slide');
    if (heroSlides.length > 1) {
        let currentSlide = 0;
        setInterval(() => {
            heroSlides[currentSlide].classList.remove('opacity-100');
            heroSlides[currentSlide].classList.add('opacity-0');
            currentSlide = (currentSlide + 1) % heroSlides.length;
            heroSlides[currentSlide].classList.remove('opacity-0');
            heroSlides[currentSlide].classList.add('opacity-100');
        }, 3500);
    }

    const textEl = document.getElementById('hero-title-text');
    const cursorEl = document.getElementById('hero-cursor');
    if (!textEl) return;

    const text = "Confidential & Professional Men's Care";
    let i = 0;
    const speed = 60;

    function type() {
        if (i < text.length) {
            textEl.textContent += text.charAt(i);
            i++;
            setTimeout(type, speed);
        } else {
            if (cursorEl) cursorEl.style.animation = 'pulse 1s infinite';
        }
    }

    setTimeout(type, 400);
});
</script>
@endsection
