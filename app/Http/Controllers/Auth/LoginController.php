<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
    public function apiLogout(Request $request)
    {
        # code...
        current_user()->destroyToken();

        return response()->json(["message"=>true],200);
    }
    /**
     * Login an api user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function apiLogin(Request $request)
    {
        // find user with email
        if ($user = $this->findUserByEmail($request->email)) {
            // check if password is correct
            if (Hash::check($request->password, $user->password)) {
                return response()->json(
                    [
                        'token' => $user->createToken('api-token')->plainTextToken,
                        'username' => $user->name,
                    ], 201);
            } else {
                // password is invalid
                return response()->json([
                    'email' => 'email or password dosn\'t exist or not correct',
                ], 401);
            }
        } else {
            // email is invalid
            return response()->json([
                'email' => 'email or password dosn\'t exist or not correct',
            ], 401);
        }
    }

    /**
     * find the user by email
     *
     * @param  string  $email
     * @return \App\Models\User
     */
    public function findUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }
}
