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
                
                <form name="productForm" id="productForm" 
                    @if (empty($productDetail['id']))
                    action="{{ url('admin/add-edit-product') }}"
                    @else 
                    action="{{ url('admin/add-edit-product/'.$productDetail['id']) }}"
                    @endif
                    method="post"
                    enctype="multipart/form-data">@csrf
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
                                        <label>Select Category</label>
                                        <select class="form-control select2" style="width: 100%;" id="category_id" name="category_id">
                                        <option value="">Select</option>
                                            @if (!empty($categories))
                                                @foreach ($categories as $section)
                                                    <optgroup label="{{ $section['name'] }}">
                                                        @if (!empty($section['categories'])) 
                                                            @foreach ($section['categories'] as $category)
                                                                <option value="{{ $category['id'] }}" @if(!empty($productDetail['category_id']) && $category['id'] == $productDetail['category_id']) selected @endif>&nbsp;&nbsp;&nbsp;&raquo;&nbsp;{{ $category['category_name'] }}</option>
                                                                @foreach ($category['subcategories'] as $subcategory)
                                                                    <option value="{{ $subcategory['id'] }}" @if(!empty($productDetail['category_id']) && $subcategory['id'] == $productDetail['category_id']) selected @endif >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&nbsp;{{ $subcategory['category_name'] }}</option>
                                                                @endforeach
                                                            @endforeach
                                                        @endif
                                                    </optgroup>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="product_name">Product Name</label>
                                        <input type="text" class="form-control" id="product_name" name="product_name"
                                            placeholder="Enter Product Name" 
                                            @if (!empty($productDetail['product_name']))
                                                value="{{ $productDetail['product_name'] }}"
                                            @else
                                                value="{{ old('product_name') }}"
                                            @endif>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="product_price">Product Price</label>
                                        <input type="text" class="form-control" id="product_price" name="product_price"
                                            placeholder="Enter Product Price"
                                            @if (!empty($productDetail['product_price']))
                                                value="{{ $productDetail['product_price'] }}"
                                            @else
                                                value="{{ old('product_price') }}"
                                            @endif>
                                    </div>

                                    <div class="form-group">
                                        <label for="category_discount">Product Discount (%)</label>
                                        <input type="text" class="form-control" id="product_discount" name="product_discount"
                                            placeholder="Enter Product Discount"
                                            @if (!empty($productDetail['product_discount']))
                                                value="{{ $productDetail['product_discount'] }}"
                                            @else
                                                value="{{ old('product_discount') }}"
                                            @endif>
                                    </div>

                                    <div class="form-group">
                                        <label for="product_video">Product Video</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="product_video" name="product_video">
                                                <label class="custom-file-label" for="product_video">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                        @if (!empty($productDetail['product_video']))
                                            <div>
                                                <img src="{{ asset('videos/product_videos/'.$productDetail['product_video']) }}" style="width: 80px; margin-top:5px;">
                                                &nbsp;
                                                <a class="confirmDelete" record="product-video" recordid="{{ $productDetail['id'] }}" href="javascript:void(0)" 
                                                <?php /*href="{{ url('admin/delete-product-video/'.$productDetail['id']) }}"*/ ?>>Delete Video</a>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Product Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter ...">@if (!empty($productDetail['description'])){{ $productDetail['description'] }}@else{{ old('description') }}@endif</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Select Sleeve</label>
                                        <select class="form-control select2" style="width: 100%;" id="sleeve" name="sleeve">
                                            <option value="">Select</option>
                                            @if (!empty($arrSleeve))
                                                @foreach ($arrSleeve as $sleeve)
                                                    <option value="{{$sleeve}}"
                                                    @if (!empty($productDetail['sleeve']) && $productDetail['sleeve'] == $sleeve )
                                                        selected
                                                    @endif>{{ $sleeve }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Select Pattern</label>
                                        <select class="form-control select2" style="width: 100%;" id="pattern" name="pattern">
                                            <option value="">Select</option>
                                            @if (!empty($arrPattern))
                                                @foreach ($arrPattern as $pattern)
                                                    <option value="{{$pattern}}" 
                                                    @if (!empty($productDetail['pattern']) && $productDetail['pattern'] == $pattern )
                                                        selected
                                                    @endif>{{ $pattern }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea class="form-control" id="meta_description" name="meta_description" rows="3" placeholder="Enter ...">@if (!empty($productDetail['meta_description'])){{ $productDetail['meta_description'] }} @else {{ old('meta_description') }} @endif</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_keywords">Meta Keywords</label>
                                        <textarea class="form-control" id="meta_keywords" name="meta_keywords" rows="3" placeholder="Enter ...">@if (!empty($productDetail['meta_keywords'])){{ $productDetail['meta_keywords'] }}@else{{ old('meta_keywords') }}@endif</textarea>
                                    </div>

                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_code">Product Code</label>
                                        <input type="text" class="form-control" id="product_code" name="product_code"
                                            placeholder="Enter Product Code"
                                            @if (!empty($productDetail['product_code']))
                                            value="{{$productDetail['product_code'] }}"
                                            @else
                                            value="{{ old('product_code') }}"
                                            @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_color">Product Color</label>
                                        <input type="text" class="form-control" id="product_color" name="product_color"
                                            placeholder="Enter Product Color"
                                            @if (!empty($productDetail['product_color']))
                                            value="{{$productDetail['product_color'] }}"
                                            @else
                                            value="{{ old('product_color') }}"
                                            @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_weight">Product Weight</label>
                                        <input type="text" class="form-control" id="product_weight" name="product_weight"
                                            placeholder="Enter Product Weight"
                                            @if (!empty($productDetail['product_weight']))
                                            value="{{$productDetail['product_weight'] }}"
                                            @else
                                            value="{{ old('product_weight') }}"
                                            @endif>
                                    </div>

                                    <div class="form-group">
                                        <label for="main_image">Product Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="main_image" name="main_image">
                                                <label class="custom-file-label" for="main_image">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                        <div>Recommended Image Size: Width:1040px, Height:1200px</div>
                                        @if (!empty($productDetail['main_image']))
                                            <div>
                                                <img src="{{ asset('images/product_images/small/'.$productDetail['main_image']) }}" style="width: 80px; margin-top:5px;">
                                                &nbsp;
                                                <a class="confirmDelete" record="product-image" recordid="{{ $productDetail['id'] }}" href="javascript:void(0)" 
                                                <?php /*href="{{ url('admin/delete-product-image/'.$productDetail['id']) }}"*/ ?>>Delete Image</a>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="wash_care">Wash Care</label>
                                        <textarea class="form-control" id="wash_care" name="wash_care" rows="3" placeholder="Enter ...">@if (!empty($productDetail['wash_care'])){{ $productDetail['wash_care'] }}@else{{ old('wash_care') }}@endif</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Select Fabric</label>
                                        <select class="form-control select2" style="width: 100%;" id="fabric" name="fabric">
                                            <option value="">Select</option>
                                            @if (!empty($arrFabric))
                                                @foreach ($arrFabric as $fabric)
                                                    <option value="{{$fabric}}"
                                                    @if (!empty($productDetail['fabric']) && $productDetail['fabric'] == $fabric )
                                                        selected
                                                    @endif>{{ $fabric }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Select Fit</label>
                                        <select class="form-control select2" style="width: 100%;" id="fit" name="fit">
                                            <option value="">Select</option>
                                            @if (!empty($arrFit))
                                                @foreach ($arrFit as $fit)
                                                    <option value="{{$fit}}"
                                                    @if (!empty($productDetail['fit']) && $productDetail['fit'] == $fit )
                                                        selected
                                                    @endif>{{ $fit }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Select Occasion</label>
                                        <select class="form-control select2" style="width: 100%;" id="occasion" name="occasion">
                                            <option value="">Select</option>
                                            @if (!empty($arrOccasion))
                                                @foreach ($arrOccasion as $occasion)
                                                    <option value="{{$occasion}}"
                                                    @if (!empty($productDetail['occasion']) && $productDetail['occasion'] == $occasion )
                                                        selected
                                                    @endif>{{ $occasion }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_title">Meta Title</label>
                                        <textarea class="form-control" id="meta_title" name="meta_title" rows="3" placeholder="Enter ...">@if (!empty($productDetail['meta_title'])){{ $productDetail['meta_title'] }}@else{{ old('meta_title') }}@endif</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="is_featured">Featured</label>
                                        <input type="checkbox" name="is_featured" id="is_featured" value="Yes" @if ( !empty($productDetail['is_featured']) &&  $productDetail['is_featured'] == 'Yes') checked @endif>
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
