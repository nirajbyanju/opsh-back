<?php 

namespace App\Repositories;

use App\Models\UserNotification;
use App\Repositories\Interfaces\NotificationRepositoryInterface;

class NotificationRepository implements NotificationRepositoryInterface
{
    public function getUserNotifications($userId)
    {
        return UserNotification::where('user_id', $userId)->with('notification')->get();
    }
}