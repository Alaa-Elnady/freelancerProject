<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle(),
            'tags' => " Laravel , Backend , API ",
            'company' => fake()->company(),
            'location' => fake()->city(),
            'email' => fake()->unique()->safeEmail(),
            'website' => fake()->domainName(),
            'description' => fake()->text($maxNbChars = 400),
        ];
    }
}
