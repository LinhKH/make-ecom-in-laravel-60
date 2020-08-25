@extends('layouts.admin_layout.admin_layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Products Attributes</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Products Attributes</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                
                @include('layouts.partials.flash_message')
                
                <form name="productForm" id="productForm" action="{{ url('admin/add-attributes/'.$productDetail['id']) }}"
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
                                        <div class="field_wrapper">
                                            <div>
                                                <input style="width: 185px;" id="size" type="text" name="size[]" placeholder="Size" value=""/>
                                                <input style="width: 185px;" id="sku" type="text" name="sku[]" placeholder="sku" value=""/>
                                                <input style="width: 185px;" id="price" type="text" name="price[]" placeholder="price" value=""/>
                                                <input style="width: 185px;" id="stock" type="text" name="stock[]" placeholder="stock" value=""/>
                                                <a href="javascript:void(0);" class="add_button" title="Add field">&nbsp;<i class="fas fa-plus"></i></a>
                                            </div>
                                        </div>
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
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
