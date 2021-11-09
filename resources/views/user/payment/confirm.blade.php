@extends('layouts.user')
@section('title','Confirm Payment')
@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="bg-dark category-title mb-4" style="margin-top: 100px;">
            <h3 class="text-light p-3 mb-0">Confirmation of your payment.</h3>
        </div>
        <div class="col-md-5">
            <div class="card p-3 rounded">
                <div class="bg-dark category-title rounded mb-3">
                    <h3 class="text-light p-3 mb-0">Send proof of payment</h3>
                </div>
                <form action="{{ route('payment.proof') }}" id="checkout" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="">
                            <div class="mb-3">
                                <label for="invoice" class="form-label">Invoice Code</label>
                                <input type="text" name="invoice" class="form-control" id="invoice" placeholder="Your Invoice Code">
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Upload File Image</label>
                                <input type="file" name="image" class="form-control" id="image">
                            </div>
                            <button class="btn btn-dark">Send Proof</button>
                        </div>
                    </div>
                </form>
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