<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        //get data products
        // $products = \App\Models\Product::paginate(10);
        $products=DB::table('products')
            ->when($request->input('name'), function($query,$name) {
                return $query->where('name','like','%'.$name.'%');
            })
            ->orderBy('created_at','desc')
            ->paginate(10);
        //sort by created_at desc
        // $products->sortByDesc('created_at');

        return view('pages.products.index',compact('products'));
    }

    public function create()
    {
        return view('pages.products.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        \App\Models\Product::create($data);
        return redirect()->route('product.index')->with('success','Product successfully created');
    }

    public function edit($id)
    {
        $product= \App\Models\Product::findOrFail($id);
        return view('pages.products.edit',compact('product'));
    }

    public function update(Request $request, $id)
    {

        $data = $request->all();
        // dd($data);
        $product = \App\Models\Product::findOrFail($id);
        $product->update($data);
        return redirect()->route('product.index')->with('success','Product successfully update');
    }

    public function destroy($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $product->delete();
        return redirect()->route('product.index')->with('success','Product successfully deleted');
    }

}
