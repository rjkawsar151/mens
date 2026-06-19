<?php

namespace App\Http\Controllers;

use App\Models\CarouselImage;
use App\Models\Service;
use App\Models\Faq;
use App\Models\HomepageHero;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function index()
    {
        $featuredServices = Service::where('status', 'active')
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        $homepageFaqs = Faq::whereNull('service_id')
            ->where('status', 'active')
            ->orderBy('sort_order')
            ->get();

        $carouselImages = CarouselImage::where('status', 'active')
            ->orderBy('sort_order')
            ->get();

        $homepageHero = Schema::hasTable('homepage_heroes')
            ? HomepageHero::where('status', 'active')->orderBy('sort_order')->first()
            : null;

        return view('home', compact('featuredServices', 'homepageFaqs', 'carouselImages', 'homepageHero'));
    }
}
