<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class);
    }
    
    public function path(): string
    {
        return route('admin.ingredients.show', [$this->id]);
    }

    public function setNameAttribute($value): void
    {
        if ($value)  {
            $this->attributes['name'] = ucwords($value);
        }
    }

    public static function getTableName(): string
    {
        return (new self())->getTable();
    }

}
