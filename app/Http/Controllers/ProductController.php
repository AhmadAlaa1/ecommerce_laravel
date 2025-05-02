<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProductController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'description' => 'nullable|string|max:1000',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');
        $encryptedImage = Crypt::encrypt($imagePath);

        $product = \App\Models\Product::create([
            'name' => $request->product_name,
            'price' => $request->price,
            'image' => $encryptedImage,
            'description' => $request->description,
            'category_id' => $request->category_id
        ]);

        return redirect()->back()->with('success', 'Product uploaded successfully!');
    }

}
