<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Host;
use App\Models\Offer;
use App\Models\Reservation;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // SEEDING USERS
        User::factory(10)->create();

        // SEEDING HOSTS
        Host::factory(5)->create();
        
        // SEEDING OFFERS
            // Retrieve all host IDs from hosts table
        $hostIds = Host::pluck('id')->all();

            // Create offers
        Offer::factory()->count(30)->create([
            'host_id' => function () use ($hostIds) {
                // Randomly select a host ID from the availables ones
                return DB::table('hosts')->inRandomOrder()->value('id');
            },
        ])->each(function ($offer) {
            // Create reviews for each offer
            Review::factory()->count(2)->create([
                'offer_id' => $offer->id,
            ]);
        });

        // SEEDING RESERVATIONS
        Reservation::factory()->count(10)->create();

                


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
