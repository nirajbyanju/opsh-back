<?php

namespace App\Services;

use App\Models\User;
use App\Events\UserRegistered;
use App\Events\SendNotification;
use Illuminate\Support\Facades\Hash;

class RegistrationService
{
    public function registerUser(array $data)
    {
        // Generate a user code
        $currentYear = now()->year;
        $latestId = User::max('id') + 1;
        $userCode = "Opsh-{$currentYear}-{$latestId}";

        // Map the input fields to the database columns
        $mappedData = [
            'first_name' => $data['firstName'], // Map input to database column
            'last_name' => $data['lastName'],   // Map input to database column
            'email' => $data['email'],          // Same name in input and database
            'username' => $data['userName'],    // Map input to database column
            'phone_number' => $data['phoneNumber'], // Map input to database column
            'userCode' => $userCode,            // Generated in service
            'password' => Hash::make($data['password']), // Hash password
            'status' => '1',                    // Default status
        ];

        // Create the user
        $user = User::create($mappedData);

        // Dispatch the events
        UserRegistered::dispatch($user);
        event(new SendNotification([
            'message' => "New user created {$user->username}",
            'id' => $user->id,
        ]));

        // Return the token and user details
        $token = $user->createToken('MyApp')->plainTextToken;
        return [
            'token' => $token,
            'name' => $user->first_name . ' ' . $user->last_name,
        ];
    }
}

