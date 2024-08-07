<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'date_of_birth',
        'bio',
        'profile_picture',
        'marital_status',
        'gender',
        'country',
        'state',
        'district',
        'local_bodies',
        'street_name',
        'postal_code',
        'nationality',
        'religion',
        'language',
        'driving_license',
        'type_of_license',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

