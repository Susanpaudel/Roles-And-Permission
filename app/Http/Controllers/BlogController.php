<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function __construct(){
        $this->middleware('permission:blog-list|blog-create|blog-edit|blog-delete',['only'=>['index','show']]);
        $this->middleware('permission:blog-create',['only'=>['create','store']]);
        $this->middleware('permission:blog-edit',['only'=>['edit','update']]);
        $this->middleware('permission:blog-delete',['only'=>['destory']]);
   }
   public function index(){
       $blogs=Blog::latest()->get();
       return view('admin.blogs.list',compact('blogs'));
   }
   public function create(){
       return view('admin.blogs.create');
   }

   public function store(Request $request){
       $request->validate([
           'title'=>'required',
           'image'=>'required|mimes:png,jpeg,jpeg|max:9000',
           'description'=>'nullable',
       ]);
       $blog=new Blog();
       $blog->title=$request->title;
       $blog->display=$request->display?1:0;
       $blog->description=$request->description;
       $folderName = 'blog';
       if (!Storage::exists($folderName)) {
        Storage::makeDirectory($folderName, 0777, true); // Create with permissions
        }
       if($request->image){
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName(); 
        $path = $image->storeAs($folderName, $imageName, 'public');
        $blog->image=$imageName;
       }
       $blog->save();
   
       return redirect()->route('admin.blogs.index')->with('success','blog has been created!');
   }

   public function show($id){
     
       $blog=blog::find(base64_decode($id));
       if(!$blog){
           return back()->with('error','blog data not found!');
       }
       return view('admin.blogs.show',compact('blog'));
   }
   public function edit($id){
       $blog=blog::find(base64_decode($id));
       if(!$blog){
        return back()->with('error','blog not found!');
       }
       return view('admin.blogs.edit',compact('blog'));
   }

   public function update(Request $request,$id){
    $blog=Blog::find($id);
    if(!$blog){
        return back()->with('error','Blog Data not found!!');
    }
    $request->validate([
        'title'=>'required',
        'image'=>'nullable|mimes:png,jpeg,jpg|max:9000',
        'description'=>'nullable',
    ]);
    $blog->title=$request->title;
    $blog->display=$request->display?1:0;
    $blog->description=$request->description;
    $folderName = 'blog';
    if (!Storage::exists($folderName)) {
     Storage::makeDirectory($folderName, 0777, true); 
     }
    if($request->image){
     $oldImage= $blog->image;
     $image = $request->file('image');
     $imageName = time() . '_' . $image->getClientOriginalName(); 
     $path = $image->storeAs($folderName, $imageName, 'public');
     Storage::delete('public/blog/'.$oldImage); 
     $blog->image=$imageName;
    }
    $blog->save();

    return redirect()->route('admin.blogs.index')->with('success','blog has been Updated!');

   }

   public function destroy($id){
       $blog=Blog::find(base64_decode($id));
       if(!$blog){
        return back()->with('error','Blog not found!');
       }
       Storage::delete('public/blog/'.$blog->image);
       $blog->delete();
       return back()->with('success','Blog has been deleted');
   }
}
