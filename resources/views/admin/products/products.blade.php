@extends('layouts.admin_layout.admin_layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Products</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                @include('layouts.partials.flash_message')

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Products</h3>
                                <a href="{{url('admin/add-edit-product')}}" style="max-width: 150px; float: right;display:inline-block" class="btn btn-block btn-success">Add Product</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="products" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product Name</th>
                                            <th>Product Code</th>
                                            <th>Product Color</th>
                                            <th>Product Image</th>
                                            <th>Category</th>
                                            <th>Section</th>
                                            <th>Brand</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->product_code }}</td>
                                            <td>{{ $product->product_color }}</td>
                                            <td align="center">
                                                <?php $product_image_path = "images/product_images/small/".$product->main_image ?>
                                                @if (!empty($product->main_image) && file_exists($product_image_path))
                                                    <img style="width: 100px;" src="{{ asset('images/product_images/small/'.$product->main_image) }}">
                                                @else 
                                                    <img style="width: 100px;" src="{{ asset('images/product_images/small/no-image.png') }}">
                                                @endif
                                            </td>
                                            <td>{{ $product->category->category_name ?? '' }}</td>
                                            <td>{{ $product->section->name ?? '' }}</td>
                                            <td>{{ $product->brand->name ?? ''}}</td>
                                            <td>
                                                @if ($product->status == 1)
                                                    <a class="updateProductStatus" id="product-{{$product->id}}" product_id="{{$product->id}}" href="javascript:void(0)"><i class="fa fa-toggle-on fa-2x" aria-hidden="true" status="Active"></i></a>
                                                @else
                                                    <a class="updateProductStatus" id="product-{{$product->id}}" product_id="{{$product->id}}" href="javascript:void(0)"><i style='color:red' class="fa fa-toggle-off fa-2x" aria-hidden="true" status="Inactive"></i></a>
                                                @endif
                                            </td>
                                            <td align="center">
                                                <a title="Add/Edit Attribute" href="{{ url('admin/add-attributes/'.$product->id) }}"><i class="fas fa-plus"></i></a>&nbsp;&nbsp; 
                                                <a title="Add Images" href="{{ url('admin/add-images/'.$product->id) }}"><i class="fa fa-camera-retro fa-lg"></i></a>&nbsp;&nbsp; 
                                                <a title="Edit Product" href="{{ url('admin/add-edit-product/'.$product->id) }}"><i class="fas fa-edit"></i></a>&nbsp;&nbsp; 
                                                <a title="Delete Product" class="confirmDelete" record="product" recordid="{{ $product->id }}" href="javascript:void(0)" <?php /* href="{{ url('admin/delete-product/'.$product->id) }}" */ ?> ><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product Name</th>
                                            <th>Product Code</th>
                                            <th>Product Color</th>
                                            <th>Product Image</th>
                                            <th>Category</th>
                                            <th>Section</th>
                                            <th>Brand</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
