
<div class="quickview-popup">
    <div class="row">

        <div class="col-md-6 product-slider">

            <div class="flickity flickity-slider-wrap mfp-hover" id="gallery-main">
               
                @foreach ($ProductMultipleImgs as $ProductMultipleImg)
                    <div class="gallery-cell">
                        <img src="{{ asset('storage/'.$ProductMultipleImg->img.'') }}" alt="" />
                    </div>
                @endforeach
                <!--
                <div class="gallery-cell">
                    <img src="img/shop/item_lg_2.jpg" alt="" />
                </div>-->
            </div> <!-- end gallery main -->

            <div class="gallery-thumbs" id="gallery-thumbs">
                @foreach ($ProductMultipleImgs as $ProductMultipleImg)
                    <div class="gallery-cell">
                            <img src="{{ asset('storage/'.$ProductMultipleImg->img.'') }}" alt="" />
                    </div>
                @endforeach
                <!--
                <div class="gallery-cell">
                    <img src="img/shop/item_thumb_2.jpg" alt="" />
                </div>-->
      
            </div> <!-- end gallery thumbs -->

        </div> <!-- end col img slider -->

        <div class="col-md-6 product-single">
            <div class="quickview-popup__padding-box">

                <h1 class="product-single__title uppercase">{{ $product->name }}</h1>
                <!--
                <div class="rating">
                    <a href="#">3 Reviews</a>
                </div>-->

                <span class="product-single__price">
                    <ins>
                        <span class="amount">${{ $product->price }}</span>
                    </ins>
                    <del>
                        <span>${{ $product->price }}</span>
                    </del>
                </span>
                <!--
                <div class="colors clearfix">
                    <span class="colors__label">Color: <span class="colors__label-selected">Fadaed Blue</span></span>
                    <a href="#" class="colors__item colors__item--selected blue"></a>
                    <a href="#" class="colors__item black"></a>
                    <a href="#" class="colors__item pink"></a>
                </div>-->

                <div class="size-quantity clearfix">
                      <!--
                    <div class="size">
                        <label>Size</label>
                        <select name="size" id="size__select" class="size__select">
                            <option value="xs">XS</option>
                            <option value="s">S</option>
                            <option value="m">M</option>
                            <option value="l">L</option>
                            <option value="xl">XL</option>
                        </select>
                    </div>-->

                    <div class="quantity">
                        <label>Quantity</label>
                        <select name="quantity" id="quantity__select" class="quantity__select">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>

                <div class="row row-10 product-single__actions clearfix">
                    <div class="col">
                        <a href="javascript:void(0);" class="btn btn-lg btn-color product-single__add-to-cart" onClick="add_cart({{ $product->p_id }});">
                            <i class="ui-bag"></i>
                            <span>Add to Cart</span>
                        </a>
                    </div>
                    <!--<div class="col">
                        <a href="#" class="btn btn-lg btn-dark product-single__add-to-wishlist">
                            <i class="ui-heart"></i>
                            <span>Wishlist</span>
                        </a>
                    </div>-->
                </div>
                <!--
                <div class="product_meta">
                    <ul>
                        <li>
                            <span class="product-code">Product Code: <span>111763</span></span>
                        </li>
                        <li>
                            <span class="product-material">Material: <span>Cotton 100%</span></span>
                        </li>
                        <li>
                            <span class="product-country">Country: <span>Made in Canada</span></span>
                        </li>
                    </ul>
                </div>-->

            </div>

        </div> <!-- end col product description -->
    </div> <!-- end row -->
</div>