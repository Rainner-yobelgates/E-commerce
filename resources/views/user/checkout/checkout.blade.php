@extends('layouts.user')
@section('title','Checkout')
@section('content')
<?php
$total_weight = 0;
?>
@foreach(session('cart') as $id => $fill)
<?php
$total_weight += $fill['weight'];
?>
@endforeach
<div class="container">
    <div class="row">
        <div class="bg-dark category-title mb-4" style="margin-top: 100px;">
            <h3 class="text-light p-3 mb-0">Order Data</h3>
        </div>
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    <a href="{{ route('cart') }}" class="btn btn-dark"><i class="fas fa-angle-left"></i> Back</a>
                </div>
                <form action="{{ route('payment') }}" id="checkout" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="fname" class="form-label">First Name</label>
                                    <input type="text" name="fname" class="form-control" id="fname" placeholder="Your First Name">
                                </div>
                                <div class="mb-3">
                                    <label for="province" class="form-label">Province</label>
                                    <select id="province" class="form-control" name="province">
                                        <option value="">Choose Province</option>
                                        @foreach($provinces['results'] as $province)
                                        <option value="{{$province['province_id']}}">{{$province['province']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <select id="city" class="form-control" name="city" disabled>
                                        <option value="">Choose City</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="subdistrict" class="form-label">Subdistricts</label>
                                    <select id="subdistrict" class="form-control" name="subdistrict" disabled>
                                        <option value="">Choose Subdistrict</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="lname" class="form-label">Last Name</label>
                                    <input type="text" name="lname" class="form-control" id="lname" placeholder="Your Last Name">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="number" name="phone" class="form-control" id="phone" placeholder="Your Phone Number">
                                </div>
                                <div class="mb-3">
                                    <label for="postal_code" class="form-label">Postal Code</label>
                                    <input type="text" name="postal_code" class="form-control" id="postal_code" placeholder="Your Postal Code">
                                </div>
                                <div class="mb-3">
                                    <label for="Courier" class="form-label">Courier</label>
                                    <select id="courier" class="form-control" name="courier" disabled>
                                        <option value="">Choose Courier</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" placeholder="Your Full Address" name="address">
                            <div id="emailHelp" class="form-text text-secondary font-italic">Input with your Street name, House number, Building name, etc!</div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="px-0 shadow" style="border-radius: 15px;">
                <div class="bg-dark py-2">
                    <p class="h3 text-white text-center">Payment Detail</p>
                </div>
                <div class="p-3">
                    <table class="table">
                        <?php
                        $total_price = 0;
                        $sub_price = 0;
                        ?>
                        @foreach(session('cart') as $id => $fill)
                        <?php
                        $total_price = $fill['price'] * $fill['amount'];
                        $sub_price += $total_price;
                        ?>
                        <tr>
                            
                            <td class="h6 py-3" style="font-size: 16px;">{{Str::limit($fill['name'],'16','')}}</td>
                            <td class="h6 py-3" style="font-size: 16px;"><span class="text-danger">x</span> {{$fill['amount']}}</td>
                            <td class="h6 py-3" style="font-size: 16px;"><span class="text-success">Rp. {{number_format($total_price)}}</span></td>
                        </tr>
                        @endforeach
                        <tr class="d-none">
                            <td colspan="2" class="h6 py-3">Shipping Costs</td>
                            <td class="h6 py-3 text-success">Rp. <span class="cost"></span></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="h6 py-3">Total</td>
                            <td class="h6 py-3 subtotal text-success">Rp. 0</td>
                        </tr>
                    </table>
                    <p class="h5 my-2"> </p>
                    <div class="d-flex justify-content-between">
                        <a class="btn btn-dark" href="{{ route('cart') }}"><i class="fas fa-chevron-left mr-2"></i> Back</a>
                        <button class="btn btn-success" form="checkout">Pay Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#province').change(function() {
        let province_id = $(this).val()
        console.log(province_id)

        $.ajax({
            url: '/get/cities',
            method: 'POST',
            data: {
                province_id: province_id
            },
            dataType: 'json',
            beforeSend: function() {
                $('#city').html('<option value="" disabled>Loading...</option>')
            },
            success: function(res) {
                $('#city').html(res.result);
                $('#city').removeAttr('disabled');
            },
            error: function(e) {
                console.log(e)
            }
        })
    })

    $('#city').change(function() {
        let city_id = $(this).val();

        $.ajax({
            url: '/get/subdistricts',
            method: 'POST',
            data: {
                city_id: city_id
            },
            dataType: 'json',
            beforeSend: function() {
                $('#subdistrict').html('<option value="" disabled>Loading...</option>')
            },
            success: function(res) {
                $('#subdistrict').html(res.result);
                $('#subdistrict').removeAttr('disabled');
            },
            error: function(e) {
                console.log(e)
            }
        })
    })

    $('#subdistrict').change(function() {
        let subdistrict_id = $(this).val();
        let weight = "{{ $total_weight }}";
        console.log(weight)
        $.ajax({
            url: 'get/service',
            type: 'POST',
            data: {
                subdistrict_id: subdistrict_id,
                weight: weight
            },
            dataType: 'json',
            beforeSend: function() {
                $('#courier').html(`<option value="" disabled>Loading...</option>`)
            },
            success: function(res) {
                $("#courier").html(res.list);
                $("#courier").removeAttr("disabled");
            },
            error: function(e) {
                console.log(e)
            }
        });
    });

    $('#courier').change(function() {
        let courier = $(this).val();
        $.ajax({
            url: 'get/courier',
            type: 'POST',
            data: {
                courier: courier,
                sub_price: "{{$sub_price}}"
            },
            dataType: 'json',
            success: function(res) {
                $('.cost').html(res.cost);
                $('.d-none').removeClass('d-none');
                $('.subtotal').html(res.subtotal);
            },
            error: function(e) {
                console.log(e)
            }
        });
    });
</script>
@stop