<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Specification extends Model
{
    use HasFactory;

    const TABLE = 'specifications';

    protected $table = self::TABLE;

    protected $fillable = [
        'name'
    ];

    public function recipes(): MorphToMany
    {
        return $this->morphedByMany(Recipe::class, 'taggable');
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function path(): string
    {
        return route('admin.specifications.show', [$this->id]);
    }
}
