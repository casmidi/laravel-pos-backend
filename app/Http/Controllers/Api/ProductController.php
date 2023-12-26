<?php

namespace App\Http\Controllers;

// use App\Http\Controller\Controller;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductController2 extends Controller
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

    public function create()
    {
        return view('pages.products.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
    }

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
