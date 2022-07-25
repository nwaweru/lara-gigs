<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Listing;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ListingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Listing::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->text,
            'tags' => 'laravel, api, backend',
            'company' => fake()->company,
            'location' => fake()->city,
            'email' => fake()->companyEmail,
            'website' => fake()->url,
            'description' => fake()->paragraph
        ];
    }
}
