<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_notification_id';

    protected $fillable = [
        'user_id',
        'notification_id',
        'is_read',
        'read_at',
    ];

    // Relationships
    public function notification()
    {
        return $this->belongsTo(Notification::class, 'notification_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

