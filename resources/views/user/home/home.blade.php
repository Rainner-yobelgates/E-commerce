@extends('layouts.user')
@section('title', 'Home')
@section('content')
@if(session('success'))
<script>
    iziToast.success({
        title: 'Success',
        message: "{{session('success')}}",
    });
</script>
@endif
@if(session('error'))
<script>
    iziToast.warning({
        title: 'Error',
        message: "{{session('error')}}",
    });
</script>
@endif
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="image/user/banner/3.jpg" height="480" style="object-fit: cover; " class="d-block w-100">
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="image/user/banner/2.jpg" height="480" style="object-fit: cover; " class="d-block w-100">
      <div class="carousel-caption d-none d-md-block">
        <h5>Second slide label</h5>
        <p>Some representative placeholder content for the second slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="image/user/banner/1.jpg" height="480" style="object-fit: cover; " class="d-block w-100">
      <div class="carousel-caption d-none d-md-block">
        <h5>Third slide label</h5>
        <p>Some representative placeholder content for the third slide.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<div class="bg-light py-3">
  <div class="container">
    <div class="row">
      <div class="head shadow-sm bg-dark mt-4 mb-3 rounded">
        <h3 class="p-3 my-auto text-white">New Product</h3>
      </div>
      <div class="owl-carousel p-2">
        @foreach($latest as $product)
        <a class="nav-link p-0" href="{{ route('detail', $product->slug)}}">
          <div class="item d-flex justify-content-center">
            <div class="card rounded shadow-sm">
              <img src="image/admin/product/{{$product->image}}" class="card-img-top img-fluid" style="object-fit: cover; height: 200px;" alt="...">
              <div class="card-body latest px-3 pt-2 pb-0">
                <p class="card-title h6">{{Str::limit($product->name,'25','')}}</p>
                <p class="h6 text-dark">Rp. {{number_format($product->price)}},-</p>
              </div>
            </div>
          </div>
        </a>
        @endforeach
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="head shadow-sm bg-dark mt-5 mb-3 rounded">
      <h3 class="p-3 my-auto text-white">All Product</h3>
    </div>
    @foreach($products as $product)
    <div class="col-lg-2 col-md-4 col-6 px-2">
      <a class="nav-link p-0" href="{{ route('detail', $product->slug)}}">
        <div class="card rounded shadow-sm mb-3">
          <img src="image/admin/product/{{$product->image}}" class="card-img-top img-fluid" style="object-fit: cover; height: 180px;" alt="...">
          <div class="card-body all px-3 pt-2 pb-0">
            <p class="card-title h6">{{Str::limit($product->name,'25','')}}</p>
            <p class="h6">Rp. {{number_format($product->price)}},-</p>
          </div>
          <div class="d-flex justify-content-center mb-2">
            <a href="{{ route('storeCart', $product->slug) }}" style="font-size: 14px;" class="btn btn-dark me-1"><i class="fas fa-shopping-cart "></i> Cart</a>
            <a href="{{ route('detail', $product->slug)}}" style="font-size: 14px;" class="btn btn-primary"><i class="fas fa-info-circle text-light"></i> Detail</a>
          </div>
        </div>
      </a>
    </div>
    @endforeach
  </div>
</div>
<div class="text-center">
  <a class="btn btn-dark my-4" href="#">View More <i class="fas fa-chevron-right"></i></a>
</div>
@stop