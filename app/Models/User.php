<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes;

    protected $fillable = [
        'userCode',
        'name_tittle',
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'user_type_id',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function userDetails()
    {
        return $this->hasOne(UserDetail::class);
    }

    public function userEducation()
    {
        return $this->hasMany(UserEducation::class);
    }

    public function userExperience()
    {
        return $this->hasMany(UserExperience::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $baseUrl = request()->input('base_url');
        $this->notify(new ResetPasswordNotification($token, $baseUrl));
    }
}

