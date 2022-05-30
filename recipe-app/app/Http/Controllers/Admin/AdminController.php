<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\Gate;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Ingredient;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;

class AdminController extends Controller
{
    //     public function index()
    //     {
    //         return view('admin.index');
    //     }
    // }

    public function adminDashboard(): View
    {
        $recipes = Recipe::count();
        $ingredients = Ingredient::count();

        return view('admin.dashboard', compact('recipes', 'ingredients'));
    }
}
