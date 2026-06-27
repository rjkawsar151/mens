<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageHero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomepageHeroController extends Controller
{
    public function index()
    {
        $heroes = HomepageHero::orderBy('sort_order')->orderByDesc('id')->get();

        return view('admin.homepage-heroes.index', compact('heroes'));
    }

    public function create()
    {
        $hero = new HomepageHero([
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
            'floating_rating_text' => '5.0 / 5',
            'floating_rating_label' => 'TOP RATED',
            'floating_service_card_title' => 'Successful Treatments',
            'floating_service_card_subtitle' => 'Premium Mens Health Care',
            'floating_service_list' => "Focused Shockwave Therapy\nPelvic Floor Physiotherapy\nChronic Pain Management",
            'status' => 'active',
            'sort_order' => 0,
        ]);

        return view('admin.homepage-heroes.create', compact('hero'));
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['hero_image'] = $this->uploadHeroImage($request);

        $hero = HomepageHero::create($data);
        $this->enforceSingleActiveHero($hero);

        return redirect('/admin/homepage-heroes')->with('success', 'Homepage hero created successfully.');
    }

    public function edit(HomepageHero $homepageHero)
    {
        return view('admin.homepage-heroes.edit', ['hero' => $homepageHero]);
    }

    public function update(Request $request, HomepageHero $homepageHero)
    {
        $data = $this->validatedData($request);
        $uploadedImage = $this->uploadHeroImage($request);
        if ($uploadedImage) {
            $data['hero_image'] = $uploadedImage;
        }

        $homepageHero->update($data);
        $this->enforceSingleActiveHero($homepageHero);

        return redirect('/admin/homepage-heroes')->with('success', 'Homepage hero updated successfully.');
    }

    public function destroy(HomepageHero $homepageHero)
    {
        $homepageHero->delete();

        return redirect('/admin/homepage-heroes')->with('success', 'Homepage hero deleted successfully.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'badge_text' => 'required|string|max:255',
            'main_title' => 'required|string|max:255',
            'highlighted_title_text' => 'nullable|string|max:255',
            'description' => 'required|string',
            'primary_button_text' => 'required|string|max:255',
            'primary_button_link' => 'required|string|max:255',
            'secondary_button_1_text' => 'required|string|max:255',
            'secondary_button_1_link' => 'required|string|max:255',
            'secondary_button_2_text' => 'nullable|string|max:255',
            'secondary_button_2_link' => 'nullable|string|max:255',
            'happy_patients_number' => 'required|string|max:50',
            'services_number' => 'required|string|max:50',
            'years_of_excellence_number' => 'required|string|max:50',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'floating_rating_text' => 'required|string|max:50',
            'floating_rating_label' => 'required|string|max:50',
            'floating_service_card_title' => 'required|string|max:255',
            'floating_service_card_subtitle' => 'required|string|max:255',
            'floating_service_list' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer',
        ]);
    }

    private function uploadHeroImage(Request $request): ?string
    {
        if (! $request->hasFile('hero_image')) {
            return null;
        }

        if (! File::isDirectory(public_path('uploads/homepage-heroes'))) {
            File::makeDirectory(public_path('uploads/homepage-heroes'), 0755, true);
        }

        $file = $request->file('hero_image');
        $fileName = 'hero_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/homepage-heroes'), $fileName);

        return 'uploads/homepage-heroes/' . $fileName;
    }

    private function enforceSingleActiveHero(HomepageHero $hero): void
    {
        if ($hero->status !== 'active') {
            return;
        }

        HomepageHero::where('id', '!=', $hero->id)->update(['status' => 'inactive']);
    }
}
