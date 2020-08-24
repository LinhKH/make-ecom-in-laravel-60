@extends('layouts.admin_layout.admin_layout')
@section('content')
    <!-- /.content-wrapper -->
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>General Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">General Form</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">

                @include('layouts.partials.flash_message')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update Password</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Admin Name</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ $adminDetails->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Admin Email</label>
                                    <input type="email" name="email" class="form-control" id="email" disabled value="{{ $adminDetails->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Admin Type</label>
                                    <input type="type" name="type" class="form-control" id="type" disabled value="{{ $adminDetails->type }}">
                                </div>
                                <div class="form-group">
                                    <label for="password">Current Password</label>
                                    <input type="password" name="password" class="form-control" id="password" value="{{ $adminDetails->password }}">
                                </div>
                                <div class="form-group">
                                    <label for="new_password">New Password</label>
                                    <input type="password" name="new_password" class="form-control" id="new_password">
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input type="password" name="confirm_password" class="form-control" id="confirm_password">
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
