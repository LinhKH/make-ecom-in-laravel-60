@extends('layouts.admin_layout.admin_layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sections</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Sections</li>
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
                                <h3 class="card-title">Sections</h3>
                                <a href="{{url('admin/add-edit-section')}}" style="max-width: 150px; float: right;display:inline-block" class="btn btn-block btn-success">Add Section</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="sections" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sections as $section)
                                            <tr>
                                                <td>{{ $section['id'] }}</td>
                                                <td>{{ $section['name'] }}</td>
                                                <td>
                                                    @if ($section['status'] == 1)
                                                        <a class="updateSectionStatus" id="section-{{ $section['id'] }}"
                                                            section_id="{{ $section['id'] }}"
                                                            href="javascript:void(0)">Active</a>
                                                    @else
                                                        <a class="updateSectionStatus" id="section-{{ $section['id'] }}"
                                                            section_id="{{ $section['id'] }}"
                                                            href="javascript:void(0)">Inactive</a>
                                                    @endif
                                                </td>
                                                <td align="center">
                                                    <a title="Edit Section"
                                                        href="{{ url('admin/add-edit-section/' . $section->id) }}"><i
                                                            class="fas fa-edit"></i></a>&nbsp;&nbsp;
                                                    <a title="Delete Section" class="confirmDelete" record="section"
                                                        recordid="{{ $section->id }}" href="javascript:void(0)" <?php /*
                                                        href="{{ url('admin/delete-section/'.$section->id) }}" */ ?>><i class="fas fa-trash"></i></a>
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
