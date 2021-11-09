@extends('layouts.user')
@section('title', 'Category ' . $category->name)
@section('content')
<div class="container">
    <div class="row">
        <div class="bg-dark category-title mb-4" style="margin-top: 100px;">
            <h3 class="text-light p-3 mb-0">Kategori {{$category->name}}</h3>
        </div>
        <div class="col-lg-3 col-md-4">
            <div class="card shadow mb-3">
                <a style="text-decoration: none;" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <div class="card-header bg-dark">
                        <div class="text-light d-flex justify-content-between align-items-center">
                            <h5>Filter</h5>
                            <i class="fas fa-filter"></i>
                        </div>
                    </div>
                </a>
                <div class="card-body collapse show" id="collapseExample">
                    <p class="medium mb-1 fw-bold">Sort</p>
                    <div class="links">
                        <a href="?sort=latest" class="text-muted">
                        <i class="fas fa-angle-right"></i>
                            Latest</a>
                        <a href="?sort=az" class="text-muted">
                        <i class="fas fa-angle-right"></i>
                            Alphabet A-Z</a>
                        <a href="?sort=za" class="text-muted">
                        <i class="fas fa-angle-right"></i>
                            Alphabet Z-A</a>
                        <a href="?sort=low_price" class="text-muted">
                        <i class="fas fa-angle-right"></i>
                            Lowest Price</a>
                        <a href="?sort=high_price" class="text-muted">
                        <i class="fas fa-angle-right"></i>
                            Highest Price</a>
                    </div>
                    <hr>
                    <p class="medium mb-1 fw-bold">Price</p>
                    <form id="filter" type="get">
                        <div class="form-group d-flex align-items-center">
                            <input type="number" placeholder="Min" class="form-control" value="100000" name="min">
                            <div class="mx-2">-</div>
                            <input type="number" placeholder="Max" class="form-control" value="5000000" name="max">
                        </div>
                    </form>
                    <div class="d-flex align-items-center mt-3">
                        <a href="{{ route('home.category', $category->slug) }}" style="width: 100%;" class="btn btn-danger">Reset</a>
                        <button form="filter" class="btn btn-dark" style="width: 100%;">Apply</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-8">
            <div class="row">
                @foreach($products as $product)
                <div class="col-lg-3 col-md-4 col-6 px-1">
                    <a href="" class="nav-link p-0">
                        <div class="card rounded shadow mb-3">
                            <img src="/image/admin/product/{{$product->image}}" class="card-img-top img-fluid" style="object-fit: cover; height: 180px;" alt="...">
                            <div class="card-body all px-3 pt-2 pb-0">
                                <p class="card-title h6">{{Str::limit($product->name,'25','')}}</p>
                                <p class="h6">Rp. {{number_format($product->price)}},-</p>
                            </div>
                            <div class="d-flex justify-content-center mb-2">
                                <a href="{{ route('storeCart', $product->slug) }}" style="font-size: 15px;" class="btn btn-dark me-1"><i class="fas fa-shopping-cart "></i> Cart</a>
                                <a href="{{ route('detail', $product->slug)}}" style="font-size: 15px;" class="btn btn-primary"><i class="fas fa-info-circle text-light"></i> Detail</a>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@stop