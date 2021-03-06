<?php

namespace App\Http\Controllers;

use App\Gamify\Points\RecipeCreated;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;
use App\Models\Specification;
use App\Models\Category;
use App\Models\Ingredient;


class RecipeController extends Controller
{
    public function index()
    {
        $specifications = Specification::all();
        return view('recipes.index', compact('specifications'));
    }

    public function create(): View
    {
        return view('recipes.create', [
            'specifications' => Specification::all(),
            'categories' => Category::all(),
        ]);
    }

    public function store(StoreRecipeRequest $request): RedirectResponse
    {
        $recipe = Auth::User()->Recipes()->create([
            'name' => $request['name'],
            'servings' => $request['servings'],
            'timing' => $request['timing'],
            'category_id' => $request['category_id'],
            'directions' => $request['directions'],
            'image' => $request['image'],
        ]);

        givePoint(new RecipeCreated($recipe, Auth::user()));

        $recipe->syncSpecifications($request->specifications);

        for ($i = 0; $i < count($request['ingredients']); $i++) {
            $recipe->ingredients()->attach($request['ingredients'][$i], ['quantity' => $request['quantities'][$i]]);
        }

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $recipe->addMediaFromRequest('image')->toMediaCollection('image');
        }

        return redirect($recipe->path());
    }

    public function show(Recipe $recipe): View
    {
        $specifications = Specification::all();
        return view('recipes.show', compact('recipe', 'specifications'));
    }

    public function edit(Recipe $recipe): View
    {
        $oldSpecifications = $recipe->Specifications()->pluck('id')->toArray();
        $recipe->load('ingredients');
        $categories = Category::all();
        $specifications = Specification::all();
        return view('recipes.edit', compact('recipe', 'specifications', 'categories'));
    }

    public function update(UpdateRecipeRequest $request, Recipe $recipe): RedirectResponse
    {
        for ($i = 0; $i < count($request['ingredients']); $i++) {
            $recipe->ingredients()->attach($request['ingredients'][$i], ['quantity' => $request['quantities'][$i]]);
        }
        $recipe->update($request->validated());
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $recipe->media()->delete();
            $recipe->addMediaFromRequest('image')->toMediaCollection('image');
        }
        return redirect($recipe->path());
    }

    public function destroy(Recipe $recipe)
    {
        undoPoint(new RecipeCreated($recipe, Auth::user()));
        $recipe->delete();

        return view('recipes.index');
    }
}
