@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="">
                <h2>Blogs Management</h2>
            </div>
        </div>
        @can('blog-create')
        <div class="col-6">
            <div class="d-flex justify-content-end">
                <a class="btn btn-success justify-content-end" href="{{ route('admin.blogs.create') }}"> Create New blog</a>
            </div>
        </div>
        @endcan
    </div>

    <div class="row">
        <div class="col-12">
            <table class="table table-bordered">
                <tr>
                  <th>No</th>
                  <th>Title</th>
                  <th>Image</th>
                  <th width="280px">Action</th>
                </tr>
                @if(count($blogs)>0)
                @foreach ($blogs as $i => $blog)
                 <tr>
                   <td>{{ ++$i }}</td>
                   <td>{{ $blog->title }}</td>
                   <td>
                  <img src="{{asset('storage/blog/'.$blog->image)}}" alt="" style="height: 80px;width:auto;"/>
                   </td>
                   <td>
                    @can('blog-list')
                      <a class="btn btn-info" href="{{ route('admin.blogs.show',base64_encode($blog->id)) }}">Show</a>
                      @endcan
                      @can('blog-edit')
                      <a class="btn btn-primary" href="{{ route('admin.blogs.edit',base64_encode($blog->id)) }}">Edit</a>
                      @endcan
                      @can('blog-delete')
                      <a class="btn btn-primary" href="{{ route('admin.blogs.delete',base64_encode($blog->id)) }}">Delete</a>
                      @endcan
                   </td>
                 </tr>
                @endforeach
                @endif
               </table>
        </div>
       
    </div>
</div>







@endsection