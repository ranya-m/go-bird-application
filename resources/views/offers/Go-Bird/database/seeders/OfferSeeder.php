<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Offer;
use App\Models\Review;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // Create offers
                Offer::factory()->count(10)->create()->each(function ($offer) {
                    // Create reviews for each offer
                    Review::factory()->count(5)->create([
                        'offer_id' => $offer->id,
                    ]);
                });
    }
}
