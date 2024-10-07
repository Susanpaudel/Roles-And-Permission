@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="">
                <h2>Edit Users</h2>
            </div>
        </div>
      
    </div>
    
    
   
    <div class="row">
        <div class="col-12">
           <div class="card mb-3">
            <div class="card-header">
                Edit User Info
            </div>
            <div class="card-body">
                <form method="post" action="{{route('admin.users.update',base64_encode($user->id))}}">
                    @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label>Ful Name</label>
                        <input type="text" class="form-control" name="name" value="{{old('name',$user->name)}}">
                    </div>
                    <div class="col-md-6">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" value="{{old('email',$user->email)}}">
                    </div>
                    <div class="col-md-6">
                        <label>New Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="col-md-6">
                        <label>Role</label>
                        <select class="form-control" name="roles[]" multiple>
                            @foreach ($roles as $role)
                            <option value="{{$role->id}}"  {{ old('role') == $role->id || $user->roles->pluck('id')->contains($role->id) ? 'selected' : '' }}>{{$role->name}}</option>
                            @endforeach
                           
                        </select>
                    </div>
                    <div class="col-6 mt-4">
                        <button type="submit" class="btn btn-primary">Edit Data</button>
                    </div>
                </div>
                </form>
            </div>
           </div>
        </div>
        <a href="{{route('admin.users.index')}}">
        <button class="btn btn-secondary"> <-- Go Back</button>
        </a>
    </div>
</div>







@endsection