<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cuisine extends Model
{
    use HasFactory;
    public $fillable = [
        'name',
    ];

    public function path(): string
    {
        return route('admin.tags.show', [$this->id]);
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function recipe(): BelongsToMany
    {
        return $this->belongsToMany(Recipe::class);
    }
}
