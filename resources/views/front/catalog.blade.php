@extends('front.extends.layout')


@section('title','catalog')

@section('content')

<!-- Catalog -->
<section class="section-wrap pt-60 pb-30 catalog">
    <div class="container">

        <!-- Breadcrumbs -->
        <ol class="breadcrumbs">
            <li>
                <a href="/">Home</a>
            </li>
            <li>
                <a href="javascript:void(0);">{{ $mainmenus[0]->name }}</a>
            </li>
            @if($type=='sub')
            <li class="active">
                {{ $mainmenus[0]->submenus[0]->name }}
            </li> 
            @endif
        </ol>


        @php
      
        $url='/catalog/'.$type.'/'.$mainmenus[0]->menu_id.'/'.$mainmenus[0]->submenus[0]->sub_id;
        
        //dd(url()->current());
        @endphp   
        <form action='{{ $url }}' method="POST" id='myForm'>
        <div class="row">
         
            <div class="col-lg-9 order-lg-2 mb-40">

                <!-- Filter -->
                <div class="shop-filter">
                    <p class="woocommerce-result-count">
                        <!--Showing: 1-12 of 80 results-->
                    </p>
                    <span class="woocommerce-ordering-label">Sort by</span>
                        
                        <select name='search_sort' class="woocommerce-ordering" id="search_sort" onChange='$("#myForm").submit();'>
                            @php
                                $sort_arr=array(
                                    'Default Sorting'=>"",
                                    'Price: high to low'=>"price-h",
                                    'Price: low to high'=>"price-l",
                                );
                                foreach($sort_arr as $k => $v){
                                    if($search_sort==$v){
                                        $selected='selected';    
                                    }else{
                                        $selected='';    
                                    }
                                    echo ' <option value="'.$v.'" '.$selected.'>'.$k.'</option>';
                                } 
                             
                            @endphp
                            
                            
                            <!--<option value="by-popularity">By Popularity</option>
                            <option value="date">By Newness</option>
                            <option value="rating">By Rating</option>-->
                        </select>
                </div>

                <div class="row row-8">
                    @foreach ($products as $product)
                  
                    <div class="col-md col-sm-6 product">
                        <div class="product__img-holder">
                            <a href="/SingleProduct/{{ $product->p_id }}" class="product__link">
                                <img src="{{ asset("storage/".$product->img) }}" alt="" class="product__img">
                                <img src="{{ asset("storage/".$product->img) }}" alt="" class="product__img-back">
                            </a>
                            <!--<div class="product__actions">
                                <a href="/quickview/{{ $product->p_id }}" class="product__quickview">
                                    <i class="ui-eye"></i>
                                    <span>Quick View</span>
                                </a>
                                <a href="#" class="product__add-to-wishlist">
                                    <i class="ui-heart"></i>
                                    <span>Wishlist</span>
                                </a>
                            </div>-->
                        </div>

                        <div class="product__details">
                            <h3 class="product__title">
                                <a href="single-product.html">{{ $product->name }}</a>
                            </h3>
                        </div>

                        <span class="product__price">
                            <ins>
                                <span class="amount">${{ $product->price }}</span>
                            </ins>
                        </span>
                    </div> <!-- end product -->
                    
                        @php      
                            //每4個換行 
                            if($loop->iteration%4==0){
                                echo '<div class="w-100"></div>';
                            }
                            //最後一個，補差額，不然畫面很怪
                            if($loop->remaining==0){
                                $remainder=$loop->count%4;
                                $end=4-$remainder;
                                
                                for($i=0;$i<$end;$i++){
                                    echo ' <div class="col-md col-sm-6 product"></div>';
                                }
                            }

                        @endphp
                    @endforeach
    
                    <!--
                    <div class="col-md col-sm-6 product">
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
                    </div> 
                    <div class="w-100"></div>
                    -->


                   

            

                </div> <!-- end row -->

                <!-- Pagination -->
                <div class="pagination clearfix">
                    <nav class="pagination__nav right clearfix">
                        <!--上一頁-->
                        @if(!$products->onFirstPage())
                            <a href="{{ $products->previousPageUrl() }}" class="pagination__page"><i class="ui-arrow-left"></i></a>
                        @endif
                       
                        
                        @for ($i = 1; $i < $products->lastPage()+1; $i++)
                            @if(url()->getRequest()->page==$i)
                                <span class="pagination__page pagination__page--current">{{ $i }}</span>
                            @else
                                <a href="javascript:void(0);" onClick="on_page({{ $i }});"" class="pagination__page">{{ $i }}</a>
                            @endif
                        @endfor

                        <!--下一頁-->
                        @if($products->hasMorePages())
                            <a href="{{ $products->nextPageUrl() }}" class="pagination__page"><i class="ui-arrow-right"></i></a>
                        @endif
                    </nav>
                </div>
                <script>
                    function on_page(page){
                        var search_amount=$('#amount').val();
                        var search_sort=$('#search_sort').val();
                       
                        location.replace('{{  url()->current() }}?page='+page+'&search_sort='+search_sort+'&search_amount='+search_amount+'');
                    }
                </script>

            </div> <!-- end col -->


            <!-- Sidebar -->
            <aside class="col-lg-3 sidebar left-sidebar">

                <!-- Categories -->
                <div class="widget widget_categories widget--bottom-line">
                    @if($type=='main')
                    <h4 class="widget-title">{{ $mainmenus[0]->name }}</h4>
                    <ul>
                        @php
                            //dd($mainmenus[0]->submenus);
                            $submenus=$mainmenus[0]->submenus;
                        @endphp 

                        @foreach ($submenus as $submenu) 
                        <li>
                            <a href="/catalog/sub/{{ $mainmenus[0]->menu_id }}/{{ $submenu->sub_id }}">{{ $submenu->name }}</a>
                        </li>
                        @endforeach
                        <!--
                        <li class="active">
                            <a href="#">Men</a>
                        </li>
                        <li>
                            <a href="#">Accessories</a>
                        </li>-->
                   
                    </ul>
                    @else
                    <h4 class="widget-title">{{ $mainmenus[0]->submenus[0]->name }}</h4>
                    @endif
                </div>

                <!-- Size -->
                <!--
                <div class="widget widget__filter-by-size widget--bottom-line">
                    <h4 class="widget-title">Size</h4>
                    <ul class="size-select">
                        <li>
                            <input type="checkbox" class="checkbox" id="small-size" name="small-size">
                            <label for="small-size" class="checkbox-label">X-Small</label>
                        </li>
                        <li>
                            <input type="checkbox" class="checkbox" id="medium-size" name="medium-size">
                            <label for="medium-size" class="checkbox-label">Small</label>
                        </li>
                        <li>
                            <input type="checkbox" class="checkbox" id="large-size" name="large-size">
                            <label for="large-size" class="checkbox-label">Meduim</label>
                        </li>
                        <li>
                            <input type="checkbox" class="checkbox" id="xlarge-size" name="xlarge-size">
                            <label for="xlarge-size" class="checkbox-label">Large</label>
                        </li>
                        <li>
                            <input type="checkbox" class="checkbox" id="xxlarge-size" name="xxlarge-size">
                            <label for="xxlarge-size" class="checkbox-label">X-Large</label>
                        </li>
                    </ul>
                </div>-->

                <!-- Color -->
                 <!--
                <div class="widget widget__filter-by-color widget--bottom-line">
                    <h4 class="widget-title">Color</h4>
                    <ul class="color-select">
                        <li>
                            <input type="checkbox" class="checkbox" id="green-color" name="green-color">
                            <label for="green-color" class="checkbox-label">Green</label>
                        </li>
                        <li>
                            <input type="checkbox" class="checkbox" id="red-color" name="red-color">
                            <label for="red-color" class="checkbox-label">Red</label>
                        </li>
                        <li>
                            <input type="checkbox" class="checkbox" id="blue-color" name="blue-color">
                            <label for="blue-color" class="checkbox-label">Blue</label>
                        </li>
                        <li>
                            <input type="checkbox" class="checkbox" id="white-color" name="white-color">
                            <label for="white-color" class="checkbox-label">White</label>
                        </li>
                        <li>
                            <input type="checkbox" class="checkbox" id="black-color" name="black-color">
                            <label for="black-color" class="checkbox-label">Black</label>
                        </li>
                    </ul>
                </div>-->

                <!-- Filter by Price -->
                <div class="widget widget__filter-by-price widget--bottom-line">
                    <h4 class="widget-title">Filter by Price</h4>
                       
                    <div id="slider-range"></div>
                    <p>
                            @csrf
                            <label for="amount">Price:</label>
                            <input type="text" id="amount" name="search_amount" value='{{ $search_amount }}'>
                            <input type="hidden" id="min" name="min" value="{{ $values_min ?? "" }}">
                            <input type="hidden" id="max" name="max" value="{{ $values_max ?? "" }}">
                           
                        <a href="javascript:void(0);" class="btn btn-sm btn-dark" onClick='$("#myForm").submit();'><span>Filter</span></a>
                    </p>
                </div>
                  
            </aside> <!-- end sidebar -->
            
        </div> <!-- end row -->
    </form> 

    </div> <!-- end container -->
</section> <!-- end catalog -->

<div id="back-to-top">
    <a href="#top"><i class="ui-arrow-up"></i></a>
</div>

@endsection
