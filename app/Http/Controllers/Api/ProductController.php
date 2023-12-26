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
        $products= \App\Models\Product::orderBy('id','desc');
        return response()->json([
            'success' => true,
            'message' => 'List Data Product',
            'data'=> $products
        ],200);
    }

   /**
    * store a newly created resource in storage.
    */
    public function store(Request $request)
    {
        $data = $request->all();
    }

    /*
     * Display the specified resource.
    */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
