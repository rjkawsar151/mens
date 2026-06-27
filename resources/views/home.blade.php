@extends('layouts.app')

@section('title', "Mayfair Wellness Clinic - Home")

@section('content')
@php
    $heroBackgroundImages = collect($carouselImages ?? [])->pluck('image_path')->filter()->values();
    if ($heroBackgroundImages->isEmpty() && !empty($websiteSettings->hero_image)) {
        $heroBackgroundImages = collect([$websiteSettings->hero_image]);
    }
    $heroDefaults = (object) [
        'badge_text' => 'MENS HEALTH SERVICES',
        'main_title' => 'CONFIDENTIAL & PROFESSIONAL',
        'highlighted_title_text' => 'MENS CARE',
        'description' => 'Mayfair Wellness Clinic provides specialized, respectful, and evidence-based physiotherapy for pelvic floor dysfunction, chronic pain, and post-surgery recovery.',
        'primary_button_text' => 'Book Appointment',
        'primary_button_link' => '#booking-form',
        'secondary_button_1_text' => 'Our Services',
        'secondary_button_1_link' => '#services',
        'secondary_button_2_text' => 'Offers',
        'secondary_button_2_link' => '#services',
        'happy_patients_number' => '3500+',
        'services_number' => '100+',
        'years_of_excellence_number' => 'Happy Patients',
        'hero_image' => null,
        'floating_rating_text' => '5.0 / 5',
        'floating_rating_label' => 'TOP RATED',
        'floating_service_card_title' => 'Successful Treatments',
        'floating_service_card_subtitle' => 'Premium Mens Health Care',
        'floating_service_list' => "Focused Shockwave Therapy\nPelvic Floor Physiotherapy\nChronic Pain Management",
    ];
    $hero = $homepageHero ?? $heroDefaults;
    $heroImage = $hero->hero_image ?: $heroBackgroundImages->first();
    $floatingServices = collect($hero->floating_services ?? preg_split('/\r\n|\r|\n/', (string) $hero->floating_service_list))
        ->map(fn($item) => trim($item))
        ->filter()
        ->values();
    $heroTitle = trim($hero->main_title ?: $heroDefaults->main_title);
    $highlightText = trim($hero->highlighted_title_text ?: $heroDefaults->highlighted_title_text);
    if (preg_match('/confidential\s*&\s*professional\s+mens\s+care/i', $heroTitle)) {
        $heroTitle = 'CONFIDENTIAL & PROFESSIONAL';
        $highlightText = 'MENS CARE';
    } elseif ($highlightText !== '' && str_contains(strtolower($heroTitle), strtolower($highlightText))) {
        $highlightText = '';
    }
    $heroTitle = preg_replace('/\s*&\s*/', ' & ', strtoupper($heroTitle));
    $highlightText = strtoupper($highlightText);
    $heroTitleLines = str_contains($heroTitle, ' & ')
        ? [str_replace(' &', ' &', explode(' & ', $heroTitle, 2)[0] . ' &'), explode(' & ', $heroTitle, 2)[1]]
        : [$heroTitle];
    $resolveHeroLink = function ($link, $fallback = '#services') {
        $link = trim((string) $link);
        if ($link === '') {
            return $fallback;
        }
        if (str_starts_with($link, '#') || str_starts_with($link, 'http://') || str_starts_with($link, 'https://') || str_starts_with($link, 'tel:') || str_starts_with($link, 'mailto:')) {
            return $link;
        }
        return url('/' . ltrim($link, '/'));
    };
    $primaryButtonLink = $resolveHeroLink($hero->primary_button_link, '#services');
    $ratingText = trim($hero->floating_rating_text ?: $heroDefaults->floating_rating_text);
    $ratingLabel = trim($hero->floating_rating_label ?: $heroDefaults->floating_rating_label);
    $ratingDisplay = trim($ratingText . ' ' . $ratingLabel);
    $statsInlineNumber = trim($hero->services_number ?: $heroDefaults->services_number);
    $statsInlineLabel = trim($hero->years_of_excellence_number ?: $heroDefaults->years_of_excellence_number);
    if (preg_match('/^\d+\+?$/', $statsInlineLabel)) {
        $statsInlineLabel = $heroDefaults->years_of_excellence_number;
    }
    $statsCardTitle = trim($hero->floating_service_card_title ?: $heroDefaults->floating_service_card_title);
    if (strcasecmp($statsCardTitle, 'Mayfair Wellness Clinic') === 0 || str_contains(strtolower($statsCardTitle), 'cured satisfied')) {
        $statsCardTitle = $heroDefaults->floating_service_card_title;
    }
    $statsCardSubtitle = trim($hero->floating_service_card_subtitle ?: $heroDefaults->floating_service_card_subtitle);
    if (strcasecmp($statsCardSubtitle, 'Premium Care') === 0 || str_contains(strtolower($statsCardSubtitle), 'team of highly')) {
        $statsCardSubtitle = $heroDefaults->floating_service_card_subtitle;
    }
    $statsCardNumber = trim($hero->happy_patients_number ?: $heroDefaults->happy_patients_number);
    if (in_array(strtolower($statsCardNumber), ['500+', '15k+', '15k'], true)) {
        $statsCardNumber = $heroDefaults->happy_patients_number;
    }
    preg_match('/^(\d+)(.*)$/', $statsCardNumber, $statsNumberParts);
    $statsCardTarget = $statsNumberParts[1] ?? preg_replace('/\D+/', '', $heroDefaults->happy_patients_number);
    $statsCardSuffix = $statsNumberParts[2] ?? '+';
    $sealText = strtoupper($websiteSettings->site_name ?? 'MAYFAIR WELLNESS CLINIC');
@endphp
<!-- Hero Section -->
<section class="home-hero premium-home-hero">
    <div class="premium-home-hero-inner">
        <div class="premium-hero-copy">
            <span class="premium-hero-badge">
                <svg aria-hidden="true" viewBox="0 0 24 24">
                    <path d="M12 3.75a8.25 8.25 0 1 0 0 16.5 8.25 8.25 0 0 0 0-16.5Zm.75 4.5v3h3v1.5h-3v3h-1.5v-3h-3v-1.5h3v-3h1.5Z" />
                </svg>
                {{ $hero->badge_text ?: $heroDefaults->badge_text }}
            </span>
            <h1 id="hero-title" class="premium-hero-title">
                @foreach($heroTitleLines as $line)
                    @if($loop->first)
                        {{ $line }}
                    @else
                        <span>{{ $line }}</span>
                    @endif
                @endforeach
                @if($highlightText)
                    <span>{{ $highlightText }}</span>
                @endif
            </h1>
            <p class="premium-hero-description">{{ $hero->description ?: $heroDefaults->description }}</p>

            <div class="premium-hero-actions">
                <a href="{{ $primaryButtonLink }}" class="premium-hero-primary">
                    <span class="premium-hero-arrow" aria-hidden="true">
                        <svg viewBox="0 0 24 24">
                            <path d="M7 17 17 7M9 7h8v8" />
                        </svg>
                    </span>
                    {{ $hero->primary_button_text ?: $heroDefaults->primary_button_text }}
                </a>
                <div class="premium-hero-rating-block" aria-label="Rated {{ $ratingDisplay }}">
                    <div class="premium-hero-stars" aria-hidden="true">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                    <strong>{{ $ratingDisplay }}</strong>
                </div>
                <div class="premium-hero-happy-block">
                    <strong>{{ $statsInlineNumber }}</strong>
                    <span>{{ $statsInlineLabel }}</span>
                </div>
            </div>

            <div class="premium-hero-stats-card">
                <div class="premium-hero-stats-number" data-count-target="{{ $statsCardTarget }}" data-count-suffix="{{ $statsCardSuffix }}">{{ $statsCardNumber }}</div>
                <p>{{ $statsCardTitle }}</p>
                <div class="premium-hero-doctors">
                    <div class="premium-hero-avatars" aria-hidden="true">
                        <span>DR</span>
                        <span>PT</span>
                        <span>MW</span>
                    </div>
                    <span>{{ $statsCardSubtitle }}</span>
                </div>
            </div>
        </div>

        <div class="premium-hero-visual">
            <div class="premium-hero-circle" aria-hidden="true"></div>
            <div class="premium-hero-brand-seal" aria-label="Mayfair Wellness Clinic">
                <svg viewBox="0 0 140 140" aria-hidden="true">
                    <defs>
                        <path id="mayfair-seal-path" d="M70 70 m -50 0 a 50 50 0 1 1 100 0 a 50 50 0 1 1 -100 0" />
                    </defs>
                    <text>
                        <textPath href="#mayfair-seal-path" startOffset="50%" text-anchor="middle">{{ $sealText }}</textPath>
                    </text>
                </svg>
                <span>MWC</span>
            </div>
            <div class="premium-hero-doctor">
                @if($heroImage)
                    <img src="{{ asset($heroImage) }}" alt="Mayfair Wellness Clinic doctor">
                @else
                    <div class="premium-hero-image-fallback">
                        <span>Mayfair Wellness Clinic</span>
                    </div>
                @endif
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

@if(isset($carouselImages) && count($carouselImages) > 0)
<!-- Wellness Carousel -->
<section class="wellness-carousel-section">
    <div class="wellness-carousel-shell" data-wellness-carousel aria-label="Mayfair Wellness Clinic highlights">
        <div class="wellness-carousel-track">
            @foreach($carouselImages as $slide)
                @php
                    $slideHref = trim((string) ($slide->link_url ?? ''));
                    $isLinked = filled($slideHref);
                    $slideUrl = $isLinked && !str_starts_with($slideHref, '#') && !str_starts_with($slideHref, 'http')
                        ? url('/' . ltrim($slideHref, '/'))
                        : $slideHref;
                    $slideTitle = trim((string) ($slide->title ?? ''));
                    $slideSubtitle = trim((string) ($slide->subtitle ?? ''));
                @endphp
                <div class="wellness-carousel-slide">
                    @if($isLinked)
                        <a href="{{ $slideUrl }}">
                            <img src="{{ asset($slide->image_path) }}" alt="{{ $slide->alt_text ?: 'Mayfair Wellness Clinic' }}">
                            @if($slideTitle || $slideSubtitle)
                                <span class="wellness-carousel-caption">
                                    @if($slideTitle)
                                        <strong>{{ $slideTitle }}</strong>
                                    @endif
                                    @if($slideSubtitle)
                                        <span>{{ $slideSubtitle }}</span>
                                    @endif
                                </span>
                            @endif
                        </a>
                    @else
                        <img src="{{ asset($slide->image_path) }}" alt="{{ $slide->alt_text ?: 'Mayfair Wellness Clinic' }}">
                        @if($slideTitle || $slideSubtitle)
                            <div class="wellness-carousel-caption">
                                @if($slideTitle)
                                    <strong>{{ $slideTitle }}</strong>
                                @endif
                                @if($slideSubtitle)
                                    <span>{{ $slideSubtitle }}</span>
                                @endif
                            </div>
                        @endif
                    @endif
                </div>
            @endforeach
        </div>
        <div class="wellness-carousel-dots" aria-label="Carousel position">
            @foreach($carouselImages as $index => $slide)
                <button type="button" class="{{ $index === 0 ? 'is-active' : '' }}" data-carousel-dot="{{ $index }}" aria-label="Show slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
    </div>
</section>
@if(count($carouselImages) > 1)
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const carousel = document.querySelector('[data-wellness-carousel]');
        if (!carousel) return;

        const track = carousel.querySelector('.wellness-carousel-track');
        const slides = Array.from(carousel.querySelectorAll('.wellness-carousel-slide'));
        const dots = Array.from(carousel.querySelectorAll('[data-carousel-dot]'));
        if (!track || slides.length < 2) return;

        let index = 0;
        let timer = null;

        const goTo = (nextIndex) => {
            index = (nextIndex + slides.length) % slides.length;
            track.style.transform = `translateX(-${index * 100}%)`;
            dots.forEach((dot, dotIndex) => {
                dot.classList.toggle('is-active', dotIndex === index);
            });
        };

        const start = () => {
            timer = window.setInterval(() => goTo(index + 1), 4000);
        };

        const restart = () => {
            if (timer) window.clearInterval(timer);
            start();
        };

        dots.forEach((dot) => {
            dot.addEventListener('click', () => {
                goTo(Number(dot.dataset.carouselDot));
                restart();
            });
        });

        carousel.addEventListener('mouseenter', () => {
            if (timer) window.clearInterval(timer);
        });
        carousel.addEventListener('mouseleave', start);
        start();
    });
</script>
@endif
@endif

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
                        $serviceHref = filled($service->slug)
                            ? url('/services/' . $service->slug)
                            : '#services';
                    @endphp
                    <div class="service-card flex flex-col">
                        <a href="{{ $serviceHref }}" class="service-card-media block overflow-hidden bg-[#EEF7F4] group">
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
                            <a href="{{ $serviceHref }}" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-bold rounded-full text-white bg-[#006F5C] hover:bg-[#005547] shadow-sm hover:shadow-md transition-all duration-200">
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
                            <option value="11:00 AM">11:00 AM</option>
                            <option value="12:00 PM">12:00 PM</option>
                            <option value="01:00 PM">01:00 PM</option>
                            <option value="02:00 PM">02:00 PM</option>
                            <option value="03:00 PM">03:00 PM</option>
                            <option value="04:00 PM">04:00 PM</option>
                            <option value="05:00 PM">05:00 PM</option>
                            <option value="06:00 PM">06:00 PM</option>
                            <option value="07:00 PM">07:00 PM</option>
                            <option value="08:00 PM">08:00 PM</option>
                            <option value="09:00 PM">09:00 PM</option>
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
        document.querySelectorAll('[data-count-target]').forEach((counter) => {
            const target = Number(counter.dataset.countTarget || 0);
            const suffix = counter.dataset.countSuffix || '';
            const duration = 1300;
            const startTime = performance.now();

            const animate = (now) => {
                const progress = Math.min((now - startTime) / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 3);
                counter.textContent = `${Math.round(target * eased).toLocaleString()}${suffix}`;

                if (progress < 1) {
                    requestAnimationFrame(animate);
                }
            };

            counter.textContent = `0${suffix}`;
            requestAnimationFrame(animate);
        });

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

@endsection
