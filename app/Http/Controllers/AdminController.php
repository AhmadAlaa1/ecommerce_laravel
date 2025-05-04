<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class AdminController extends Controller
{
    public function index(){
         return view('admin.index');
    }

    public function getAllusers(Request $request)
    {
       $token = $request->token;
       $users = User::all();
       foreach($users as $user){
        $user->teleNumber = unserialize(Crypt::decryptString($user->teleNumber));
       }
       return $users;
    }
}

