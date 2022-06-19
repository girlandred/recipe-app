<?php

namespace Database\Factories;

use App\Gamify\Points\RecipeCreated;
use App\Models\Ingredient;
use App\Models\Recipe;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->name,
            'directions' => $this->faker->text,
            'servings' => $this->faker->randomDigit,
            'timing' => $this->faker->randomDigit,
            'user_id' => \App\Models\User::all()->random()->id,
            'category_id' => \App\Models\Category::all()->random()->id,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Recipe $recipe) {
            $recipe->User->givePoint(new RecipeCreated($recipe, Auth::user()));
            $recipe->ingredients()->attach(Ingredient::inRandomOrder()
                ->take(random_int(1, 20))
                ->pluck('id'));
        });
    }
}
