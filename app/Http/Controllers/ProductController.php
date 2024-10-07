<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('permission:product-list|product-create|product-edit|product-delete',['only'=>['index','show']]);
        $this->middleware('permission:product-create',['only'=>['create','store']]);
        $this->middleware('permission:product-edit',['only'=>['edit','update']]);
        $this->middleware('permission:product-delete',['only'=>['destory']]);
   }
   public function index(){
       $products=Product::latest()->get();
       return view('admin.products.list',compact('products'));
   }
   public function create(){
       return view('admin.products.create');
   }

   public function store(Request $request){
       $request->validate([
           'title'=>'required',
           'price'=>'required',
           'description'=>'nullable',
       ]);
       $product=new Product();
       $product->title=$request->title;
       $product->price=$request->price;
       $product->display=$request->display?1:0;
       $product->description=$request->description;
       $product->save();
   
       return redirect()->route('admin.products.index')->with('success','Product has been created!');
   }

   public function show($id){
     
       $product=Product::find(base64_decode($id));
       if(!$product){
           return back()->with('error','Product data not found!');
       }
       return view('admin.products.show',compact('product'));
   }
   public function edit($id){
       $product=Product::find(base64_decode($id));
       if(!$product){
        return back()->with('error','Product not found!');
       }
       return view('admin.products.edit',compact('product'));
   }

   public function update(Request $request,$id){
    $product=Product::find($id);
    if(!$product){
        return back()->with('error','Product Data not found!!');
    }
    $request->validate([
        'title'=>'required',
        'price'=>'required',
        'description'=>'nullable',
    ]);
    $product->title=$request->title;
    $product->price=$request->price;
    $product->display=$request->display?1:0;
    $product->description=$request->description;
    $product->save();

    return redirect()->route('admin.products.index')->with('success','Product has been Updated!');

   }

   public function destroy($id){
       $product=Product::find(base64_decode($id));
       if(!$product){
        return back()->with('error','Product not found!');
       }
       $product->delete();
       return back()->with('success','Product has been deleted');
   }
}
