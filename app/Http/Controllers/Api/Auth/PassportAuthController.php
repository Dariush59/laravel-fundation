<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use function dd;
use Illuminate\Http\Request;

use App\Models\Users\User;
use Illuminate\Support\Facades\Gate;
use function now;

class PassportAuthController extends Controller
{
    /**
     * Registration Req
     */
    public function register(Request $request)
    {
        $response = Gate::inspect('viewAny', auth()->user());
        if (!$response->allowed()){
            return response([ 'message' => $response->message() ], 403);
        }
        $this->validate($request, [
            'first_name' => 'required|min:4',
            'last_name' => 'required|min:4',
            'phone_no' => 'required|min:8|numeric',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_no' => $request->phone_no,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_type'         => false,
            'last_login'        => now(),
            'joined_at'         => now(),
            'email_verified_at'         => now(),
        ]);
        $token = $user->createToken('Laravel8PassportAuth')->accessToken;
        return response()->json(['token' => $token], 200);
    }

    /**
     * Login Req
     */
    public function login(Request $request)
    {
        try {
            $this->loginValidation($request);
            $data = [
                'email' => $request->userName,
                'password' => $request->password
            ];

            if (auth()->attempt($data)) {
                $token = auth()->user()->createToken('Laravel8PassportAuth');
                auth()->user()->update(['last_login' => now()]);
                return response([
                    'auth' => [
                        'accessToken' => $token->accessToken,
                        'tokenType' => 'Bearer',
                        'expiresAt' => $token->token->expires_at
                    ]], 200);
            } else {
                return response(['error' => 'Unauthorised'], 401);
            }
        } catch (\Exception $e) {
            return response([ 'message' => $e->getMessage() ], 500);
        }
    }

    public function userInfo()
    {

        $user = auth()->user();

        return response()->json(['user' => $user], 200);

    }

    /**
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     */
    private function loginValidation(Request $request)
    {
        $this->validate($request, [
            'userName' => 'required|email',
            'password' => 'required|min:8'
        ]);
    }
}
