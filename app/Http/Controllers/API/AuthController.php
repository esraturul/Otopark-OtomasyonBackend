<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function user(Request $request){
        return Auth::user();
        
    }
    public function register(Request $request)
    {
        return User::create([

            'name'=>$request->input('name'),
            'lastname'=>$request->input('lastname'),
            'tckn'=>$request->input('tckn'),
            'phone'=>$request->input('phone'),
            'email'=>$request->input('email'),
            'password'=>Hash::make ($request->input('password')),


        ]);
        
    }
    public function login(Request  $request)
    
    {
       if( !Auth::attempt($request->only('email','password')))
       {
            return response([
                'message' =>'Invalid credentials!'
            ],);
       }

       $user = Auth::user();
       $token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('jwt', $token, 60*24);
        
        if ($user->role !== 'admin') {
            return response(['message' => $user ,  "role" => "kullanici"]);
        }

       return response([
        'message' => $user
       ])->withCookie($cookie);
    }
    public function logout(Request $request){
        $cookie = Cookie::forget('jwt');
        return response([
            'message'=>'Success'
        ])->withCookie($cookie);

    }
    public function createAdmin()
{
    User::create([
        'name' => 'Admin',
        'email' => 'admin@example.com',
        'password' => Hash::make('adminpassword'),
        'role' => 'admin',
    ]);

    return response(['message' => 'Admin user created']);
}
   
}

