<?php

namespace App\Http\Controllers\Api;

use App\Models\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    /**
     * AuthController constructor.
     * @param $userRepo
     */
    public function __construct(UserRepository $userRepo)
    {
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json(compact('token'));
    }

    public function checkLogin(Request $request){
        $user = JWTAuth::parseToken()->authenticate();
        echo '<pre>'; print_r($user->event_id);
    }
}
