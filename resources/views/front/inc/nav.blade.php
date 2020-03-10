    <!-- Navigation -->
    <header class="nav">

        <div class="nav__holder nav--sticky">
            <div class="container relative">

                <!-- Top Bar -->
                <div class="top-bar d-none d-lg-flex">

                    <!-- Currency / Language -->
                   <!--
                    <ul class="top-bar__currency-language">
                        <li class="top-bar__language">
                            <a href="#">English</a>
                            <div class="top-bar__language-dropdown">
                                <ul>
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">Spanish</a></li>
                                    <li><a href="#">German</a></li>
                                    <li><a href="#">Chinese</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="top-bar__currency">
                            <a href="#">USD</a>
                            <div class="top-bar__currency-dropdown">
                                <ul>
                                    <li><a href="#">USD</a></li>
                                    <li><a href="#">EUR</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>-->

                    <!-- Promo -->
                    <p class="top-bar__promo text-center">Free shipping on orders over $50</p>

                    <!-- Sign in / Wishlist / Cart -->
                    <div class="top-bar__right">

                        <!-- Sign In -->
                        @if (Auth::guard('user_account')->check()) 
                            <i class="ui-user"></i> {{ Auth::guard("user_account")->user()->email  }}
                        
                            <a href="{{ asset('/logout') }}" class="top-bar__item top-bar__sign-in" >Logout</a> <!-- id="top-bar__sign-in  => colorbox  -->
                        @else
                            <a href="{{ asset('/login') }}" class="top-bar__item top-bar__sign-in" ><i
                            class="ui-user"></i>Sign In</a> <!-- id="top-bar__sign-in  => colorbox  -->
                        @endif

                       

                        <!-- Wishlist -->
                        <!--<a href="#" class="top-bar__item"><i class="ui-heart"></i></a>-->

                        <div class="top-bar__item nav-cart">
                            <a href="/cart">
                                <i class="ui-bag"></i>
                               @php
                                    if(Auth::guard('user_account')->check()) {
                                        $user_id=Auth::guard("user_account")->user()->user_id;
                                        $cart_count=\App\OrderCart::WHERE('user_id',$user_id)->WHERE('session_id',">",0)->count();
                                        echo '('.$cart_count.')';
                                    }else{
                                        echo '(0)';
                                    }
                               @endphp
                                
                            </a>
                            @if (Auth::guard('user_account')->check())
                                <div class="nav-cart__dropdown">
                                    <!--
                                    <div class="nav-cart__items">

                                        <div class="nav-cart__item clearfix">
                                            <div class="nav-cart__img">
                                                <a href="#">
                                                    <img src="{{ asset('front/img/shop/cart_small_1.jpg') }}" alt="">
                                                </a>
                                            </div>
                                            <div class="nav-cart__title">
                                                <a href="#">
                                                    Classic White Tailored Shirt
                                                </a>
                                                <div class="nav-cart__price">
                                                    <span>1 x</span>
                                                    <span>19.99</span>
                                                </div>
                                            </div>
                                            <div class="nav-cart__remove">
                                                <a href="#"><i class="ui-close"></i></a>
                                            </div>
                                        </div>

                                        <div class="nav-cart__item clearfix">
                                            <div class="nav-cart__img">
                                                <a href="#">
                                                    <img src="{{ asset('front/img/shop/cart_small_2.jpg') }}" alt="">
                                                </a>
                                            </div>
                                            <div class="nav-cart__title">
                                                <a href="#">
                                                    Sport Hi Adidas
                                                </a>
                                                <div class="nav-cart__price">
                                                    <span>1 x</span>
                                                    <span>29.00</span>
                                                </div>
                                            </div>
                                            <div class="nav-cart__remove">
                                                <a href="#"><i class="ui-close"></i></a>
                                            </div>
                                        </div>

                                    </div> -->
                                    <!-- end cart items -->

                                    <!--
                                    <div class="nav-cart__summary">
                                        <span>Cart Subtotal</span>
                                        <span class="nav-cart__total-price">$1799.00</span>
                                    </div>-->
                                    
                                        <div class="nav-cart__actions mt-20">
                                            <a href="/cart" class="btn btn-md btn-light"><span>View Cart</span></a>
                                            <a href="/orderlist" class="btn btn-md btn-color mt-10"><span>
                                                    Order List</span></a>
                                        </div>     
                                    
                                </div>
                            @endif
                        </div>
                    </div>

                </div> <!-- end top bar -->

                <div class="flex-parent">

                    <!-- Mobile Menu Button -->
                    <button class="nav-icon-toggle" id="nav-icon-toggle" aria-label="Open mobile menu">
                        <span class="nav-icon-toggle__box">
                            <span class="nav-icon-toggle__inner"></span>
                        </span>
                    </button> <!-- end mobile menu button -->

                    <!-- Logo -->
                    <a href="/" class="logo">
                        <img class="logo__img" src="{{ asset('front/img/logo_light.png') }}" alt="logo">
                    </a>

                    <!-- Nav-wrap -->
                    <nav class="flex-child nav__wrap d-none d-lg-block">
                        <ul class="nav__menu">
                            @php
                            $menus=\App\Mainmenu::with('submenus')->WHERE('status',1)->get();    
                          
                            @endphp        
                            
                            @foreach ($menus as $menu)
                                <li class="nav__dropdown active">
                                    <a href="javascript:void(0);">{{ $menu->name }}</a>
                                    <ul class="nav__dropdown-menu">
                                @foreach ($menu->submenus as $submenu)
                                    <li><a href="/catalog/sub/{{ $menu->menu_id }}/{{ $submenu->sub_id }}">{{ $submenu->name }}</a></li>
                                @endforeach
                                    </ul>
                                </li>
                            @endforeach
                            <!--        
                            <li class="nav__dropdown active">
                                <a href="catalog.html">Men</a>
                                <ul class="nav__dropdown-menu">
                                    <li><a href="#">T-shirt</a></li>
                                    <li><a href="#">Hoodie &amp; Jackets</a></li>
                                    <li><a href="#">Suits</a></li>
                                    <li><a href="#">Shorts</a></li>
                                </ul>
                            </li>

                            <li class="nav__dropdown">
                                <a href="catalog.html">Women</a>
                                <ul class="nav__dropdown-menu">
                                    <li><a href="#">Underwear</a></li>
                                    <li><a href="#">Hipster</a></li>
                                    <li><a href="#">Dress</a></li>
                                    <li><a href="#">Hoodie &amp; Jackets</a></li>
                                    <li><a href="#">Tees</a></li>
                                </ul>
                            </li>

                            <li class="nav__dropdown">
                                <a href="catalog.html">Accessories</a>
                                <ul class="nav__dropdown-menu nav__megamenu">
                                    <li>
                                        <div class="nav__megamenu-wrap">
                                            <div class="row">

                                                <div class="col nav__megamenu-item">
                                                    <a href="#" class="nav__megamenu-title">All accessories</a>
                                                    <ul class="nav__megamenu-list">
                                                        <li><a href="#">Wallets</a></li>
                                                        <li><a href="#">Scarfs</a></li>
                                                        <li><a href="#">Belts</a></li>
                                                        <li><a href="#">Shoes</a></li>
                                                    </ul>
                                                </div>

                                                <div class="col nav__megamenu-item">
                                                    <a href="#" class="nav__megamenu-title">for her</a>
                                                    <ul class="nav__megamenu-list">
                                                        <li><a href="#">Underwear</a></li>
                                                        <li><a href="#">Hipster</a></li>
                                                        <li><a href="#">Dress</a></li>
                                                        <li><a href="#">Hoodie &amp; Jackets</a></li>
                                                        <li><a href="#">Tees</a></li>
                                                    </ul>
                                                </div>

                                                <div class="col nav__megamenu-item">
                                                    <a href="#" class="nav__megamenu-title">for him</a>
                                                    <ul class="nav__megamenu-list">
                                                        <li><a href="#">T-shirt</a></li>
                                                        <li><a href="#">Hoodie &amp; Jackets</a></li>
                                                        <li><a href="#">Suits</a></li>
                                                        <li><a href="#">Shorts</a></li>
                                                    </ul>
                                                </div>

                                                <div class="col nav__megamenu-item">
                                                    <a href="#" class="nav__megamenu-title">watches</a>
                                                    <ul class="nav__megamenu-list">
                                                        <li><a href="#">Smart Watches</a></li>
                                                        <li><a href="#">Diving Watches</a></li>
                                                        <li><a href="#">Sport Watches</a></li>
                                                        <li><a href="#">Classic Watches</a></li>
                                                    </ul>
                                                </div>

                                                <div class="col nav__megamenu-item">
                                                    <a href="#"><img src="img/shop/megamenu_banner.png" alt=""></a>
                                                </div>

                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav__dropdown">
                                <a href="blog-standard.html">News</a>
                                <ul class="nav__dropdown-menu">
                                    <li><a href="blog-standard.html">Blog Standard</a></li>
                                    <li><a href="blog-single.html">Single Post</a></li>
                                </ul>
                            </li>

                            <li class="nav__dropdown">
                                <a href="contact.html">Pages</a>
                                <ul class="nav__dropdown-menu">
                                    <li><a href="catalog.html">Catalog</a></li>
                                    <li><a href="single-product.html">Single Product</a></li>
                                    <li><a href="cart.html">Cart</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="about.html">About</a></li>
                                    <li><a href="contact.html">Contact</a></li>
                                    <li><a href="faq.html">FAQ</a></li>
                                    <li><a href="404.html">404</a></li>
                                </ul>
                            </li>-->

                        </ul> <!-- end menu -->

                    </nav> <!-- end nav-wrap -->


                    <!-- Search -->
                    <!--
                    <div class="flex-child nav__search d-none d-lg-block">
                        <form method="get" class="nav__search-form">
                            <input type="search" class="nav__search-input" placeholder="Search">
                            <button type="submit" class="nav__search-submit">
                                <i class="ui-search"></i>
                            </button>
                        </form>
                    </div>-->


                    <!-- Mobile Wishlist -->
                    <!--<a href="#" class="nav__mobile-wishlist d-lg-none" aria-label="Mobile wishlist">
                        <i class="ui-heart"></i>
                    </a>-->

                    <!-- Mobile Cart -->
                    <a href="/cart" class="nav__mobile-cart d-lg-none">
                        <i class="ui-bag"></i>
                        <span class="nav__mobile-cart-amount">(2)</span>
                    </a>




                </div> <!-- end flex-parent -->
            </div> <!-- end container -->

        </div>
    </header> <!-- end navigation -->