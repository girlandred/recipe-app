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
use App\Models\Specification;
use App\Models\Category;
use Nette\Utils\Image;


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
            'image' => $request['image']
        ]);


        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $image_name = uniqid() . '-' . $request->title . '.' . $request->image->extension();
            $path = public_path('images');
            $resize = Image::make($file->getRealPath());
            $resize->resize(368, 276, 10, function ($const) {
            })->save($path . '/' . $image_name);

            $file->move(public_path('image'), $image_name);
        }

        $recipe->syncSpecifications($request->specifications);

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
        $oldSpecifications = $recipe->Specifications()->pluck('id')->toArray();
        $recipe->load('ingredients');
        return view('recipes.edit', [
            'recipe' => $recipe,
            'specifications' => Specification::all(),
            'categories' => Category::all(),
            'oldSpecifications' => $oldSpecifications,
        ]);
    }

    public function update(UpdateRecipeRequest $request, Recipe $recipe): RedirectResponse
    {
        $recipe->syncSpecifications($request->specifications);
        $recipe->update($request->validated());

        return redirect($recipe->path());
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return view('recipes.index');
    }
}
