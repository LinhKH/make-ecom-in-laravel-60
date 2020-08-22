@extends('layouts.admin_layout.admin_layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Categories</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Categories</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if ($errors->any())
                    <div class="alert alert-danger" style="margin-top: 10px;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (Session::has('success_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px;">
                        {{ Session::get('success_message') }}
                        <button type="button" class="close" data-mismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form name="categoryForm" id="categoryForm" 
                    @if (empty($categoryDetail['id']))
                    action="{{ url('admin/add-edit-category') }}"
                    @else 
                    action="{{ url('admin/add-edit-category/'.$categoryDetail['id']) }}"
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
                                        <label for="category_name">Category Name</label>
                                        <input type="text" class="form-control" id="category_name" name="category_name"
                                            placeholder="Enter Category Name" 
                                            @if (!empty($categoryDetail['category_name']))
                                                value="{{ $categoryDetail['category_name'] }}"
                                            @else
                                                value="{{ old('category_name') }}"
                                            @endif>
                                    </div>
                                    <div class="form-group" id="appendCategoriesLevel">
                                        @include('admin.categories.append_categories_level')
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="category_discount">Category Discount</label>
                                        <input type="text" class="form-control" id="category_discount" name="category_discount"
                                            placeholder="Enter Category Discount"
                                            @if (!empty($categoryDetail['category_discount']))
                                                value="{{ $categoryDetail['category_discount'] }}"
                                            @else
                                                value="{{ old('category_discount') }}"
                                            @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Category Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter ...">@if (!empty($categoryDetail['description'])){{ $categoryDetail['description'] }}@else{{ old('description') }}@endif</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea class="form-control" id="meta_description" name="meta_description" rows="3" placeholder="Enter ...">@if (!empty($categoryDetail['meta_description'])){{ $categoryDetail['meta_description'] }} @else {{ old('meta_description') }} @endif</textarea>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Section</label>
                                        <select class="form-control select2" style="width: 100%;" id="section_id" name="section_id">
                                            <option value="">Select</option>
                                            @foreach ($sections as $section)
                                                <option 
                                                @if (!empty($categoryDetail['section_id']) && $categoryDetail['section_id'] == $section->id )
                                                    selected
                                                @endif
                                                value="{{ $section->id }}">{{ $section->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_image">Category Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="category_image" name="category_image">
                                                <label class="custom-file-label" for="category_image">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                        @if (!empty($categoryDetail['category_image']))
                                            <div>
                                                <img src="{{ asset('images/category_images/'.$categoryDetail['category_image']) }}" style="width: 80px; margin-top:5px;">
                                                &nbsp;
                                                <a href="{{ url('admin/delete-category-image/'.$categoryDetail['id']) }}">Delete Image</a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="url">Category Url</label>
                                        <input type="text" class="form-control" id="url" name="url"
                                            placeholder="Enter Category Description"
                                            @if (!empty($categoryDetail['url']))
                                            value="{{$categoryDetail['url'] }}"
                                            @else
                                            value="{{ old('url') }}"
                                            @endif>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="meta_title">Meta Title</label>
                                        <textarea class="form-control" id="meta_title" name="meta_title" rows="3" placeholder="Enter ...">@if (!empty($categoryDetail['meta_title'])){{ $categoryDetail['meta_title'] }}@else{{ old('meta_title') }}@endif</textarea>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="meta_keywords">Meta Keywords</label>
                                        <textarea class="form-control" id="meta_keywords" name="meta_keywords" rows="3" placeholder="Enter ...">@if (!empty($categoryDetail['meta_keywords'])){{ $categoryDetail['meta_keywords'] }}@else{{ old('meta_keywords') }}@endif</textarea>
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
