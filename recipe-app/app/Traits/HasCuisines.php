<?php

namespace App\Traits;

use App\Models\Cuisine;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasCuisines
{
    public function cuisines()
    {
        return $this->cuisinesRelation;
    }

    public function cuisinesRelation(): MorphToMany
    {
        return $this->morphToMany(Cuisine::class, 'has_cuisines')->withTimestamps;
    }

    public function syncCuisines(array $cuisines)
    {
        $this->save();
        $this->cuisinesRelation()->sync($cuisines);
        $this->unsetRelation('cuisinesRelation');
    }

    public function removeCuisines()
    {
        $this->cuisinesRelation()->detach();
        $this->unsetRelation('cuisinesRelation');

    }
}
