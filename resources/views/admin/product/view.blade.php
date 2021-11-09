@extends('layouts.admin')
@section('title', 'View Detail Product')
@section('route')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{ route('product') }}">Product</a></li>
    <li class="breadcrumb-item"><a href="#">View</a></li>
</ol>
@stop
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img class="img-fluid shadow img-thumbnail" src="/image/admin/product/{{$product->image}}" style="border-radius: 25px; height: 450px; object-fit: cover;" alt="">
                        </div>
                        <div class="col-md-6">
                            <h3 class="text-bold">{{Str::limit($product->name, '50', '')}}</h3>
                            <hr>
                            <h5>{!!$product->description!!}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop