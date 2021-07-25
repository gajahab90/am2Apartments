<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Providers\RouteServiceProvider;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request) {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            $user = $this->guard()->user();
            $user->api_token = Str::random(80);

            if($user->save()) {
                return response()->json(['data' => new UserResource($user)]);
            }
        }

        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request) {
        $user = Auth::guard('api')->user();

        if ($user) {
            $user->api_token = null;

            if($user->save()) {
                return response()->json(['data' => 'User logged out.'], 200);
            }
        }

        return response()->json(['error' => 'Unable to loggout user'], 401);
    }
}
