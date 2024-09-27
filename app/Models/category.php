<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'category';

    protected $fillable = [
        'name',
        'status',
    ];

    public function scopeActive(Builder $query)
    {
        return $query->where('status', 1);
    }


    public function scopeInactive(Builder $query)
    {
        return $query->where('status', 0);
    }
}
