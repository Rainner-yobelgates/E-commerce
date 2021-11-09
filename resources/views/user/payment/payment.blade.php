@extends('layouts.user')
@section('title','Payment')
@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="bg-dark category-title mb-4 d-flex justify-content-between" style="margin-top: 100px;">
            <h3 class="text-light p-3 mb-0">Thank you for shopping.</h3>
            <h3 class="text-light p-3 mb-0">Invoice Code : {{$invoice->invoice_code}}</h3>
        </div>
        <div class="col-md-5">
            <div class="card rounded p-3">
                <div class="bg-dark category-title rounded mb-3">
                    <h3 class="text-light p-3 mb-0">Expenses to be paid</h3>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td>
                                <p class="h6">Total Price Costs</p>
                            </td>
                            <td>
                                <p class="h6">Rp. {{number_format($invoice->total_price)}},-</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="h6">Shipping Costs</p>
                            </td>
                            <td>
                                <p class="h6">Rp. {{number_format($invoice->cost)}},-</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="h5">Total</p>
                            </td>
                            <td>
                                <p class="h4 text-success">Rp. {{number_format($invoice->subtotal)}},-</p>
                            </td>
                        </tr>
                    </table>
                    <p style="font-size: 18px;" class="fw-bold">If you have made a payment, please confirm the payment</p>
                    <a class="btn btn-info text-light" href="{{ route('payment.confirm') }}">Confirm Here</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card  p-3 rounded">
                <div class="bg-dark category-title rounded mb-3">
                    <h3 class="text-light p-3 mb-0">The Account</h3>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td class="fw-bold">Bank Rakyat Indonesia</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Name :</td>
                            <td class="fw-bold">Rainner Yobelgates F</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">No.Acc :</td>
                            <td class="fw-bold">123456789</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Bank Central Asia</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Name :</td>
                            <td class="fw-bold">Rainner Yobelgates F</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">No.Acc :</td>
                            <td class="fw-bold">123456789</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop