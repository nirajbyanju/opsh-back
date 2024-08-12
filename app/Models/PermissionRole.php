<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    use HasFactory;
    protected $table = 'permission_role'; // Specify the table name

    protected $fillable = ['role_id', 'permission_id']; 
}
