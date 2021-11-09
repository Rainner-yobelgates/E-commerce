@extends('layouts.user')
@section('title','Carts')
@section('content')
@if(session('success'))
<script>
    iziToast.success({
        title: 'Success',
        message: "{{session('success')}}",
    });
</script>
@endif
<div class="container" style="margin-top: 100px;">
    <div class="mt-3">
        @if(session()->get('cart'))
        <p class="h5">You have <span class="text-success">{{ count(session()->get('cart')) }}</span> Items in the cart</p>
        @else
        <p class="h5">You have <span class="text-success">0</span> Items in the cart</p>
        @endif
    </div>

    <div class="row d-flex justify-content-between">
        <div class="col-lg-8 shadow px-0">
            <div>
                <table class="table mb-5" style="border-radius: 15px; width: 100%;">
                    <thead class="table-dark">
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(session()->get('cart'))
                        @foreach(session('cart') as $id => $details)
                        <?php $total = 0;
                        $total = $details['price'] * $details['amount'] ?>
                        <tr>
                            <td>
                                <img class="img-thumbnail" src="image/admin/product/{{$details['image']}}" style="object-fit: cover; height: 80px; width: 80px;" alt="">
                            </td>
                            <td>
                                <p class="h5 my-2">{{Str::limit($details['name'],'27','...')}}</p>
                                <!-- Komputer -->
                                <p class="h6 text-primaryfont-weight-bolder">Rp. {{number_format($details['price'])}}</p>
                            </td>
                            <td>
                                <input style="width: 80px;" data-id="{{$id}}" type="number" value="{{$details['amount']}}" class="form-control update-cart mt-2" />
                            </td>
                            <td>
                                <p class="h5 mt-2 text-success font-weight-bolder">Rp. {{number_format($total)}},-</p>
                            </td>
                            <td>
                                <button type="button" data-id="{{$id}}" class="btn btn-danger remove-from-cart"><i class="fa fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="5">
                                <p class="h5 text-center">No items, <a href="/">Lets shopping now</a></p>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="px-0 shadow" style="border-radius: 15px;">
                <div class="bg-dark py-2">
                    <p class="h3 text-white text-center">Shopping Summary</p>
                </div>
                <div class="p-4">
                    <?php
                    $total_price = 0;
                    $total_amount = 0;
                    $total_weight = 0;
                    ?>
                    @if(session()->get('cart'))
                    @foreach(session('cart') as $id => $fill)
                    <?php
                    $total_price += $fill['price'] * $fill['amount'];
                    $total_amount += $fill['amount'];
                    $total_weight += $fill['weight'] * $fill['amount'];
                    ?>
                    @endforeach
                    @endif
                    <div>
                        <p style="font-size: 18px;" class="font-weight-bolder">Total amount <span class="text-primary">{{$total_amount}} Items</span></p>
                    </div>
                    <div>
                        <p style="font-size: 18px;" class="font-weight-bolder">Total weight <span class="text-primary">{{$total_weight}} g</span></p>
                    </div>
                    <div>
                        <p style="font-size: 18px;" class="font-weight-bolder">Total price <span class="text-success">Rp. {{number_format($total_price)}},-</span></p>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <a class="btn btn-dark" href="/"><i class="fas fa-chevron-left mr-2"></i> Back</a>
                        @if(Auth::check())
                        @if(session()->get('cart'))
                        <a class="btn btn-success" href="{{ route('checkout') }}">Checkout <i class="fas fa-check"></i></a>
                        @endif
                        @else
                        <a class="btn btn-success" href="{{ route('login') }}">Checkout <i class="fas fa-check"></i></a>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@stop