<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offer>
 */
class OfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()-> sentence(),
            'country' => fake()-> country(),
            'city' => fake()->city(),
            'address' => fake()->sentence(),
            'description' => fake() -> paragraph(),
            'price' => fake()-> numberBetween(20, 1500),
            'region' => $this->faker->randomElement(['Africa', 'Middle East', 'Europe', 'Americas', 'Asia Pacific']),
            'category' => $this->faker->randomElement(['luxe', 'city', 'beach', 'rural', 'mountain', 'island', 'desert', 'traditional',  'boat']),
            'type' => $this->faker->randomElement(['House', 'Apartment', 'Hotel', 'Guesthouse']),
            // 'photos' => $this->generateImgUrls($this->faker->numberBetween(5, 15)),
            // 'photos' => $this->faker->image('public/photos/photo'),
            'videos' => $this->generateVideoUrls($this->faker->numberBetween(0, 2)),
            'rating' => $this->faker->randomFloat(2, 0, 5),
            // 'available' => $this->faker->randomElement([true, false]),
        ];
    }
    

    
private function generateImgUrls($count)
{
    $response = Http::get('https://api.unsplash.com/photos/random', [
        'count' => $count,
        'client_id' => 'aHMtfXsI4dB5X61HS-inCd1QUGe3iwRzrB7ptLxoJsc',
        'query' => 'home',
    ]);

    $urls = [];

    if ($response->ok()) {
        $photos = $response->json();

        foreach ($photos as $photo) {
            $urls[] = $photo['urls']['regular'];
        }
    }

    return $urls;
}


    
    private function generateVideoUrls($count)
    {
        $urls = [];

        for ($i = 0; $i < $count; $i++) {
            $videoPath = 'videos/video' . ($i + 1) . '.mp4';
            $videoUrl = asset($videoPath);
            $urls[] = $videoUrl;
        }

        return $urls;
    }
    
}
