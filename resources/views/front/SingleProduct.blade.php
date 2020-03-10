@extends('front.extends.layout')


@section('title','Namira | Home')

@section('content')


<script>
  function add_cart(p_id){
      //alert(p_id);
      $("#p_id").val(p_id);
      
      $('#myForm').submit();
      //location.reload();
  }
</script>

@php
 if(session()->has('msg')){
    echo '<script>alert("'.session()->get('msg').'");</script>';
 }   
@endphp

 <!-- Single Product -->
 <section class="section-wrap pb-20 product-single">
    <div class="container">

      <!-- Breadcrumbs -->
      <ol class="breadcrumbs">
        <li>
          <a href="/">Home</a>
        </li>
        <li>
          <a href="/catalog/{{ $mainmenus[0]->menu_id }}">{{ $mainmenus[0]->name }}</a>
        </li>
        @if($mainmenus[0]->submenus->count()>0)
        <li class="active">
            {{ $mainmenus[0]->submenus[0]->name }}
        </li>
        @endif
      </ol>

      <div class="row">
     
        <div class="col-md-6 product-slider mb-50">
          
          <div class="flickity flickity-slider-wrap mfp-hover" id="gallery-main">
            
            @foreach ($ProductMultipleImgs as $ProductMultipleImg)
                <div class="gallery-cell">
                    <a href="{{ asset('storage/'.$ProductMultipleImg->img.'') }}" class="lightbox-img">
                      <img src="{{ asset('storage/'.$ProductMultipleImg->img.'') }}" alt="" />
                    </a>
                </div>
            @endforeach
           
          </div> <!-- end gallery main -->

          <div class="gallery-thumbs" id="gallery-thumbs">
            @foreach ($ProductMultipleImgs as $ProductMultipleImg)
                <div class="gallery-cell">
                    <img src="{{ asset('storage/'.$ProductMultipleImg->img.'') }}" alt="" />
                </div>
            @endforeach
          </div> <!-- end gallery thumbs -->

        </div> <!-- end col img slider -->

        <div class="col-md-6 product-single">
          <h1 class="product-single__title uppercase">{{ $product->name }}</h1>
          <!--  
          <div class="rating">
            <a href="#">3 Reviews</a>
          </div>
          -->
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
          </div>
          -->

          <form action="/add_cart" method="POST" id="myForm">
            @csrf
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
            </div>
            -->
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
              <input type="hidden" id="p_id" name="p_id" value=""/>
            </div>
            
            <div class="col">
              <!--<a href="#" class="btn btn-lg btn-dark product-single__add-to-wishlist">
                <i class="ui-heart"></i>
                <span>Wishlist</span>
              </a>-->
            </div>
          </div>   
          </form>
          

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
          </div>
          -->

          <!-- Accordion -->
          <div class="accordion mb-50" id="accordion">
            <div class="accordion__panel">
              <div class="accordion__heading" id="headingOne">
                <a data-toggle="collapse" href="#collapseOne" class="accordion__link accordion--is-open" aria-expanded="true" aria-controls="collapseOne">Description<span class="accordion__toggle">&nbsp;</span>
                </a>
              </div>
              <div id="collapseOne" class="collapse show" data-parent="#accordion" role="tabpanel" aria-labelledby="headingOne">
                <div class="accordion__body">
                  Namira is a very slick and clean e-commerce template with endless possibilities. Creating an awesome clothes store with this Theme is easy than you can imagine.
                </div>
              </div>
            </div>

            <div class="accordion__panel">
              <div class="accordion__heading" id="headingTwo">
                <a data-toggle="collapse" href="#collapseTwo" class="accordion__link accordion--is-closed" aria-expanded="false" aria-controls="collapseTwo">Information<span class="accordion__toggle">&nbsp;</span>
                </a>
              </div>
              <div id="collapseTwo" class="collapse" data-parent="#accordion" role="tabpanel" aria-labelledby="headingTwo">
                <div class="accordion__body">
                  <table class="table shop_attributes">
                    <tbody>
                      <tr>
                        <th>Size:</th>
                        <td>EU 41 (US 8), EU 42 (US 9), EU 43 (US 10), EU 45 (US 12)</td>
                      </tr>
                      <tr>
                        <th>Colors:</th>
                        <td>Violet, Black, Blue</td>
                      </tr>
                      <tr>
                        <th>Fabric:</th>
                        <td>Cotton (100%)</td>
                      </tr>                                     
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="accordion__panel">
              <div class="accordion__heading" id="headingThree">
                <a data-toggle="collapse" href="#collapseThree" class="accordion__link accordion--is-closed" aria-expanded="false" aria-controls="collapseThree">Reviews<span class="accordion__toggle">&nbsp;</span>
                </a>
              </div>
              <div id="collapseThree" class="collapse" data-parent="#accordion" role="tabpanel" aria-labelledby="headingThree">
                <div class="accordion__body">
                  <div class="reviews">
                    <ul class="reviews__list">
                      <li class="reviews__list-item">
                        <div class="reviews__body">
                          <div class="reviews__content">
                            <p class="reviews__author"><strong>Alexander Samokhin</strong> - May 6, 2017 at 12:48 pm</p>
                            <div class="rating">
                              <a href="#"></a>
                            </div>
                            <p>This template is so awesome. I didn’t expect so many features inside. E-commerce pages are very useful, you can launch your online store in few seconds. I will rate 5 stars.</p>
                          </div>
                        </div>
                      </li>

                      <li class="reviews__list-item">
                        <div class="reviews__body">
                          <div class="reviews__content">
                            <p class="reviews__author"><strong>Christopher Robins</strong> - May 7, 2014 at 12:48 pm</p>
                            <div class="rating">
                              <a href="#"></a>
                            </div>
                            <p>This template is so awesome. I didn’t expect so many features inside. E-commerce pages are very useful, you can launch your online store in few seconds. I will rate 5 stars.</p>
                          </div>
                        </div>
                      </li>

                    </ul>         
                  </div> <!--  end reviews -->
                </div>
              </div>
            </div>
          </div> <!-- end accordion -->

        </div> <!-- end col product description -->
      </div> <!-- end row -->
     
    </div> <!-- end container -->
  </section> <!-- end single product -->


  <!-- Related Products -->

  {{-- <section class="section-wrap pt-0 pb-40">
    <div class="container">

      <div class="heading-row">
        <div class="text-center">
          <h2 class="heading bottom-line">
            Shop the look
          </h2>
        </div>
      </div>

      <div class="row row-8">

        <div class="col-lg-2 col-sm-4 product">
          <div class="product__img-holder">
            <a href="single-product.html" class="product__link">
              <img src="img/shop/product_1.jpg" alt="" class="product__img">
              <img src="img/shop/product_back_1.jpg" alt="" class="product__img-back">
            </a>
            <div class="product__actions">
              <a href="quickview.html" class="product__quickview">
                <i class="ui-eye"></i>
                <span>Quick View</span>
              </a>
              <a href="#" class="product__add-to-wishlist">
                <i class="ui-heart"></i>
                <span>Wishlist</span>
              </a>
            </div>
          </div>

          <div class="product__details">
            <h3 class="product__title">
              <a href="single-product.html">Joeby Tailored Trouser</a>
            </h3>
          </div>

          <span class="product__price">
            <ins>
              <span class="amount">$17.99</span>
            </ins>
          </span>
        </div> <!-- end product -->

        <div class="col-lg-2 col-sm-4 product">
          <div class="product__img-holder">
            <a href="single-product.html" class="product__link">
              <img src="img/shop/product_9.jpg" alt="" class="product__img">
              <img src="img/shop/product_back_9.jpg" alt="" class="product__img-back">
            </a>
            <div class="product__actions">
              <a href="quickview.html" class="product__quickview">
                <i class="ui-eye"></i>
                <span>Quick View</span>
              </a>
              <a href="#" class="product__add-to-wishlist">
                <i class="ui-heart"></i>
                <span>Wishlist</span>
              </a>
            </div>
          </div>

          <div class="product__details">
            <h3 class="product__title">
              <a href="single-product.html">Men’s Belt</a>
            </h3>
          </div>

          <span class="product__price">
            <ins>
              <span class="amount">$9.90</span>
            </ins>
          </span>
        </div> <!-- end product -->

        <div class="col-lg-2 col-sm-4 product">
          <div class="product__img-holder">
            <a href="single-product.html" class="product__link">
              <img src="img/shop/product_10.jpg" alt="" class="product__img">
              <img src="img/shop/product_back_10.jpg" alt="" class="product__img-back">
            </a>
            <div class="product__actions">
              <a href="quickview.html" class="product__quickview">
                <i class="ui-eye"></i>
                <span>Quick View</span>
              </a>
              <a href="#" class="product__add-to-wishlist">
                <i class="ui-heart"></i>
                <span>Wishlist</span>
              </a>
            </div>
          </div>

          <div class="product__details">
            <h3 class="product__title">
              <a href="single-product.html">Sport Hi Adidas</a>
            </h3>
          </div>

          <span class="product__price">
            <ins>
              <span class="amount">$29.00</span>
            </ins>
          </span>
        </div> <!-- end product -->

        <div class="col-lg-2 col-sm-4 product">
          <div class="product__img-holder">
            <a href="single-product.html" class="product__link">
              <img src="img/shop/product_2.jpg" alt="" class="product__img">
              <img src="img/shop/product_back_2.jpg" alt="" class="product__img-back">
            </a>
            <div class="product__actions">
              <a href="quickview.html" class="product__quickview">
                <i class="ui-eye"></i>
                <span>Quick View</span>
              </a>
              <a href="#" class="product__add-to-wishlist">
                <i class="ui-heart"></i>
                <span>Wishlist</span>
              </a>
            </div>
          </div>

          <div class="product__details">
            <h3 class="product__title">
              <a href="single-product.html">Denim Hooded</a>
            </h3>
          </div>

          <span class="product__price">
            <ins>
              <span class="amount">$30.00</span>
            </ins>
          </span>
        </div> <!-- end product -->

        <div class="col-lg-2 col-sm-4 product">
          <div class="product__img-holder">
            <a href="single-product.html" class="product__link">
              <img src="img/shop/product_3.jpg" alt="" class="product__img">
              <img src="img/shop/product_back_3.jpg" alt="" class="product__img-back">
            </a>
            <div class="product__actions">
              <a href="quickview.html" class="product__quickview">
                <i class="ui-eye"></i>
                <span>Quick View</span>
              </a>
              <a href="#" class="product__add-to-wishlist">
                <i class="ui-heart"></i>
                <span>Wishlist</span>
              </a>
            </div>
          </div>

          <div class="product__details">
            <h3 class="product__title">
              <a href="single-product.html">Mint Maxi Dress</a>
            </h3>
          </div>

          <span class="product__price">
            <ins>
              <span class="amount">$17.99</span>
            </ins>
            <del>
              <span>$30.00</span>
            </del>
          </span>
        </div> <!-- end product -->

        <div class="col-lg-2 col-sm-4 product">
          <div class="product__img-holder">
            <a href="single-product.html" class="product__link">
              <img src="img/shop/product_4.jpg" alt="" class="product__img">
              <img src="img/shop/product_back_4.jpg" alt="" class="product__img-back">
            </a>
            <div class="product__actions">
              <a href="quickview.html" class="product__quickview">
                <i class="ui-eye"></i>
                <span>Quick View</span>
              </a>
              <a href="#" class="product__add-to-wishlist">
                <i class="ui-heart"></i>
                <span>Wishlist</span>
              </a>
            </div>
          </div>

          <div class="product__details">
            <h3 class="product__title">
              <a href="single-product.html">White Flounce Dress</a>
            </h3>
          </div>

          <span class="product__price">
            <ins>
              <span class="amount">$15.99</span>
            </ins>
            <del>
              <span>$27.00</span>
            </del>
          </span>
        </div> <!-- end product -->
  
      </div> <!-- end row -->
    </div> <!-- end container -->
  </section> <!-- end related products --> --}}



@endsection