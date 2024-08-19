<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('notifications.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('Private-channel.user.{id}', function ($user, $id) {
    return $user->id == $id;
});


