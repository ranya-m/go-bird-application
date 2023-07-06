<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Offer::query();

        // Apply filters
        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        // Apply sorting
        if ($request->input('sort') === 'price_asc') {
            $query->orderBy('price');
        } elseif ($request->input('sort') === 'price_desc') {
            $query->orderByDesc('price');
        }

        $offers = $query->get();

        return view('offers.index', compact('offers'));
    }
}

