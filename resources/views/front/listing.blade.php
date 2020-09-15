@extends('layouts.front_layout.front_layout')
@section('content')

    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a> <span class="divider">/</span></li>
            <li class="active">{{ $categoryDetails['cat_details']['category_name'] }}</li>
        </ul>
        <h3> {{ $categoryDetails['cat_details']['category_name'] }} <small class="pull-right"> {{ $productCount }} products
                are available </small></h3>
        <hr class="soft" />
        <form class="form-horizontal span6">
            <div class="control-group">
                <label class="control-label alignL">Sort By </label>
                <select>
                    <option>Priduct name A - Z</option>
                    <option>Priduct name Z - A</option>
                    <option>Priduct Stoke</option>
                    <option>Price Lowest first</option>
                </select>
            </div>
        </form>

        <div id="myTab" class="pull-right">
            <a href="#listView" data-toggle="tab"><span class="clslistView btn btn-large"><i
                        class="icon-list"></i></span></a>
            <a href="#blockView" data-toggle="tab"><span class="clsblockView btn btn-large btn-primary"><i
                        class="icon-th-large"></i></span></a>
        </div>
        <br class="clr" />
        <div class="tab-content" id="table_data">
            @include('front.pagination_data')
        </div>
        <a href="compair.html" class="btn btn-large pull-right">Compair Product</a>
        <div class="pagination">
            {{-- {{ $categoryProducts->links() }} --}}
        </div>
        <br class="clr" />
    </div>

@endsection
