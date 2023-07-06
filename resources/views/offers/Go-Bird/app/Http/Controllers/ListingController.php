<?php

namespace App\Http\Controllers;

use App\Models\Offer;

class ListingController extends Controller
{
    public function render()
        {
            $listings = Offer::with('reviews')->get();
            
            return view('home', ['listings' => $listings]);
        }   
    public function renderForAuthTraveler()
        {
            $listings = Offer::with('reviews')->get();
            
            return view('travelerboard', ['listings' => $listings]);
        }   
}



// if ($this->search) {
//     $query->where(function ($q) {
//         $q->where('', 'LIKE', '%' . $this->search . '%')
//     });
// }

// $offers = $query->orderBy($this->orderBy, $this->sortBy)->get();