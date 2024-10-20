<?php

namespace App\Models\vacancy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\CastsCamelCaseAttributes;
use Carbon\Carbon;

class CompanyProfile extends Model
{
    use HasFactory, SoftDeletes, CastsCamelCaseAttributes; 

    protected $table = 'va_company_profiles';

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
        'verified_by',
        'created_by',
        'verified_at'
    ];


    public function formattedDate()
    {
        return Carbon::parse($this->attributes['established'])->format('M j, Y');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('status', 1);
    }

    // Override the toArray method to include the formatted date
    public function toArray()
    {
        $array = parent::toArray();

        // Add a new variable for the formatted established date
        $array['formatted_date'] = $this->formattedDate();

        return $array;
    }
}
