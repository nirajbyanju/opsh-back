<?php

namespace App\Repositories\Interfaces;

interface NotificationRepositoryInterface
{
    public function getUserNotifications($userId);
}