<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Support\Facades\Log;

class SendWelcomeEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event)
    {
        // Get the registered user
        $user = $event->user;

        // Create a new notification
        $notification = Notification::create([
            'message' => "A new user has been registered: {$user->first_name} {$user->last_name}",
            'created_by' => $user->id,
        ]);

        // Notify admins and other users
        $admins = User::whereHas('roles', function ($query) {
            $query->whereIn('roles.id', [1, 2]);
        })->with('roles')->get();
        

        foreach ($admins as $admin) {
            // Create a user_notification record for each admin
            UserNotification::create([
                'user_id' => $admin->id,
                'notification_id' => $notification->notification_id,
                'is_read' => false,
                'read_at' => null,
            ]);
        }

        // Optionally, notify the user themselves
        UserNotification::create([
            'user_id' => $user->id,
            'notification_id' => $notification->notification_id,
            'is_read' => false,
            'read_at' => null,
        ]);

        Log::info('Notifications sent for user registration.');
    }
}
