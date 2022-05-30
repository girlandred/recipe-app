<?php

namespace App\Models;

use App\Traits\HasCuisines;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Recipe extends Model
{
    use HasFactory;
    use HasCuisines;

    protected $fillable = [
        'name',
        'directions',
    ];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class)->withPivot('quantity');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function path(): string
    {
        return route('recipes.show', [$this->id]);
    }

    public function cuisines(): BelongsToMany
    {
        return $this->belongsToMany(Cuisine::class, 'recipe_cuisine');
    }

    // public function delete()
    // {
    //     $this->removeCuisines();
    //     parent::delete();
    // }

    // protected $with = [];
}
