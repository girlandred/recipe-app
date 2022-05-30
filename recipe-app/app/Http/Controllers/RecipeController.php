<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;
use Illuminate\View\View;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;
use App\Models\Cuisine;

class RecipeController extends Controller
{
    public function index()
    {
        return view('recipes.index');
    }

    public function create(): View
    {
        // $cuisines = Cuisine::all();

        return view('recipes.create', [
            'cuisines' => Cuisine::all(),
        ]);
    }

    public function store(StoreRecipeRequest $request): RedirectResponse
    {
        $recipe = Auth::User()->Recipes()->create([
            'name' => $request['name'],
            // 'cuisine_id' => $request['cuisine_id'],
            // 'directions' => $request['instruction']
        ]);

        for ($i = 0; $i < count($request['ingredients']); $i++) {
            $recipe->ingredients()->attach($request['ingredients'][$i], ['quantity' => $request['quantities'][$i]]);
        }

        return redirect($recipe->path());
    }

    public function show(Recipe $recipe): View
    {
        return view('recipes.show', compact('recipe'));
    }

    public function edit(Recipe $recipe): View
    {
        $recipe->load('ingredients');
        // $cuisines = Cuisine::all();

        return view('recipes.edit', compact('recipe'));
    }

    public function update(UpdateRecipeRequest $request, Recipe $recipe): RedirectResponse
    {
        $recipe->update($request->validated());

        return redirect($recipe->path());
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return redirect()->back();
    }
}
