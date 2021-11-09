@extends('layouts.user')
@section('title','Transaction')
@section('content')
<div class="container">
    <div class="row">
        <div class="bg-dark category-title mb-4" style="margin-top: 100px;">
            <h3 class="text-light p-3 mb-0">Transaction</h3>
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
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><a class="nav-link p-1 text-dark" style="font-size: 18px;" href="{{ route('user.dashboard') }}">Dashboard</a></td>
                            </tr>
                            <tr>
                                <td><a class="nav-link p-1 text-dark" style="font-size: 18px;" href="{{ route('transaction') }}">Transaction</a></td>
                            </tr>
                            <tr>
                                <td><a class="nav-link p-1 text-dark" style="font-size: 18px;" href="{{ route('transaction.history') }}">History Transaction</a></td>
                            </tr>
                            <tr>
                                <td><a class="nav-link p-1 text-dark" style="font-size: 18px;" href="{{ route('profile') }}">Edit Profile</a></td>
                            </tr>
                            <tr>
                                <td><a class="nav-link p-1 text-dark" style="font-size: 18px;" href="{{ route('password') }}">Change Password</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-8">
            <div class="row">
                <div class="card p-0 rounded">
                    <div class="bg-dark py-2 rounded">
                        <p class="h3 text-white text-center">Order Detail</p>
                    </div>
                    <div class="card-body p-4">
                        <table class="table table-borderless" border="0">
                            <tr>
                                <td>
                                    <p class="h5 m-0" style="font-weight: bold;">Order Detail</p>
                                </td>
                            </tr>
                            <tr>
                                <td>Ivoice Code</td>
                                <td>{{$invoice->invoice_code}} </td>
                            </tr>
                            <tr>
                                <td>Booking Date</td>
                                <td>{{$invoice->created_at}} </td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <?php
                                $total = $invoice->total_price + $invoice->cost;
                                if ($invoice->status == 0) {
                                    $status = "Not paid";
                                } else if ($invoice->status == 1) {
                                    $status = "Waiting for confirmation";
                                } else if ($invoice->status == 2) {
                                    $status = "Being processed";
                                } else if ($invoice->status == 3) {
                                    $status = "Being sent";
                                } else if ($invoice->status == 4) {
                                    $status = "Finished";
                                }
                                ?>
                                <td>{{$status}} </td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td class="text-success">Rp. {{number_format($invoice->subtotal)}} </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="h5 m-0" style="font-weight: bold;">Delivery Address</p>
                                </td>
                            </tr>
                            <tr>
                                <td>Recipient's Name</td>
                                <td>{{$invoice->first_name . ' ' . $invoice->last_name}} </td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{$invoice->address}}</td>
                            </tr>
                            <tr>
                                <td>Phone Number</td>
                                <td>{{$invoice->phone}} </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="h5 m-0" style="font-weight: bold;">Ordering Product</p>
                                </td>
                            </tr>
                            <tr>
                                <td>Total Price</td>
                                <td>Rp. {{number_format($invoice->total_price)}} </td>
                            </tr>
                            <tr>
                                <td>Shipping Costs</td>
                                <td>Rp. {{number_format($invoice->cost)}} </td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td class="text-success">Rp. {{number_format($total)}} </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="h5 m-0" style="font-weight: bold;">Delivery Status</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>
                                        <p class="text-muted">Confirmed</p>
                                        <div class="progress">
                                            @if($invoice->status >= 1)
                                            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 100%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                            @else
                                            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <p class="text-muted">Processed</p>
                                        <div class="progress">
                                            @if($invoice->status >= 2)
                                            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 100%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                            @else
                                            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>
                                        <p class="text-muted">Sending</p>
                                        <div class="progress">
                                            @if($invoice->status >= 3)
                                            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 100%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                            @else
                                            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <p class="text-muted">Arrived</p>
                                        <div class="progress">
                                            @if($invoice->status == 4)
                                            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 100%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                            @else
                                            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        @if($invoice->status == 3)
                        <p class="text-warning"><i class="fas fa-info-circle"></i> If the order has reached its destination, please press the button below</p>
                        <a class="btn btn-success" href="{{route('transaction.update', $invoice->id)}}">Has arrived</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop