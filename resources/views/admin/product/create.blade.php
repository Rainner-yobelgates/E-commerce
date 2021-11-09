@extends('layouts.admin')
@section('title', 'Create Product')
@section('route')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{ route('product') }}">Product</a></li>
    <li class="breadcrumb-item"><a href="#">Create</a></li>
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
    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <label class="h6" for="">Name</label>
                        @error('name') <div class="text-danger">{{$message}}</div>@enderror
                        <input class="form-control mb-3" type="text" name="name" placeholder="Name Of Product">
                        <label class="h6" for="">Stock</label>
                        @error('stock') <div class="text-danger">{{$message}}</div>@enderror
                        <input class="form-control mb-3" type="text" name="stock" placeholder="Stock Of Product">
                        <label class="h6" for="">Condition</label>
                        <select class="form-control mb-3" id="inputGroupSelect02" name="condition">
                            <option value="New">New</option>
                            <option value="Second">Second</option>
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label class="h6" for="">Price</label>
                        @error('price') <div class="text-danger">{{$message}}</div>@enderror
                        <input class="form-control mb-3" type="text" name="price" placeholder="Price Of Product">
                        <label class="h6" for="">Weight</label>
                        @error('weight') <div class="text-danger">{{$message}}</div>@enderror
                        <input class="form-control mb-3" type="text" name="weight" placeholder="Weight Of Product ( g )">
                        <label class="h6" for="">Category</label>
                        <select class="form-control mb-3" id="inputGroupSelect02" name="category_id">
                            @isset($category))
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                            @else
                            <option value="Null">No Category</option>
                            @endisset
                        </select>
                    </div>
                    <div class="col-lg-12">
                        <label for="" class="h4">Description Product</label>
                        @error('description') <div class="text-danger">{{$message}}</div>@enderror
                        <textarea id="summernote" name="description"></textarea>
                        <label class="h6 d-block mt-3" for="">Image</label>
                        @error('img') <div class="text-danger">{{$message}}</div>@enderror
                        <input type="file" name="img">
                    </div>
                    <button type="submit" class="btn btn-dark ml-1 mt-3">Create Product</button>
                </div>
            </div>
        </div>
    </form>
</div>
@stop