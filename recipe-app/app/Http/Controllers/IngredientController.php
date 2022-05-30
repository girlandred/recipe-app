<?php

namespace App\Http\Controllers;

use Auth;
use Gate;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreIngredientRequest;
use App\Http\Requests\UpdateIngredientRequest;

class IngredientController extends Controller
{
    public function index(): View
    {
        return view('admin.ingredients.index');
    }

    public function create(): View
    {
        return view('admin.ingredients.create');
    }
    
    public function store(StoreIngredientRequest $request): RedirectResponse
    {
        $ingredient = Auth::User()->Ingredients()->create($request->validated());

        return redirect($ingredient->path());
    }

    public function show(Ingredient $ingredient): View
    {
        return view('admin.ingredients.show', compact('ingredient'));
    }

    public function edit(Ingredient $ingredient): View
    {
        return view('admin.ingredients.edit', compact('ingredient'));
    }

    public function update(UpdateIngredientRequest $request, Ingredient $ingredient): RedirectResponse
    {        
        $ingredient->update($request->validated());

        return redirect($ingredient->path());
    }

    public function destroy(Ingredient $ingredient): RedirectResponse
    {
        $ingredient->delete();

        return redirect()->route('admin.ingredients.index');
    }
}
