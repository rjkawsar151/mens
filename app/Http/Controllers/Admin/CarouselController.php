<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarouselImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CarouselController extends Controller
{
    public function index()
    {
        $images = CarouselImage::orderBy('sort_order')->orderByDesc('id')->get();
        return view('admin.carousel', compact('images'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:20480',
        ]);

        if (!File::isDirectory(public_path('uploads/carousel'))) {
            File::makeDirectory(public_path('uploads/carousel'), 0755, true);
        }

        $maxOrder = CarouselImage::max('sort_order') ?? 0;

        foreach ($request->file('images') as $i => $file) {
            $fileName = 'carousel_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/carousel'), $fileName);

            CarouselImage::create([
                'image_path' => 'uploads/carousel/' . $fileName,
                'title' => null,
                'subtitle' => null,
                'alt_text' => null,
                'link_url' => null,
                'sort_order' => $maxOrder + $i + 1,
                'status' => 'active',
            ]);
        }

        $count = count($request->file('images'));
        return back()->with('success', "$count carousel image(s) added successfully.");
    }

    public function update(Request $request, $id)
    {
        $image = CarouselImage::findOrFail($id);

        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'alt_text' => 'nullable|string|max:255',
            'link_url' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        $image->update([
            'title' => $data['title'] ?? null,
            'subtitle' => $data['subtitle'] ?? null,
            'alt_text' => $data['alt_text'] ?? null,
            'link_url' => $data['link_url'] ?? null,
            'sort_order' => $data['sort_order'] ?? 0,
            'status' => $data['status'],
        ]);

        return back()->with('success', 'Carousel image settings updated.');
    }

    public function destroy($id)
    {
        $image = CarouselImage::findOrFail($id);
        if (File::exists(public_path($image->image_path))) {
            File::delete(public_path($image->image_path));
        }
        $image->delete();

        return back()->with('success', 'Carousel image removed.');
    }
}
