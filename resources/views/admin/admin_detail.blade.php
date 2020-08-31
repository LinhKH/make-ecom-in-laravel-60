@extends('layouts.admin_layout.admin_layout')
@section('content')
    <!-- /.content-wrapper -->
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Admin Detail</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Admin Detail</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">

                
                
                <div class="row">
                    <div class="col-md-6">
                        @include('layouts.partials.flash_message')
                        <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update Admin Detail</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{ url('/admin/update-admin-detail') }}" name="updateAdminDetailForm" id="updateAdminDetailForm" enctype="multipart/form-data">@csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Admin Email</label>
                                    <input type="email" name="email" class="form-control" id="email" disabled value="{{ $adminDetails->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Admin Type</label>
                                    <input type="type" name="type" class="form-control" id="type" disabled value="{{ $adminDetails->type }}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Admin Name</label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{ $adminDetails->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Admin Mobile</label>
                                    <input type="text" name="mobile" class="form-control" id="mobile" value="{{ $adminDetails->mobile }}">
                                </div>
                                <div class="form-group">
                                    <label for="admin_image">Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="admin_image" name="admin_image">
                                            <label class="custom-file-label" for="admin_image">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                    @if (!empty($adminDetails['image']))
                                        <div>
                                            <img src="{{ asset('images/admin_images/admin_photos/'.$adminDetails['image']) }}" style="width: 80px; margin-top:5px;">
                                            &nbsp;
                                            <a class="confirmDelete" record="admin-image" recordid="{{ $adminDetails['id'] }}" href="javascript:void(0)" 
                                            <?php /*href="{{ url('admin/delete-admin-image/'.$adminDetails['id']) }}"*/ ?>>Delete Image</a>
                                        </div>
                                    @endif
                                </div>
                                
                            </div>
                            <!-- /.card-body -->
    
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </div>
    
@endsection
