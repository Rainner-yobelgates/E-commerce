@extends('layouts.admin')
@section('title', 'Your Order')
@section('route')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{ route('payment.proof') }}">Order</a></li>
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
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h2 class="title" style="font-weight: bold;">Your Order</h2>
            <div class="d-flex justify-content-end mt-3">
                <span class="notif"></span>
                <p class="ml-1 title mb-0">Confirmed proof of payment</p>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Invoice</th>
                    <th>Name</th>
                    <th>Total Order</th>
                    <th>Date Order</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 ?>
                @foreach($invoices as $invoice)
                <tr>
                    <td>
                        <p>{{$i++}}</p>
                    </td>
                    <td>
                        <p>{{$invoice->invoice_code}}</p>
                    </td>
                    <td>
                        <p>{{$invoice->first_name . ' ' . $invoice->last_name}}</p>
                    </td>
                    <td>
                        <p>Rp. {{number_format($invoice->subtotal)}}</p>
                    </td>
                    <td>
                        <p>{{$invoice->created_at}}</p>
                    </td>
                    <td>
                        <?php
                        if ($invoice->status == 0) {
                            $status = "Not paid";
                        } else if ($invoice->status == 1) {
                            $status = "Not processed";
                        } else if ($invoice->status == 2) {
                            $status = "Being processed";
                        } else if ($invoice->status == 3) {
                            $status = "Being sent";
                        } else if ($invoice->status == 4) {
                            $status = "finished";
                        }
                        ?>
                        <p>{{$status}}</p>
                    </td>
                    <td>
                        <?php
                        if (!empty($invoice->proof->status) && $invoice->proof->status == 1) {
                            if ($invoice->status == 4) {
                                echo '<a href="' . route('order.view', $invoice->id) . '" type="button" class="btn btn-info position-relative">
                                <i class="fas fa-eye"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle p-2 bg-success border border-light rounded-circle">
                                        <span class="visually-hidden"></span>
                                    </span>
                                </a>';
                            } else {
                                echo '<a href="' . route('order.view', $invoice->id) . '" type="button" class="btn btn-info position-relative">
                                <i class="fas fa-eye"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                        <span class="visually-hidden"></span>
                                    </span>
                                </a>';
                            }
                        } else {
                            echo '<a class="btn btn-info" href="' . route('order.view', $invoice->id) . '"><i class="fas fa-eye"></i></a>';
                        }
                        ?>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
@stop