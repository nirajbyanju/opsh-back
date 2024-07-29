<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rules;
   
class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
           'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'userName' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phoneNumber' => ['required', 'integer', 'unique:users,phone_number'],
            'password' => ['required', Rules\Password::defaults(), 'same:cPassword'],
            'cPassword' => ['required', Rules\Password::defaults()],
        ]);
   
        if($validator->fails()){
            return response()->json([
                'error' => [
                'status' => 'error',
                'validationErrors'=> $validator->errors(),
                ],
            ], 422);     
        }
   
        $input = $request->all();
        $input['first_name'] = $request->input('firstName');
        $input['last_name'] = $request->input('lastName');
        $input['email'] = $request->input('email');
        $input['username'] = $request->input('userName');
        $input['phone_number'] = $request->input('phoneNumber');
        $input['password'] = bcrypt($input['password']);
        $input['status'] = '1';
        
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;
   
        return $this->sendResponse($success, 'User register successfully.');
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
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'base_url' => 'required|url'
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return response()->json(['error' => 'Email does not exist.'], 404);
    }

    $token = Password::createToken($user);
    $frontendUrl = $request->base_url . '/reset-password?token=' . $token . '&email=' . urlencode($user->email);

    $response = Password::sendResetLink(
        $request->only('email'),
        function ($message) use ($user, $frontendUrl) {
            $message->subject('Reset Password Notification');
            $message->view('emails.reset-password', [
                'userName' => $user->username,
                'frontendUrl' => $frontendUrl,
            ]);
        }
    );

    if ($response == Password::RESET_LINK_SENT) {
        return response()->json(['message' => 'Reset link sent to your email.'], 200);
    } else {
        return response()->json(['error' => 'Unable to send reset link.'], 500);
    }
}



}