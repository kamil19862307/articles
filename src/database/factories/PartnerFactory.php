<?php

namespace Database\Factories;

use App\Models\Partner;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Partner>
 */
class PartnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $name =  $this->faker->company(),
            'slug' => Str::slug($name),
            'logo' => $this->faker->imageUrl(
                word: $name,
            ),
            'description' => $this->faker->realText(),
            'active' => $this->faker->boolean(),
        ];
    }
}
