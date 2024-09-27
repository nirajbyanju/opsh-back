<?php

namespace App\Models\vacancy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use App\Models\User;
use App\Models\vacancy\CompanyProfile;

class VacancyPost extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'va_vacancy_post';

    protected $fillable = [
        'position',
        'category_id',
        'company_id',
        'type',
        'level',
        'location',
        'website',
        'email',
        'phone_number',
        'age',
        'deadline',
        'offered_salary',
        'tags',
        'description',
        'photo',
        'status',
        'verified_by',
        'created_by'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }


    public function company()
    {
        return $this->belongsTo(CompanyProfile::class, 'company_id');
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}
