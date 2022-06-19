<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Specification;
use App\Models\Recipe;

class SpecificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specifications = collect([
            $this->createSpecification('Spicy'),
            $this->createSpecification('Vegetarian'),
            $this->createSpecification('For Adults'),
            $this->createSpecification('Gluten free'),
            $this->createSpecification('For kids'),
            $this->createSpecification('Sport diet'),
            $this->createSpecification('Ukranian'),
            $this->createSpecification('Mexican'),
            $this->createSpecification('Thai'),
        ]);

        Recipe::all()->each(function ($recipe) use ($specifications) {
            $recipe->syncSpecifications(
                $specifications->random(rand(0, $specifications->count()))
                    ->take(3)
                    ->pluck('id')
                    ->toArray(),
            );
        });
    }

    private function createSpecification(string $name)
    {
        return Specification::factory()->create(compact('name'));
    }
}
