@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="">
                <h2>Show Blogs</h2>
            </div>
        </div>
      
    </div>
    
    
   
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered">
                <tr>
                  <th>Title</th>
                  <th>{{$blog->title}}</th>
                </tr>
                <tr>
                  <th>Display</th>
                  <th>{{$blog->display==1?'True':'False'}}</th>
                </tr>
                <tr>
                  <th>Image</th>
                  <th><img src="{{asset('storage/blog/'.$blog->image)}}" alt="" style="height: 80px;width:auto;"/></th>
                </tr>
                <tr>
                  <th>Description</th>
                  <th>{{$blog->description}}</th>
                </tr>
               
                

               </table>
        </div>
        <a href="{{route('admin.blogs.index')}}">
        <button class="btn btn-secondary"> <-- Go Back</button>
        </a>
    </div>
</div>



 



@endsection