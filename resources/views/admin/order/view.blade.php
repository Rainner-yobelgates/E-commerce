@extends('layouts.admin')
@section('title', 'View Detail Order')
@section('route')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{ route('order') }}">Order</a></li>
    <li class="breadcrumb-item"><a href="#">View</a></li>
</ol>
@stop
@section('content')
@if(session('success'))
<script>
    iziToast.success({
        title: 'Success',
        message: "{{session('success')}}",
    });
</script>
@endif
<?php
$province = rajaongkir('https://api.rajaongkir.com/starter/province?key=1cb6ca038ddb281f174dbc4264474df0&id=' . $invoice->province, 'GET');
$city = rajaongkir('https://api.rajaongkir.com/starter/city?key=1cb6ca038ddb281f174dbc4264474df0&id=' . $invoice->city . '&province=' . $invoice->province, 'GET');
$subdistrict = rajaongkir('https://pro.rajaongkir.com/api/subdistrict?key=1cb6ca038ddb281f174dbc4264474df0&id=' . $invoice->subdistrict . '&city=' . $invoice->city, 'GET');
$expedition = explode('-', $invoice->courier);
?>
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h2 class="title" style="font-weight: bold;">View Order</h2>
            <h3 class="title">Invoice Code : {{$invoice->invoice_code}}</h3>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-borderless" border="0">
            <tr>
                <td>
                    <p class="h5 m-0" style="font-weight: bold;">Order Data</p>
                </td>
            </tr>
            <tr>
                <td>Recipient's Name </td>
                <td>{{$invoice->first_name . ' ' . $invoice->last_name}} </td>
                <td>Province</td>
                <td>{{$province['results']['province']}}</td>
            </tr>
            <tr>
                <td>Email </td>
                <td>{{$invoice->email}} </td>
                <td>Regency/City</td>
                <td>{{$city['results']['city_name']}}</td>
            </tr>
            <tr>
                <td>No. Phone</td>
                <td>{{$invoice->phone}} </td>
                <td>Subdistrict</td>
                <td>{{$subdistrict['results']['subdistrict_name']}}</td>
            </tr>
            <tr>
                <td>Postal Code</td>
                <td>{{$invoice->postal_code}} </td>
                <td>Full address</td>
                <td>{{$invoice->address}}</td>
            </tr>
            <tr>
                <td>
                    <p class="h5 m-0" style="font-weight: bold;">Delivery Method</p>
                </td>
            </tr>
            <tr>
                <td>Expedition</td>
                <td>{{$expedition[2]}} </td>
            </tr>
            <tr>
                <td>Service</td>
                <td>{{$expedition[1]}} </td>
            </tr>
        </table>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Product Name</th>
                    <th>Amount</th>
                    <th>Product Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 ?>
                @foreach($invoice->transactions as $transaction)
                <?php
                $total = $transaction->product->price * $transaction->amount;
                ?>
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$transaction->product->name}}</td>
                    <td>{{$transaction->amount}} Items</td>
                    <td>Rp. {{number_format($transaction->product->price)}},-</td>
                    <td>Rp. {{number_format($total)}},-</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>

<div class="col-lg-4 mb-4">
    <div class="px-0 shadow" style="border-radius: 15px;">
        <div style="border-top-right-radius: 15px; border-top-left-radius: 15px;" class="bg-dark py-2">
            <p class="h3 text-white text-center">Order Summary</p>
        </div>
        <div class="p-3">
            <?php
            $total_price = 0;
            $total = 0;
            ?>
            @foreach($invoice->transactions as $transaction)
            <?php
            $total_price +=  $transaction->product->price * $transaction->amount;
            $total = $total_price + $invoice->cost;
            ?>
            @endforeach
            <table class="table table-borderless">
                <tr>
                    <td>
                        <p style="font-size: 20px;" class="font-weight-bolder m-0">Total Price</p>
                    </td>
                    <td>
                        <p class="text-primary m-0" style="font-size: 18px;">Rp. {{number_format($total_price)}},-</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="font-size: 20px;" class="font-weight-bolder m-0">Shipping Costs</p>
                    </td>
                    <td>
                        <p class="text-primary m-0" style="font-size: 18px;">Rp. {{number_format($invoice->cost)}},-</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="font-size: 20px;" class="font-weight-bolder m-0">Total</p>
                    </td>
                    <td>
                        <p class="text-primary m-0" style="font-size: 18px;">Rp. {{number_format($total)}},-</p>
                    </td>
                </tr>
            </table>
            <div>
                <?php
                if($invoice->status <= 2){
                echo '<hr>';
                if ($invoice->status == 0) {
                    $status = "Already Paid";
                } else if ($invoice->status == 1) {
                    $status = "Order Process";
                } else if ($invoice->status == 2) {
                    $status = "Send Orders";
                }
                if (!empty($invoice->proof->status) && $invoice->proof->status == 1) {
                    echo '<p class="ml-1 title mb-0 text-info"><i class="fas fa-info-circle"></i> Proof of payment has been confirmed</p>
                            <a href="' . route('order.update', $invoice->id) . '" type="button" class="btn btn-info position-relative">
                            '. $status .'</i>
                                <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                    <span class="visually-hidden"></span>
                                </span>
                            </a>';
                } else {
                    echo '<a class="btn btn-info" href="' . route('order.update', $invoice->id) . '">'. $status .'</a>';
                }}
                ?>
            </div>
        </div>
    </div>
</div>
@stop