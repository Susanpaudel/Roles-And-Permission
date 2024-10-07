@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="">
                <h2>Products Management</h2>
            </div>
        </div>
        @can('product-create')
        <div class="col-6">
            <div class="d-flex justify-content-end">
                <a class="btn btn-success justify-content-end" href="{{ route('admin.products.create') }}"> Create New Product</a>
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
                  <th>Price</th>
                  <th>Display</th>
                  <th width="280px">Action</th>
                </tr>
                @if(count($products)>0)
                @foreach ($products as $i => $product)
                 <tr>
                   <td>{{ ++$i }}</td>
                   <td>{{ $product->title }}</td>
                   <td>
                    Rs. {{$product->price}}
                   </td>
                   <td>
                    <span class="badge bg-primary">{{$product->display==1?'True':'False'}}</span>
                   </td>
                   <td>
                    @can('product-list')
                      <a class="btn btn-info" href="{{ route('admin.products.show',base64_encode($product->id)) }}">Show</a>
                      @endcan
                      @can('product-edit')
                      <a class="btn btn-primary" href="{{ route('admin.products.edit',base64_encode($product->id)) }}">Edit</a>
                      @endcan
                      @can('product-delete')
                      <a class="btn btn-primary" href="{{ route('admin.products.delete',base64_encode($product->id)) }}">Delete</a>
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