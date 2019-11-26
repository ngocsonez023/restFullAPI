<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Log;
use Config;
use Tymon\JWTAuth\Exceptions\JWTException;

class restFullAPIController extends Controller
{
   // reference : https://viblo.asia/p/jwt-json-web-tokens-trong-laravel-57-1VgZvoaOlAw
   // https://viblo.asia/p/api-authentication-su-dung-jwt-trong-laravel-1VgZvxRY5Aw

    public function register(Request $request){
        $user = DB::table('tbluserapi')->insert([
          'name' => $request->get('name'),
          'email' => $request->get('email'),
          'password' => Hash::make($request->get('password'))
        ]);
        return response()->json([
            'status'=> 200,
            'message'=> 'User created successfully',
            'data'=>$user
        ]);
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        // Config::set('auth.providers.users.model', \App\User::class);
        $token = null;

        try {
            
           if (!$token = JWTAuth::attempt($credentials)) {
            
            return response()->json(['invalid_email_or_password'], 422);
           }
        } catch (JWTAuthException $e) {
            return response()->json(['failed_to_create_token'], 500);
        }
        return response()->json(compact('token'));
    }

    public function getUserInfo(Request $request){
        $user = JWTAuth::toUser($request->token);
        return response()->json(['result' => $user]);
    }
}
