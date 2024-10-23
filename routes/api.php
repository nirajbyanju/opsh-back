<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\Vacancy\CompanyProfileController;

// Auth-related routes with rate limiting
Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register')->middleware('throttle:10,1');
    Route::post('login', 'login')->middleware('throttle:5,1'); 
    Route::post('passwordEmail','sendResetLinkEmail')
        ->name('password.reset')
        ->middleware('throttle:3,1'); 
});

Route::prefix('categories')->controller(CategoryController::class)->group(function () {
    Route::get('/', 'list')->name('categories.list')->middleware('throttle:60,1'); 
    Route::post('/', 'create')->name('categories.create')->middleware('throttle:10,1');
    Route::get('/{id}', 'listing')->name('categories.show')->middleware('throttle:30,1'); 
    Route::patch('/{id}', 'update')->name('categories.update')->middleware('throttle:10,1'); 
    Route::delete('/{id}', 'delete')->name('categories.delete')->middleware('throttle:5,1'); 
});


Route::prefix('companyProfile')->controller(CompanyProfileController::class)->group(function (){
    Route::get('/', 'list')->name('companyProfile.list')->middleware('throttle:60,1'); 
    Route::post('/', 'create')->name('companyProfile.create')->middleware('throttle:10,1');
    Route::get('/{id}', 'listing')->name('companyProfile.show')->middleware('throttle:30,1'); 
    Route::post('/{id}', 'update')->name('companyProfile.update'); 
    Route::patch('/status/{id}', 'updateStatus')->name('companyProfile.updateStatus')->middleware('throttle:30,1');
    Route::delete('/{id}', 'delete')->name('companyProfile.delete')->middleware('throttle:30,1');
});



Route::controller(NotificationController::class)->group(function () {
    Route::get('notification/{userId}', 'getUserNotifications')->middleware('throttle:20,1'); // 20 requests per minute
});


