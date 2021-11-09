@extends('layouts.user')
@section('title','History Transaction')
@section('content')
<div class="container">
    <div class="row">
        <div class="bg-dark category-title mb-4" style="margin-top: 100px;">
            <h3 class="text-light p-3 mb-0">History Transaction</h3>
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
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Invoice</th>
                            <th scope="col">Date Order</th>
                            <th scope="col">Total Payment</th>
                            <th scope="col">status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        @if(!empty($check))
                        @foreach($invoices as $invoice)
                        <tr>
                            <td>
                                <p class="h5 p-1">{{$no++}}</p>
                            </td>
                            <td>
                                <p class="h5 p-1">{{$invoice->invoice_code}}</p>
                            </td>
                            <td>
                                <p class="h6 p-1">{{$invoice->created_at}}</p>
                            </td>
                            <td>
                                <p class="h6 p-1">Rp. {{number_format($invoice->subtotal)}}</p>
                            </td>
                            <td>
                                <p class="h6 p-1">Finished</p>
                            </td>
                            <td><a class="btn btn-info text-light" href="{{route('transaction.view', $invoice->id)}}"><i class="fas fa-eye"></i></a></td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6">
                                <p class="h5 p-1 text-center">There is no transaction history.</p>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop