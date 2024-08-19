<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotificationSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data;
    public $userID;

    public function __construct($data, $userID)
    {
        $this->data = $data;
        $this->userID = $userID;
    }

    public function broadcastWith(): array
    {
        return [
            "message" => $this->data,
        ];
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('Private-channel.user.' . $this->userID),
        ];
    }
}
