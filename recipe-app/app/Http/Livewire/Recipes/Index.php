<?php

namespace App\Http\Livewire\Recipes;

use Livewire\Component;
use App\Models\Recipe;


class Index extends Component
{
    Public $allRecipes;

    public function render()
    {
        $recipes = Recipe::all();

        return view('livewire.recipes.index', compact('recipes'));
    }
}
