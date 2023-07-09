<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class OfferController extends Controller
{
    public function index()
    {
        $offersQuery = Offer::query();
        $offers =  $offersQuery->paginate(16);

        if (Auth::check() && Auth::user()->host) {
            $hostId = Auth::user()->host->id;
            $offers->whereNotIn('host_id', [$hostId]);
        }
                
        return view('welcome', [
            'offers' => $offers
        ]);
    }


    public function detail($id)
    {
        $offer = Offer::findOrFail($id);
        $user = $offer->host->user;
        return view('offers.offer-details', [
            'offer' => $offer,
            'user' => $user,
        ]);    
    }
    
    public function create()
    {
        return view('offers.create-form-offer');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'type' => 'required',
            'category' => 'required',
            'city' => 'required',
            'country' => 'required',
            'region' => 'nullable',
            'address' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'videos.*' => 'nullable|mimes:mp4,avi,mov,wmv|max:20480',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validation passed, create and save the offer
        $offer = new Offer($request->all());
        // Perform any additional data manipulation if needed

        // Handle photo uploads
        if ($request->hasFile('photos')) {
            $photos = [];
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('photos');
                $photos[] = Storage::url($path);
            }
            $offer->photos = $photos;
        }

        // Handle video uploads
        if ($request->hasFile('videos')) {
            $videos = [];
            foreach ($request->file('videos') as $video) {
                $path = $video->store('videos');
                $videos[] = Storage::url($path);
            }
            $offer->videos = $videos;
        }

        $offer->save();

        return redirect()->route('offers.index')->with('success', 'Offer created successfully.');
    }


    public function edit(Offer $offer)
    {
        return view('offers.create-form-offer')->with([
        'offer' => $offer,
        // 'categories' => $categories,
        ]);

    }

    public function update(Request $request, Offer $offer)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'type' => 'required',
            'category' => 'required',
            'city' => 'required',
            'country' => 'required',
            'region' => 'nullable',
            'address' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'videos.*' => 'nullable|mimes:mp4,avi,mov,wmv|max:20480',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validation passed, update the offer
        $offer->update($request->all());

        // Handle photo uploads
        if ($request->hasFile('photos')) {
            $photos = [];
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('photos');
                $photos[] = Storage::url($path);
            }
            $offer->photos = $photos;
        }

        // Handle video uploads
        if ($request->hasFile('videos')) {
            $videos = [];
            foreach ($request->file('videos') as $video) {
                $path = $video->store('videos');
                $videos[] = Storage::url($path);
            }
            $offer->videos = $videos;
        }

        $offer->save();

        return redirect()->route('offers.index')->with('success', 'Offer updated successfully.');
    }


    public function destroy(Offer $offer)
    {
        $offer->delete();
        return redirect()->route('offers.index')->with('success', 'Offer deleted successfully.');
    }
    
    public function search(Request $request)
{
    $country = $request->input('country');
    $city = $request->input('city');
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');
    $sortOption = $request->input('sort');
    $category = $request->input('category');

    $query = Offer::query();

    // Filter by destination
    if ($country) {
        $query->where('country', $country);
    }
    if ($city) {
        $query->where('city', $city);
    }

    // Filter by dates where offer is free of other reservations
    if ($startDate && $endDate) {
        $query->whereDoesntHave('reservations', function ($subquery) use ($startDate, $endDate) {
            $subquery->where('start_date', '<=', $endDate)
                ->where('end_date', '>=', $startDate);
        });
    }

    // Sort By: price, rating, popularity, newest arrival.
    if ($sortOption === 'price_low_high') {
        $query->orderBy('price', 'asc');
    } elseif ($sortOption === 'price_high_low') {
        $query->orderBy('price', 'desc');
    } elseif ($sortOption === 'top_rated') {
        $query->orderBy('rating', 'desc');
    } elseif ($sortOption === 'most_popular') {
        $query->withCount('reservations')->orderBy('reservations_count', 'desc');
    } elseif ($sortOption === 'newest') {
        $query->orderBy('created_at', 'desc');
    }

    // Apply category filter if selected
    if ($category) {
        $query->where('category', $category);
    }

    $offers = $query->paginate(16);

    // Get unavailable dates to be excluded from the chosen offers
    $unavailableDates = Reservation::getAllUnavailableDates($offers);
    $encUnavailableDates = json_encode($unavailableDates);

    return view('welcome', [
        'offers' => $offers,
        'sort' => $sortOption,
        'category' => $category,
        'encUnavailableDates' => $encUnavailableDates,
    ]);
}

      
}

