<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\NotificationRepositoryInterface;
use App\Events\NotificationSent;

class NotificationController extends Controller
{
    protected $notificationRepository;

    public function __construct(NotificationRepositoryInterface $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function getUserNotifications($userId)
    {
        $notifications = $this->notificationRepository->getUserNotifications($userId);
        die($notifications);

        event(new NotificationSent($userId, $notifications));

        return response()->json($notifications);
    }
}
