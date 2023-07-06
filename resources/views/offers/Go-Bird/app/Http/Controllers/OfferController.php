<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required',
            'type' => 'required',
            'category' => 'required',
            'price' => 'required',
            'region' => 'sometimes',
            'photos' => 'sometimes|array',
            'photos.*' => 'sometimes|image|mimes:jpeg,png|max:2048',
            'videos' => 'sometimes|array',
            'videos.*' => 'sometimes|mimetypes:video/mp4|max:20480',
        ]);

        $offer = Offer::create($validatedData);

        $this->handleFiles($request, $offer);

        return redirect()->back()->with('success', 'Offer created successfully.');
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required',
            'type' => 'required',
            'category' => 'required',
            'price' => 'required',
            'region' => 'required',
            'photos' => 'sometimes|array',
            'photos.*' => 'sometimes|image|mimes:jpeg,png|max:2048',
            'videos' => 'sometimes|array',
            'videos.*' => 'sometimes|mimetypes:video/mp4|max:20480',
        ]);

        $offer = Offer::findOrFail($id);
        $offer->update($validatedData);

        $this->handleFiles($request, $offer);

        return redirect()->back()->with('success', 'Offer updated successfully.');
    }

    public function destroy(string $id)
    {
        $offer = Offer::findOrFail($id);
        $offer->delete();

        // Additional logic for deleting files associated with the offer if needed

        return redirect()->back()->with('message', 'Offer deleted successfully.');
    }

    private function handleFiles(Request $request, Offer $offer)
    {
        // Handle photos and store them
        if ($request->hasFile('photos')) {
        $photos = [];
        foreach ($request->file('photos') as $photo) {
            $path = $photo->store('images', 'public');
            $photos[] = $path;
        }
        $offer->photos = $photos;
        }

        // Handle videos and store them
        if ($request->hasFile('videos')) {
        $videos = [];
        foreach ($request->file('videos') as $video) {
            $path = $video->store('videos', 'public');
            $videos[] = $path;
        }
        $offer->videos = $videos;
        }

        $offer->save();

    }
}

