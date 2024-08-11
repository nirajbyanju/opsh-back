<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $primaryKey = 'notification_id';

    protected $fillable = [
        'message',
        'created_by',
    ];

    // Relationships
    public function userNotifications()
    {
        return $this->hasMany(UserNotification::class, 'notification_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
