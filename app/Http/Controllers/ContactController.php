<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index(){
        return view('contact.index');
    }

    public function store(Request $request){
        $request->validate([
            'report'=>['required']
        ]);

        Report::create([
            'user_id'=>Session::get('user_id'),
            'message'=>$request->report,
        ]);
        
        return redirect('contact')->with('success','Report Sent Successfully');
    }
}
