@extends('layouts.admin_layout.admin_layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Brands</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Brands</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                @include('layouts.partials.flash_message')

                <form name="bannerForm" id="bannerForm" 
                    @if (empty($bannerDetail['id']))
                    action="{{ url('admin/add-edit-banner') }}"
                    @else 
                    action="{{ url('admin/add-edit-banner/'.$bannerDetail['id']) }}"
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
                                        <label for="image">Banner Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="image" name="image"
                                                @if (!empty($bannerDetail['image']))
                                                value="{{$bannerDetail['image'] }}"
                                                @else
                                                value="{{ old('image') }}"
                                                @endif>
                                                <label class="custom-file-label" for="image">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                        <div>Recommended Image Size: Width:1170px, Height:480px</div>
                                        @if (!empty($bannerDetail['image']))
                                            <div>
                                                <img src="{{ asset('images/banner_images/'.$bannerDetail['image']) }}" style="width: 80px; margin-top:5px;">
                                                &nbsp;
                                                <a class="confirmDelete" record="banner-image" recordid="{{ $bannerDetail['id'] }}" href="javascript:void(0)" 
                                                <?php /*href="{{ url('admin/delete-banner-image/'.$bannerDetail['id']) }}"*/ ?>>Delete Image</a>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="link">Banner Link</label>
                                        <input type="text" class="form-control" id="link" name="link"
                                            placeholder="Enter Banner Link"
                                            @if (!empty($bannerDetail['link']))
                                            value="{{$bannerDetail['link'] }}"
                                            @else
                                            value="{{ old('link') }}"
                                            @endif>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <label for="title">Banner Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Enter Banner Title"
                                    @if (!empty($bannerDetail['title']))
                                    value="{{$bannerDetail['title'] }}"
                                    @else
                                    value="{{ old('title') }}"
                                    @endif>
                                </div>
                                <div class="col-md-6">
                                    <label for="alt">Banner Alternate Text</label>
                                    <input type="text" class="form-control" id="alt" name="alt"
                                    placeholder="Enter Banner Alternate Text"
                                    @if (!empty($bannerDetail['alt']))
                                    value="{{$bannerDetail['alt'] }}"
                                    @else
                                    value="{{ old('alt') }}"
                                    @endif>
                                </div>
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
