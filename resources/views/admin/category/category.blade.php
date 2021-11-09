@extends('layouts.admin')
@section('title', 'Category')
@section('route')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{ route('category') }}">Category</a></li>
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
            <h2 class="title" style="font-weight: bold;">Category Of Products</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-dark" href="{{ route('category.create') }}">Create Category</a>
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 ?>
                @foreach($categories as $category)
                <tr>
                    <td>
                        <p>{{$i++}}</p>
                    </td>
                    <td class="product-list-img">
                        <img src="/image/admin/category/{{$category->icon}}" class="img-fluid img-thumbnail rounded" style="width: 80px; height: 70px; object-fit: cover;">
                    </td>
                    <td>
                        <p>{{Str::limit($category->name,'40','')}}</p>
                    </td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('category.edit', $category->slug) }}"><i class="far fa-edit"></i></a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                            <i class="fas fa-trash"></i>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{$category->name}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="modal-title" id="exampleModalLabel">Apakah Anda Yakin Ingin Menghapusnya?</p>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form action="{{ route('category.delete', $category->slug) }}" method="post">
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