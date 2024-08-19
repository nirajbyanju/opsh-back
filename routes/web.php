<?php


use Illuminate\Support\Facades\Route;

// routes/web.php
use App\Events\NotificationSent;

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function () {
    event(new NotificationSent('hello from', 1));
    return 'done';
});
