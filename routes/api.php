<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\NotificationController;

Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('passwordEmail','sendResetLinkEmail')->name('password.reset');
});


Route::controller(NotificationController::class)->group(function () {
    Route::get('notification/{userId}', 'getUserNotifications');
});


        
