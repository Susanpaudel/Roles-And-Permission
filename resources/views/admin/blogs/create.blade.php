@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="">
                <h2>Create Blog</h2>
            </div>
        </div>
      
    </div>
    
    
   
    <div class="row">
        <div class="col-12">
           <div class="card mb-3">
            <div class="card-header">
                Create Blog
            </div>
            <div class="card-body">
                <form method="post" action="{{route('admin.blogs.store')}}" enctype="multipart/form-data">
                    @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" value="{{old('title')}}">
                    </div>
                    <div class="col-md-6">
                        <input class="form-check-input" name="display" type="checkbox" value="1" id="flexCheckDefault" checked>
                                <label class="form-check-label" for="flexCheckDefault">
                                   Display
                                </label>
                    </div>
                    <div class="col-md-6">
                        <label>Image</label>
                        <input type="file" step="any" class="form-control" name="image">
                    </div>
                    <div class="col-md-6">
                        <label>Description</label>
                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{old('description')}}</textarea>
                    </div>
                    
                    <div class="col-6 mt-4">
                        <button type="submit" class="btn btn-primary">Create blog</button>
                    </div>
                </div>
                </form>
            </div>
           </div>
        </div>
        <a href="{{route('admin.blogs.index')}}">
        <button class="btn btn-secondary"> <-- Go Back</button>
        </a>
    </div>
</div>







@endsection