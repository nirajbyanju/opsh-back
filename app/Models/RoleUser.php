<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;

    protected $table = 'role_user'; // Specify the table name

    protected $fillable = ['user_id', 'role_id'];
}
