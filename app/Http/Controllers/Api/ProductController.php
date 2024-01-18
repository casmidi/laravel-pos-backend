<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        //get data products
        // $products = \App\Models\Product::orderBy('id','desc')->get();
        $products = \App\Models\Product::orderBy('id', 'desc')->get();
        return response()->json([
            'success' => true,
            'message' => 'List Data Product',
            'data' => $products
        ], 200);
    }

    /**
     * store a newly created resource in storage.
     */
    public function create()
    {
        return view('pages.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'category' => 'required|in:food,drink,snack',
            'image' => 'required|image|mimes:png,jpg,jpeg'
        ]);

        $filename = uniqid() . '.' . $request->image->extension();
        $request->image->storeAs('public/products', $filename);
        $product = \App\Models\Product::create([
            'name' => $request->name,
            'price' => (int) $request->price,
            'stock' => (int) $request->stock,
            'category' => $request->category,
            'image' => $filename,
            'is_best_seller' => $request->is_best_seller
        ]);

        if ($product){
            return response()->json([
                'success' => true,
                'message'=>'Product Create',
                'data'=>$product
            ],201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Product Failed to Save',
            ],409);
        }
    }

    /*
     * Display the specified resource.
    */
    public function show(string $id)
    {
        // $id = "casmidi asli";
        // return $id;
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $product = \App\Models\Product::findOrFail($id);
        $product->update($data);
        return redirect()->route('product.index')->with('success', 'Product successfully update');
    }

    public function destroy($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product successfully deleted');
    }
}
