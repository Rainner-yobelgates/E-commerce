@extends('layouts.admin')
@section('title', 'Create Category')
@section('route')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{ route('category') }}">Category</a></li>
    <li class="breadcrumb-item"><a href="#">Create</a></li>
</ol>
@stop
@section('content')
<div>
    <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <label class="h6" for="">Name</label>
                        @error('name') <div class="text-danger">{{$message}}</div>@enderror
                        <input class="form-control mb-3" type="text" name="name" placeholder="Name Of Category">
                        <label class="h6 d-block mt-3" for="">Image Category</label>
                        @error('img') <div class="text-danger">{{$message}}</div>@enderror
                        <input type="file" name="img">
                    </div>
                    <button type="submit" class="btn btn-dark ml-1 mt-3">Create Category</button>
                </div>
            </div>
        </div>
    </form>
</div>
@stop