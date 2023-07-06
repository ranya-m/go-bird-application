<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Offer;
use App\Models\Review;
use App\Models\Host;
use Illuminate\Support\Facades\DB;


class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Retrieve all host IDs from hosts table
        $hostIds = Host::pluck('id')->all();

        // Create offers
        Offer::factory()->count(10)->create([
            'host_id' => function () use ($hostIds) {
                // Randomly select a host ID from the availables ones
                return DB::table('hosts')->inRandomOrder()->value('id');
            },
        ])->each(function ($offer) {
            // Create reviews for each offer
            Review::factory()->count(5)->create([
                'offer_id' => $offer->id,
            ]);
        });
    }
}
