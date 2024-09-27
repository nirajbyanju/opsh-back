<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

// routes/web.php
use App\Events\NotificationSent;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('test', function () {
//     event(new NotificationSent('hello from', 1));
//     return 'done';
// });
Route::get('/migration-refresh', function () {
    try {
        // Run the migrate:refresh command with the --seed option
        Artisan::call('migrate:refresh', [
            '--seed' => true
        ]);

        // Get the output of the command
        $output = Artisan::output();

        return response()->json([
            'message' => 'Migrations refreshed and seeded successfully!',
            'output' => $output
        ], 200);
    } catch (\Exception $e) {
        // Catch and return any error that occurred during the process
        return response()->json([
            'message' => 'An error occurred during migration refresh.',
            'error' => $e->getMessage()
        ], 500);
    }
});