@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="">
                <h2>Users Management</h2>
            </div>
        </div>
        @can('user-create')
        <div class="col-6">
            <div class="d-flex justify-content-end">
                <a class="btn btn-success justify-content-end" href="{{ route('admin.users.create') }}"> Create New User</a>
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
                  <th>Email</th>
                  <th>Roles</th>
                  <th width="280px">Action</th>
                </tr>
                @if(count($users)>0)
                @foreach ($users as $i => $user)
                 <tr>
                   <td>{{ ++$i }}</td>
                   <td>{{ $user->name }}</td>
                   <td>{{ $user->email }}</td>
                   <td>
                     @if(!empty($user->getRoleNames()))
                       @foreach($user->getRoleNames() as $v)
                          <label class="badge bg-success">{{ $v }}</label>
                       @endforeach
                     @endif
                   </td>
                   <td>
                    @can('user-list')
                      <a class="btn btn-info" href="{{ route('admin.users.show',base64_encode($user->id)) }}">Show</a>
                      @endcan
                      @can('user-edit')
                      <a class="btn btn-primary" href="{{ route('admin.users.edit',base64_encode($user->id)) }}">Edit</a>
                      @endcan
                      @if(auth()->user()->email!==$user->email)
                      <a class="btn btn-primary" href="{{ route('admin.users.delete',base64_encode($user->id)) }}">Delete</a>
                      @endif
                   </td>
                 </tr>
                @endforeach
                @endif
               </table>
        </div>
       
    </div>
</div>







@endsection