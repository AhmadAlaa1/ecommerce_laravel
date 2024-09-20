<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index(){
        $shirts=Product::where("category_id",1)->get();
        $jackets=Product::where("category_id",2)->get();
        $shorts=Product::where("category_id",3)->get();
        $bestProducts=Product::where("rating",'>',2)->get();
        $categories=Category::all();
        $comments=Comment::all();
        return view('home.index',['shirts'=>$shirts,
                                               'jackets'=>$jackets,
                                               'shorts'=>$shorts,
                                               'categories'=>$categories,
                                               'bestProducts'=>$bestProducts,
                                               'comments'=>$comments,
                                              ]);
    }

    public function login(){
        Session::put('previousPage',url()->previous());
        return view('home.login');
    }

    public function loginauth(Request $request){
        $request->validate([
            'username'=>['required'],
            'password'=>['required'],
            'useremail'=>['required','email:filter'],
        ]);

        $username = $request->username;
        $password = $request->password;
        $email = $request->useremail;
        $user=User::where("email",$email)->first();
        if (is_null($user)) {
            return redirect()->back()->with('error', 'User does not exist');
        } elseif ($username != $user->name || !Hash::check($password, $user->password)) {
            return redirect()->back()->with('error', 'Incorrect username or password');
        } else {
            Session::put('username',$username);
            Session::put('password',$password);
            Session::put('email',$email);
            Session::put('user_id',$user->id);
            return redirect()->to(Session::get('previousPage'))->with('success', 'Login Successfully');
        }
        
    }

    public function register(){
        return view('home.register');
    }


    public function registerauth(Request $request){
            
        $request->validate([
            'username'=>['required'],
            'password'=>['required','confirmed'],
            'useremail'=>['required','email:filter'],
        ]);

        $username = $request->username;
        $password = $request->password;
        $email = $request->useremail;

        $user=User::where("email",$email)->first();
        
        if (is_null($user)) {
            User::create([
                'name'=>$username,
                'email'=>$email,
                'password'=>$password,
            ]);
            return redirect('home/login')->with('success', 'Registered Successfully');

        }else {
            return redirect()->back()->with('error', 'The User Exists');
            
        }   
    }

    public function logout(){
        Session::flush();
        return to_route('home.index');
    }
}

