@extends('layouts.admin')
@section('title', 'Edit Product')
@section('route')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{ route('product') }}">Product</a></li>
    <li class="breadcrumb-item"><a href="#">Edit</a></li>
</ol>
@stop
@section('content')
@if(session('error'))
<script>
    iziToast.error({
        title: 'Error',
        message: "{{session('error')}}",
    });
</script>
@endif
<div>
    <form action="{{ route('product.update', $product->slug) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label class="h6" for="">Name</label>
                        @error('name') <div class="text-danger">{{$message}}</div>@enderror
                        <input class="form-control mb-3" type="text" name="name" placeholder="Name Of Product" value="{{$product->name}}">
                        <label class="h6" for="">Stock</label>
                        @error('stock') <div class="text-danger">{{$message}}</div>@enderror
                        <input class="form-control mb-3" type="text" name="stock" placeholder="Stock Of Product" value="{{$product->stock}}">
                        <label class="h6" for="">Condition</label>
                        <select class="form-control mb-3" id="inputGroupSelect02" name="condition">
                            @if($product->condition == "New")
                            <option value="{{$product->condition}}" selected>{{$product->condition}}</option>
                            <option value="Second">Second</option>
                            @else
                            <option value="New">New</option>
                            <option value="{{$product->condition}}" selected>{{$product->condition}}</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="h6" for="">Price</label>
                        @error('price') <div class="text-danger">{{$message}}</div>@enderror
                        <input class="form-control mb-3" type="text" name="price" placeholder="Price Of Product" value="{{$product->price}}">
                        <label class="h6" for="">Weight</label>
                        @error('weight') <div class="text-danger">{{$message}}</div>@enderror
                        <input class="form-control mb-3" type="text" name="weight" placeholder="Weight Of Product ( g )" value="{{$product->weight}}">
                        <label class="h6" for="">Category</label>
                        <select class="form-control mb-3" id="inputGroupSelect02" name="category_id">
                            <option class="text-primary" disabled>--- Selected ---</option>
                            @if(!empty($product->category->name))
                            <option value="{{$product->category->id}}" selected>{{$product->category->name}}</option>
                            @else
                            <option value="Null">No Category</option>
                            @endif
                            <option class="text-primary" disabled>--- Category ---</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-12">
                        <label for="" class="h4">Description Product</label>
                        @error('description') <div class="text-danger">{{$message}}</div>@enderror
                        <textarea id="summernote" name="description">{{$product->description}}</textarea>
                        <div>
                            <label class="h6 d-block mt-3" for="">Image</label>
                            <img class="img-thumbnail mr-3" src="/image/admin/product/{{$product->image}}" style="height: 100; width: 100px; object-fit: cover;" alt="">
                            @error('img') <div class="text-danger">{{$message}}</div>@enderror
                            <input type="file" name="img">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark ml-3 mt-3">Edit Product</button>
                </div>
            </div>
        </div>
    </form>
</div>
@stop