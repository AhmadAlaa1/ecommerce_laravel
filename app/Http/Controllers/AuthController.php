<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'username'=>'required|max:20',
            'useremail'=>'required|unique:App\Models\User,email',
            'password'=>'confirmed:password_confirmation|required|gt:4'
        ]);
        
        $user=User::create([
            'name'=>$request->username,
            'email'=>$request->useremail,
            'password'=>Hash::make($request->password),
            'role' => 'user'
        ]);
        
        $token = Auth::guard('api')->login($user);
        $user->token = $token;
        
        return response()->json([
            'token' => $token,
            'redirect_url' => route('home.index'),
        ]);
    }
    

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::guard('api')->user();

        return response()->json([
            'token' => $token,
            'redirect_url' => $user->role === 'admin' ? '/admin' : '/home',
        ]);
    }


    public function logout(Request $request)
    {
        $token = $request->input('token'); 

        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 400);
        }

        try {
            JWTAuth::setToken($token)->invalidate(); 
            return response()->json([
                'msg' => 'success',
                'redirect_url' => route('home.index')
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Logout failed', 'details' => $e->getMessage()], 500);
        }
    }

    public function refresh(Request $request){
        $newToken=JWTAuth::parseToken()->refresh();
        if($newToken){
            return response()->json(['msg'=>$newToken]);
        }else{
            return response()->json(['msg'=>"Error"]);
        }
    }
    
}
