@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="">
                <h2>Create Roles And Permission Choose</h2>
            </div>
        </div>
      
    </div>
    
    
   
    <div class="row">
        <div class="col-12">
           <div class="card mb-3">
            <div class="card-header">
                Create Role And Choose Permission
            </div>
            <div class="card-body">
                <form method="post" action="{{route('admin.roles-and-permission.store')}}">
                    @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label>Role Name</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}">
                    </div>
                    
                   
                    <div class="col-md-6">
                        <label>Choose Permission</label>
                            @if(count($permissions)>0)
                            @foreach ($permissions as $key=>$permission)
                            <div class="form-check">
                                <input class="form-check-input" name="permissions[]" type="checkbox" value="{{$permission->id}}" id="flexCheckDefault{{$key}}">
                                <label class="form-check-label" for="flexCheckDefault{{$key}}">
                                    @php
                                    $name=str_replace("-", " ",$permission->name );
                                  @endphp
                                  {{ucwords($name)}}
                                </label>
                              </div>
                            @endforeach
                            @endif
                        
                    </div>
                    <div class="col-6 mt-4">
                        <button type="submit" class="btn btn-primary">Create Role</button>
                    </div>
                </div>
                </form>
            </div>
           </div>
        </div>
        <a href="{{route('admin.roles-and-permission.index')}}">
        <button class="btn btn-secondary"> <-- Go Back</button>
        </a>
    </div>
</div>







@endsection