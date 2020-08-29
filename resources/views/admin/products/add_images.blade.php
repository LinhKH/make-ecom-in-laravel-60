@extends('layouts.admin_layout.admin_layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Products Images</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Products Images</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                
                @include('layouts.partials.flash_message')
                
                <form name="addImageForm" id="addImageForm" action="{{ url('admin/add-images/'.$productDetail['id']) }}"
                    method="post" enctype="multipart/form-data">@csrf
                    <div class="card card-default">
                        <div class="card-header">
                        <h3 class="card-title">{{ $title }}</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="product_name">Product Name : </label>&nbsp;{{ $productDetail['product_name'] }}
                                    </div>

                                    <div class="form-group">
                                        <label for="product_code">Product Code : </label>&nbsp;{{ $productDetail['product_code'] }}
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="product_color">Product Color : </label>&nbsp;{{ $productDetail['product_color'] }}
                                    </div>

                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <img style="width: 120px; margin-top: 5px;" src="{{ asset('images/product_images/small/'.$productDetail['main_image']) }}">
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="file" multiple name="images[]" id="images" class="btn btn-primary" value="Add Images">
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Added Product Images</h3>
                                {{-- <a href="{{url('admin/add-edit-product')}}" style="max-width: 150px; float: right;display:inline-block" class="btn btn-block btn-success">Add Product</a> --}}
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="products" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product ID</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($productDetail['images'])
                                            @foreach ($productDetail['images'] as $image)
                                            <tr>
                                                <td>{{ $image['id'] }}</td>
                                                <td>{{ $image['product_id'] }}</td>
                                                <td align="center">
                                                    <img src="{{ asset('images/product_images/small/'.$image['image']) }}" style="width: 120px;">
                                                </td>
                                                <td>
                                                    @if ($image['status'] == 1)
                                                        <a class="updateProductImagesStatus" id="image-{{$image['id']}}" product_image_id="{{$image['id']}}" href="javascript:void(0)">Active</a>
                                                    @else
                                                        <a class="updateProductImagesStatus" id="image-{{$image['id']}}" product_image_id="{{$image['id']}}" href="javascript:void(0)">Inactive</a>
                                                    @endif
                                                </td>
                                                <td align="center">
                                                    <a title="Edit Product Image" class="editProductImage" data-id="{{ $image['id'] }}" href="javascript:void(0)"><i class="fas fa-edit"></i></a>&nbsp;&nbsp; 
                                                    <a title="Delete Product Image" class="confirmDelete" record="product-images" recordid="{{ $image['id'] }}" href="javascript:void(0)" <?php /* href="{{ url('admin/delete-product-images/'.$image['id']) }}" */ ?> ><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <th>ID</th>
                                            <th>Product ID</th>
                                            <th>Image</th>
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
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
