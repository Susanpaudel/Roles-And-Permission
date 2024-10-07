@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="">
                <h2>Show Users</h2>
            </div>
        </div>
      
    </div>
    
    
   
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered">
                <tr>
                  <th>Name</th>
                  <th>{{$user->name}}</th>
                </tr>
                <tr>
                  <th>Email</th>
                  <th>{{$user->email}}</th>
                </tr>
                <tr>
                  <th>Role</th>
                  <td>@if(!empty($user->getRoleNames()))
                    @foreach($user->getRoleNames() as $v)
                       <label class="badge bg-success">{{ $v }}</label>
                    @endforeach
                  @endif</td>
                </tr>
               
                

               </table>
        </div>
        <a href="{{route('admin.users.index')}}">
        <button class="btn btn-secondary"> <-- Go Back</button>
        </a>
    </div>
</div>







@endsection