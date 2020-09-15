<div class="tab-pane" id="listView">
    @foreach ($categoryProducts as $product)
        <div class="row">
            <div class="span2">
                <img src="{{ asset('images/product_images/small/' . $product['main_image']) }}" alt="" />
            </div>
            <div class="span4">
                <h3>New | Available</h3>
                <hr class="soft" />
                <h5>Product Name </h5>
                <p>
                    Nowadays the lingerie industry is one of the most successful business spheres.We always stay in
                    touch with the latest fashion tendencies -
                    that is why our goods are so popular..
                </p>
                <a class="btn btn-small pull-right" href="product_details.html">View Details</a>
                <br class="clr" />
            </div>
            <div class="span3 alignR">
                <form class="form-horizontal qtyFrm">
                    <h3> $140.00</h3>
                    <label class="checkbox">
                        <input type="checkbox"> Adds product to compair
                    </label><br />

                    <a href="product_details.html" class="btn btn-large btn-primary"> Add to <i
                            class=" icon-shopping-cart"></i></a>
                    <a href="product_details.html" class="btn btn-large"><i class="icon-zoom-in"></i></a>

                </form>
            </div>
        </div>
        <hr class="soft" />
    @endforeach

</div>
<div class="tab-pane  active" id="blockView">
    <ul class="thumbnails">
        @foreach ($categoryProducts as $product)
            <li class="span3">
                <div class="thumbnail">
                    <a href="product_details.html">
                        <img src="{{ asset('images/product_images/large/' . $product['main_image']) }}" alt="" />
                    </a>
                    <div class="caption">
                        <h5>{{ $product['product_name'] }}</h5>
                        <p>
                            I'm a paragraph. Click here
                        </p>
                        <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i
                                    class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i
                                    class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.1000</a>
                        </h4>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    <hr class="soft" />
</div>
<div class="pagination" align="center">
    {!! $categoryProducts->links() !!}
</div>
