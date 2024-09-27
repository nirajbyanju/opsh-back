<?php

namespace App\Models\vacancy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;

class CompanyProfile extends Model
{
    use HasFactory, SoftDeletes;

    // Define the table name if it's not the default plural of the model name
    protected $table = 'va_company_profiles';

    // Mass-assignable attributes
    protected $fillable = [
        'company_name',
        'category_id',
        'email',
        'phone_number',
        'website',
        'location',
        'established',
        'team_size',
        'logo',
        'description',
        'status',
        'verified_at'
    ];

    // If you have a Category model, define the relationship
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('status', 1);
    }

    // You can define other relationships here as needed
}
