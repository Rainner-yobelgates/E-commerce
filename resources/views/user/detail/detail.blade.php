@extends('layouts.user')
@section('title', 'Detail ' . $product->name)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="head bg-dark rounded mt-3">
                <h3 class="text-white px-5 py-3">Detail Product</h3>
            </div>
            <div class="card border-0 shadow mt-3">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-5">
                            <img class="img-thumbnail img-fluid" src="/image/admin/product/{{$product->image}}" name="img" style="object-fit: cover; width: 400px; height: 400px;">
                        </div>
                        <div class="col-lg-7">
                            <h2 style="height: 75px;" class="name text-dark">{{Str::limit($product->name,'60','')}}</h2>
                            <hr>
                            <form action="{{ route('storeCart', $product->slug) }}" method="get">
                                <table class="table table-borderless detail">
                                    <tr>
                                        <td>Price</td>
                                        <td class="d-flex justify-content-between">{{number_format($product->price)}},-</td>
                                    </tr>
                                    <tr>
                                        <td>Weight</td>
                                        <td class="d-flex justify-content-between">{{$product->weight}}</td>
                                    </tr>
                                    <tr>
                                        <td>Condition</td>
                                        <td class="d-flex justify-content-between">{{$product->condition}}</td>
                                    </tr>
                                    <tr>
                                        <td>stock</td>
                                        <td class="d-flex justify-content-between">{{$product->stock}}</td>
                                    </tr>
                                    @csrf
                                    <tr>
                                        <td>Amount</td>
                                        <td class="d-flex justify-content-between"><input type="number" class="form-control w-50" value="1" name="amount" min="1" max="{{$product->stock}}"></td>
                                    </tr>
                                </table>
                                <hr>
                                <button class="btn btn-dark" type="submit">Add To Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card border-0 shadow my-5">
                <div class="card-body">
                    <h3>Description</h3>
                    <hr>
                    <p class="h5">{!!$product->description!!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@stop