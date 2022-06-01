<?php

namespace App\Traits;

use App\Models\Specification;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasSpecifications
{
    public function specifications()
    {
        return $this->specificationsRelation;
    }

    public function specificationsRelation(): MorphToMany
    {
        return $this->morphToMany(Specification::class, 'taggable')->withTimestamps();
    }

    public function syncSpecifications(array $specifications)
    {
        $this->save();
        $this->specificationsRelation()->sync($specifications);
        $this->unsetRelation('specificationsRelation');
    }

    public function removeSpecifications()
    {
        $this->specificationsRelation()->detach();
        $this->unsetRelation('specificationsRelation');
    }
}
