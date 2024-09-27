<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\RegisterUserRequest;
use App\Events\UserRegistered;
use App\Events\SendNotification;
use Illuminate\Support\Facades\Hash;
use App\Services\RegistrationService;

   
class RegisterController extends BaseController
{
    protected $registrationService;

    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    public function register(RegisterUserRequest $request): JsonResponse
    {
        // Use the service to register the user
        $userData = $this->registrationService->registerUser($request->all());

        return response()->json([
            'success' => true,
            'data' => [
                'token' => $userData['token'],
                'name' => $userData['name'],
            ],
            'message' => 'User registered successfully.',
        ], 201);
    }

   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request): JsonResponse
{
    // Validate the request data
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Check if the email exists in the system
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return response()->json([
            'error' => [
                'status' => 'error',
                'validationErrors' => [
                    'email' => ['The email does not exist.']
                ],
            ],
        ], 404);
    }

    // Attempt to authenticate the user
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        $user = Auth::user();
        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['user'] = [
            'id' => $user->id,
            'firstName' => $user->first_name,
            'lastName' => $user->last_name,
            'userName'=> $user->username,
            'email' => $user->email,

            // add any other user information you need
        ];
    
        return $this->sendResponse($success, 'User login successfully.');
    }
     else {
        return response()->json([
            'error' => [
                'status' => 'error',
                'validationErrors' => [
                    'password' => ['The password is incorrect.']
                ],
            ],
        ], 422);
    }
}

public function sendResetLinkEmail(Request $request)
{
    // Validate the input
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        // Remove 'base_url' from validation rules if not used
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Retrieve the user by email
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return response()->json(['error' => 'Email does not exist.'], 404);
    }

    // Send the password reset link
    $response = Password::sendResetLink(
        $request->only('email')
    );

    if ($response == Password::RESET_LINK_SENT) {
        return response()->json(['message' => 'Reset link sent to your email.'], 200);
    } else {
        return response()->json(['error' => 'Unable to send reset link.'], 500);
    }
}


}