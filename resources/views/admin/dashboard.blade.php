@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                  
                    <div class="row">
                      @can('product-list')
                        <div class="col-md-4">
                            <div class="card mb-3" style="">
                              
                                <div class="card-body">
                                  <h5 class="card-title">{{App\Models\Product::count()}}</h5>
                                  <p class="card-text">Products</p>
                                  <a href="{{route('admin.products.index')}}" class="btn btn-primary">View Products</a>
                                </div>
                              </div>
                        </div>
                        @endcan
                        @can('blog-list')
                        <div class="col-md-4">
                            <div class="card mb-3" style="">
                              
                                <div class="card-body">
                                  <h5 class="card-title">{{App\Models\Blog::count()}}</h5>
                                  <p class="card-text">Blogs</p>
                                  <a href="{{route('admin.blogs.index')}}" class="btn btn-primary">View Blogs</a>
                                </div>
                              </div>
                        </div>
                        @endcan
                        @can('user-list')
                        <div class="col-md-4">
                            <div class="card mb-3" style="">
                              
                                <div class="card-body">
                                  <h5 class="card-title">{{App\Models\User::count()}}</h5>
                                  <p class="card-text">Users</p>
                                  <a href="{{route('admin.users.index')}}" class="btn btn-primary">View Users</a>
                                </div>
                              </div>
                        </div>
                        @endcan
                        @can('role-list')
                        <div class="col-md-4">
                            <div class="card mb-3" style="">
                              
                                <div class="card-body">
                                  <h5 class="card-title">{{\Spatie\Permission\Models\Role::count()}}</h5>
                                  <p class="card-text">Roles And Permission</p>
                                  <a href="{{route('admin.roles-and-permission.index')}}" class="btn btn-primary">View Roles And Permission</a>
                                </div>
                              </div>
                        </div>
                        @endcan
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection