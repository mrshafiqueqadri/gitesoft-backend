<?php

namespace App\Http\Controllers;

use App\Mail\PasswordReset;
use Illuminate\Http\Request;
use App\User;
use Auth, Hash, Lang;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signin(Request $request)
    {
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return response()->json([
                'user' => Auth::user(),
                'token' => Auth::user()->createToken('GiteSoft')->accessToken
            ], 200);
        }   

        return response()->json([
                'response' => Lang::get('messages.error_signin')
            ], 400);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|max:255|email',
            'password' => 'required|min:6|confirmed'
        ]);
        
        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'name' => $request->name,
            'remember_token' => str_random(19),
            // 'confirmation_token' => str_random(25)
        ]);
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'user' => Auth::user(),
                'token' => Auth::user()->createToken('GiteSoft')->accessToken,
                'message' => Lang::get('messages.account_created')
            ], 200);
        }
    }
    
    /**
     * [email confirmation ]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function registerConfirmation(Request $request)
    {
        User::where('confirmation_token', $request->token)
            ->firstOrFail()
            ->confirm();
        
        return response()->json([
            'success' => true,
            'message' => Lang::get('messages.account_confirm')
        ], 200);
    }
    
}