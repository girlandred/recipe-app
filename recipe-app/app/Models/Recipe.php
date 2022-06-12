<?php

namespace App\Models;

use App\Traits\HasSpecifications;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Recipe extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use HasSpecifications;

    protected $fillable = [
        'name',
        'directions',
        'servings',
        'timing',
        'category_id',
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

    public function id(): int
    {
        return $this->id;
    }
    public function name(): string
    {
        return $this->name;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getReadableTimingAttribute(): CarbonInterval
    {
        return \Carbon\CarbonInterval::minutes($this->timing)->cascade()->forHumans();
    }

    public function delete()
    {
        $this->removeSpecifications();
        parent::delete();
    }

    protected $with = [
        'specificationsRelation'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'DESC');
    }

}
