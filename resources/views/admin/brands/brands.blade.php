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

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Brands</h3>
                                <a href="{{url('admin/add-edit-brand')}}" style="max-width: 150px; float: right;display:inline-block" class="btn btn-block btn-success">Add Brand</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="brands" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($brands as $brand)
                                            <tr>
                                                <td>{{ $brand['id'] }}</td>
                                                <td>{{ $brand['name'] }}</td>
                                                <td>
                                                    @if ($brand['status'] == 1)
                                                        <a class="updateBrandStatus" id="brand-{{ $brand['id'] }}"
                                                            brand_id="{{ $brand['id'] }}"
                                                            href="javascript:void(0)">Active</a>
                                                    @else
                                                        <a class="updateBrandStatus" id="brand-{{ $brand['id'] }}"
                                                            brand_id="{{ $brand['id'] }}"
                                                            href="javascript:void(0)">Inactive</a>
                                                    @endif
                                                </td>
                                                <td align="center">
                                                    <a title="Edit Brand"
                                                        href="{{ url('admin/add-edit-brand/' . $brand->id) }}"><i
                                                            class="fas fa-edit"></i></a>&nbsp;&nbsp;
                                                    <a title="Delete brand" class="confirmDelete" record="brand"
                                                        recordid="{{ $brand->id }}" href="javascript:void(0)" <?php /*
                                                        href="{{ url('admin/delete-brand/'.$brand->id) }}" */ ?>><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
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
