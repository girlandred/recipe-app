<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($value): string
    {
        return \Carbon\Carbon::parse($value)->format('j<\s\up>S</\s\up> F Y');
    }

    public static function getTableName(): string
    {
        return (new self())->getTable();
    }
}
