<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Partner;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $partner = $this->faker->boolean();

        return [
            'name' => $name = $this->faker->sentence(),
            'slug' => Str::slug($name),
            'image' => $this->faker->imageUrl(word: $name),
            'ai_summary' => $this->faker->sentence(),

            'description' => $this->faker->realText(
                maxNbChars: 160),

            'canonical_url' => $partner
                ? $this->faker->url()
                : null,

            'content' => $this->faker->realText(
                maxNbChars: $this->faker->numberBetween(100, 1000)),

            'partner_id' => $partner
                ? Partner::factory()
                : null,
        ];
    }
}
