@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="">
                <h2>Show Role with Permissions</h2>
            </div>
        </div>
      
    </div>
    
    
   
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered">
                <tr>
                  <th>Role Name</th>
                  <th>{{$role->name}}</th>
                </tr>
               
                <tr>
                  <th>Permission</th>
                  <td>@if(!empty($role->permissions))
                    @foreach ($role->permissions as $v)
                    @php
                    $name=str_replace("-", " ",$v->name );
                  @endphp
                  <label class="badge bg-success">{{ ucwords($name)}}</label>
                    @endforeach
                
                  @endif</td>
                </tr>
               
                

               </table>
        </div>
        <a href="{{route('admin.roles-and-permission.index')}}">
        <button class="btn btn-secondary"> <-- Go Back</button>
        </a>
    </div>
</div>



 



@endsection