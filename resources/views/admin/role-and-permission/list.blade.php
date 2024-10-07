@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="">
                <h2>Roles Management</h2>
            </div>
        </div>
        @can('role-create')
        <div class="col-6">
            <div class="d-flex justify-content-end">
                <a class="btn btn-success justify-content-end" href="{{ route('admin.roles-and-permission.create') }}"> Create New Roles</a>
            </div>
        </div>
        @endcan
    </div>

    <div class="row">
        <div class="col-12">
            <table class="table table-bordered">
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Permission</th>
                  <th width="280px">Action</th>
                </tr>
                @if(count($roles)>0)
                @foreach ($roles as $i => $role)
                 <tr>
                   <td>{{ ++$i }}</td>
                   <td>{{ $role->name }}</td>
                   <td>
                     @if(!empty($role->permissions))
                       @foreach($role->permissions as $v)
                          @php
                            $name=str_replace("-", " ",$v->name );
                          @endphp
                          <label class="badge bg-success">{{ ucwords($name)}}</label>
                       @endforeach
                     @endif
                   </td>
                   <td>
                    @can('role-list')
                      <a class="btn btn-info" href="{{ route('admin.roles-and-permission.show',base64_encode($role->id)) }}">Show</a>
                      @endcan
                      @can('role-edit')
                      <a class="btn btn-primary" href="{{ route('admin.roles-and-permission.edit',base64_encode($role->id)) }}">Edit</a>
                      @endcan
                      @can('role-delete')
                      <a class="btn btn-primary" href="{{ route('admin.roles-and-permission.delete',base64_encode($role->id)) }}">Delete</a>
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