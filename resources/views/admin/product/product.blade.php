@extends('layouts.admin')
@section('title', 'Products')
@section('route')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{ route('product') }}">Products</a></li>
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
            <h2 class="title" style="font-weight: bold;">My products</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-dark" href="{{ route('product.create') }}">Create Product</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>stock</th>
                    <th>category</th>
                    <th>condition</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 ?>
                @foreach($products as $product)
                <tr>
                    <td>
                        <p>{{$i++}}</p>
                    </td>
                    <td class="product-list-img">
                        <img src="/image/admin/product/{{$product->image}}" class="img-fluid img-thumbnail rounded" style="width: 80px; height: 70px; object-fit: cover;">
                    </td>
                    <td>
                        <p>{{Str::limit($product->name,'40','')}}</p>
                    </td>
                    <td>
                        <p>{{number_format($product->price)}}</p>
                    </td>
                    <td>
                        <p>{{$product->stock}}</p>
                    </td>
                    <td>
                        @if(!empty($product->category->name))
                        <p>{{$product->category->name}}</p>
                        @else
                        <p class="text-danger">No Category</p>
                        @endif
                    </td>
                    <td>
                        <p>{{$product->condition}}</p>
                    </td>
                    <td>
                        <a class="btn btn-info" href="{{ route('product.view', $product->slug) }}"><i class="fas fa-eye"></i></a>
                        <a class="btn btn-primary" href="{{ route('product.edit', $product->slug) }}"><i class="far fa-edit"></i></a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                            <i class="fas fa-trash"></i>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{$product->name}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="modal-title" id="exampleModalLabel">Apakah Anda Yakin Ingin Menghapusnya?</p>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form action="{{ route('product.delete', $product->slug) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
@stop