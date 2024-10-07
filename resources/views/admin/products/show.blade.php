@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="">
                <h2>Show Products</h2>
            </div>
        </div>
      
    </div>
    
    
   
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered">
                <tr>
                  <th>Title</th>
                  <th>{{$product->title}}</th>
                </tr>
                <tr>
                  <th>Price</th>
                  <th>Rs. {{$product->price}}</th>
                </tr>
                <tr>
                  <th>Description</th>
                  <th>{{$product->description}}</th>
                </tr>
               
                

               </table>
        </div>
        <a href="{{route('admin.products.index')}}">
        <button class="btn btn-secondary"> <-- Go Back</button>
        </a>
    </div>
</div>



 



@endsection