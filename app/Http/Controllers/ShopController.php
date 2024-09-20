<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class ShopController extends Controller
{
    public function index(){
        $categories = Category::all();
        $products=Product::paginate(5);
        return view("shop.index",['products'=>$products,'categories'=>$categories]);
    }
    
    public function store(Request $request){
        
        $categories = Category::all();

        $request->sorting == "nothing" ? $products=Product::paginate(5) : "";   
        $request->sorting == "name"  ? $products=Product::orderBy('name','asc')->paginate(5) : "";   
        $request->sorting == "price" ? $products=Product::orderBy('price','asc')->paginate(5) : "";
        $request->button_category == "shirts" ? $products=Product::where('category_id','1')->paginate(5) : "";
        $request->button_category == "jackets" ? $products=Product::where('category_id','2')->paginate(5) : "";
        $request->button_category == "shorts" ? $products=Product::where('category_id','3')->paginate(5) : "";    
      
        return view("shop.index",['products'=>$products,'categories'=>$categories]);
    }

    public function show($productName){
        $product = Product::where('name',$productName)->first();
        $comments = Comment::where('product_id',$product->id)->get();
        $categories = Category::all();
        $randomProducts = Product::limit(5)->inRandomOrder()->get();
        return view('shop.show',['product'=>$product , 
                                              'comments'=>$comments ,
                                              'categories'=>$categories ,
                                              'randomProducts'=>$randomProducts
                                             ]);
    }

    public function comment($productName,Request $request){
        
        $singleProduct=Product::where('name',$productName)->first();
        
        $request->validate([
            'usercomment'=>['required']
        ]);
        
        Comment::create([
            'content'=>$request->usercomment,
            'user_id'=>Session::get('user_id'),
            'product_id'=>$singleProduct->id
        ]);
        
        return to_route('shop.show',$productName);
    }

}
