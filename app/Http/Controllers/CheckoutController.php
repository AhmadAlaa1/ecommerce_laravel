<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function index(){
        $items=Session::get('orders');
        $orders=[];
        foreach($items as $item){
            $product=Product::where('name',$item)->first();
            $orders[]=$product;
        }
        return view('checkout.index',['orders'=>$orders]);
    }
    
    public function store(Request $request){

    }
}
