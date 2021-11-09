@extends('layouts.admin')
@section('title', 'Edit Category')
@section('route')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{ route('category') }}">Category</a></li>
    <li class="breadcrumb-item"><a href="#">Edit</a></li>
</ol>
@stop
@section('content')
<div>
    <form action="{{ route('category.update', $category->slug) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <label class="h6" for="">Name</label>
                        @error('name') <div class="text-danger">{{$message}}</div>@enderror
                        <input class="form-control mb-3" type="text" name="name" placeholder="Name Of Category" value="{{$category->name}}">
                        <label class="h6 d-block mt-3" for="">Icon Category</label>
                        <img class="img-thumbnail mr-3" src="/image/admin/category/{{$category->icon}}" style="height: 150; width: 150px; object-fit: cover;" alt="">
                        @error('img') <div class="text-danger">{{$message}}</div>@enderror
                        <input type="file" name="img">
                    </div>
                    <button type="submit" class="btn btn-dark ml-3 mt-3">Edit Category</button>
                </div>
            </div>
        </div>
    </form>
</div>
@stop