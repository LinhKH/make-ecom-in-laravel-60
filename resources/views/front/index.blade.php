@extends('layouts.front_layout.front_layout')
@section('content')

<div class="span9">
    <div class="well well-small">
        <h4>Featured Products <small class="pull-right">{{ $featuredItemsCount }}+ featured products</small></h4>
        <div class="row-fluid">
            <div id="featured" @if(count($featuredItemsChunk) != 1) class="carousel slide" @endif>
                <div class="carousel-inner">
                    @foreach ($featuredItemsChunk as $key => $featuredItem)
                    <div class="item @if($key==1) active @endif">
                        <ul class="thumbnails">
                            @foreach ($featuredItem as $item)
                            <li class="span3">
                                <div class="thumbnail">
                                    <i class="tag"></i>
                                    <a href="{{url('product/'.$item['id'])}}">
                                        <?php $product_image_path = 'images/product_images/small/'.$item['main_image']; ?>
                                        @if ($item['main_image'] && file_exists($product_image_path))
                                            <img src="{{ asset('images/product_images/small/'.$item['main_image']) }}" alt="">
                                        @else 
                                            <img src="{{ asset('images/product_images/small/no-image.png') }}" alt="">
                                        @endif
                                    </a>
                                    <div class="caption">
                                        <h5>{{ $item['product_name'] }}</h5>
                                        <h4><a class="btn" href="{{url('product/'.$item['id'])}}">VIEW</a> <span class="pull-right">Rs.{{ $item['product_price'] }}</span></h4>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endforeach
                </div>
                @if(count($featuredItemsChunk) != 1)
                <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
                <a class="right carousel-control" href="#featured" data-slide="next">›</a>
                @endif
            </div>
        </div>
    </div>
    <h4>Latest Products </h4>
    <ul class="thumbnails">
        @foreach ($lastestProducts as $lastestProduct)
        <li class="span3">
            <div class="thumbnail">
                <a href="{{url('product/'.$lastestProduct['id'])}}">
                    <?php $product_image_path = 'images/product_images/large/'.$lastestProduct['main_image']; ?>
                    @if ($lastestProduct['main_image'] && file_exists($product_image_path))
                        <img src="{{ asset('images/product_images/large/'.$lastestProduct['main_image']) }}" alt="">
                    @else 
                        <img src="{{ asset('images/product_images/large/no-image.png') }}" alt="">
                    @endif
                </a>
                <div class="caption">
                    <h5>{{ $lastestProduct['product_name'] }}</h5>
                    <p>
                        {{ $lastestProduct['product_code'] }} ({{ $lastestProduct['product_color'] }})
                    </p>

                    <h4 style="text-align:center"><a class="btn" href="{{url('product/'.$lastestProduct['id'])}}"> <i
                                class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i
                                class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.{{ $lastestProduct['product_price'] }}</a></h4>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
</div>

@endsection