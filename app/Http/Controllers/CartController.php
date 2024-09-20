<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Product;


class CartController extends Controller
{
    public function index(){
        $products=Session::get('orders');
        $orders=[];
        if(Session::has('orders')){
            foreach($products as $product){
                $orders[]=Product::where('name',$product)->first();
            }
        }else{
            return to_route('home.index');
        }

        return view('cart.index',['orders'=>$orders]);
    }

    
    public function store(Request $request) {
    
        $orders = Session::get('orders', []);

        if (in_array($request->name, $orders)) {
            return redirect()->back()->with('error', 'This item has already been added to your cart.');
        } else {
            Session::push('orders',$request->name);
            return redirect()->back()->with('success', 'Item added to your cart successfully.');
        }
    }

    public function update(Request $request){
        $orders=Session::get('orders');
        $item=array_search($request->item,$orders);
        unset($orders[$item]);
        Session::put('orders', array_values($orders)); 
        return redirect()->back();
    }
}
