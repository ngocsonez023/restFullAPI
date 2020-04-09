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
  public function __construct()
    {
      // We set the guard api as default driver
      
      // auth()->setDefaultDriver('admin');

      //reference: https://medium.com/@akgarg007/laravel-6-jwt-multi-model-authentication-d5b416c4cdb4
    }
   // reference : https://viblo.asia/p/jwt-json-web-tokens-trong-laravel-57-1VgZvoaOlAw
   // https://viblo.asia/p/api-authentication-su-dung-jwt-trong-laravel-1VgZvxRY5Aw
  // https://codingpearls.com/huong-dan-lap-trinh-restful-api-voi-laravel-5
  // https://www.youtube.com/watch?v=5kmr55zUcQM

    // reference for Authorization = null
    // https://github.com/laravel/framework/issues/6482

    public function register(Request $request){
        $user = DB::table('users')->insert([
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

    public function adminlogin(Request $request){
        // Config::set('jwt.user', "App\Admin");
        // Config::set('auth.providers.admins.model', \App\Admin::class);

        auth()->setDefaultDriver('admin');
        $credentials = $request->only('email', 'password');
        
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
