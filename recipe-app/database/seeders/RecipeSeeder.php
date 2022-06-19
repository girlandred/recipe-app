<?php

namespace Database\Seeders;

use App\Gamify\Points\RecipeCreated;
use App\Models\Recipe;
use App\Models\User;
use Database\Factories\ReputationFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Point;
use QCod\Gamify\Reputation;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Recipe::factory()->count(900)->create();
    }
}
