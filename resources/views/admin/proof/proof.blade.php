@extends('layouts.admin')
@section('title', 'Payment Proof')
@section('route')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{ route('admin.proof') }}">Payment Proof</a></li>
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
        <div class="float-left">
            <h2 class="title" style="font-weight: bold;">Payment Proof</h2>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Image</th>
                    <th>Invoice</th>
                    <th>file</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 ?>
                @foreach($proofs as $proof)
                    <tr>
                        <td>
                            <p>{{$i++}}</p>
                        </td>
                        <td class="product-list-img">
                            <img src="/image/admin/proof/{{$proof->img}}" class="img-fluid img-thumbnail rounded" style="width: 80px; height: 70px; object-fit: cover;">
                        </td>
                        <td>
                            <p>{{$proof->invoice->invoice_code}}</p>
                        </td>
                        <td>
                            <a href="/image/admin/proof/{{$proof->img}}" target="_blank">{{$proof->img}}</a>
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{ route('admin.confirm', $proof->id) }}">Confirm Proof</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
@stop