<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\Gate;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Ingredient;
use App\Models\Specification;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;

class AdminController extends Controller
{
    public function adminDashboard(): View
    {
        $recipes = Recipe::count();
        $specifications = Specification::count();

        $ingredients = Ingredient::count();

        return view('admin.dashboard', compact('recipes', 'specifications', 'ingredients'));
    }
}
