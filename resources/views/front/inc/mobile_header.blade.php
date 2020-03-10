  <!-- Preloader -->
  <div class="loader-mask">
      <div class="loader">
          <div></div>
      </div>
  </div>


  <!-- Mobile Sidenav -->
  <header class="sidenav" id="sidenav">
      <!-- Search -->
      <div class="sidenav__search-mobile">
          <form method="get" class="sidenav__search-mobile-form">
              <input type="search" class="sidenav__search-mobile-input" placeholder="Search..."
                  aria-label="Search input">
              <button type="submit" class="sidenav__search-mobile-submit" aria-label="Submit search">
                  <i class="ui-search"></i>
              </button>
          </form>
      </div>

      <nav>
          <ul class="sidenav__menu" role="menubar">
                @php
                    $menus=\App\Mainmenu::with('submenus')->WHERE('status',1)->get();    
                @endphp        
                
                @foreach ($menus as $menu)
                    <li>
                        <a href="#" class="sidenav__menu-link">{{ $menu->name }}</a>
                        <button class="sidenav__menu-toggle" aria-haspopup="true" aria-label="Open dropdown"><i
                                class="ui-arrow-down"></i></button>
                        <ul class="sidenav__menu-dropdown">
                            @foreach ($menu->submenus as $submenu)
                                <li><a href="#" class="sidenav__menu-link">{{ $submenu->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach

              <!--      
              <li>
                  <a href="#" class="sidenav__menu-link">Men</a>
                  <button class="sidenav__menu-toggle" aria-haspopup="true" aria-label="Open dropdown"><i
                          class="ui-arrow-down"></i></button>
                  <ul class="sidenav__menu-dropdown">
                      <li><a href="#" class="sidenav__menu-link">T-shirt</a></li>
                      <li><a href="#" class="sidenav__menu-link">Hoodie &amp; Jackets</a></li>
                      <li><a href="#" class="sidenav__menu-link">Suits</a></li>
                      <li><a href="#" class="sidenav__menu-link">Shorts</a></li>
                  </ul>
              </li>

              <li>
                  <a href="#" class="sidenav__menu-link">Women</a>
                  <button class="sidenav__menu-toggle" aria-haspopup="true" aria-label="Open dropdown"><i
                          class="ui-arrow-down"></i></button>
                  <ul class="sidenav__menu-dropdown">
                      <li><a href="#" class="sidenav__menu-link">Underwear</a></li>
                      <li><a href="#" class="sidenav__menu-link">Hipster</a></li>
                      <li><a href="#" class="sidenav__menu-link">Dress</a></li>
                      <li><a href="#" class="sidenav__menu-link">Hoodie &amp; Jackets</a></li>
                      <li><a href="#" class="sidenav__menu-link">Tees</a></li>
                  </ul>
              </li>

              <li>
                  <a href="#" class="sidenav__menu-link">Accessories</a>
                  <button class="sidenav__menu-toggle" aria-haspopup="true" aria-label="Open dropdown"><i
                          class="ui-arrow-down"></i></button>
                  <ul class="sidenav__menu-dropdown">
                      <li>
                          <a href="#" class="sidenav__menu-link">All accessories</a>
                          <button class="sidenav__menu-toggle" aria-haspopup="true" aria-label="Open dropdown"><i
                                  class="ui-arrow-down"></i></button>
                          <ul class="sidenav__menu-dropdown">
                              <li>
                                  <a href="#" class="sidenav__menu-link">Wallets</a>
                              </li>
                              <li>
                                  <a href="#" class="sidenav__menu-link">Scarfs</a>
                              </li>
                              <li>
                                  <a href="#" class="sidenav__menu-link">Shirt</a>
                              </li>
                              <li>
                                  <a href="#" class="sidenav__menu-link">Shoes</a>
                              </li>
                          </ul>
                      </li>

                      <li>
                          <a href="#" class="sidenav__menu-link">for her</a>
                          <button class="sidenav__menu-toggle" aria-haspopup="true" aria-label="Open dropdown"><i
                                  class="ui-arrow-down"></i></button>
                          <ul class="sidenav__menu-dropdown">
                              <li>
                                  <a href="#" class="sidenav__menu-link">Underwear</a>
                              </li>
                              <li>
                                  <a href="#" class="sidenav__menu-link">Hipster</a>
                              </li>
                              <li>
                                  <a href="#" class="sidenav__menu-link">Dress</a>
                              </li>
                              <li>
                                  <a href="#" class="sidenav__menu-link">Hoodie &amp; Jackets</a>
                              </li>
                              <li>
                                  <a href="#" class="sidenav__menu-link">Tees</a>
                              </li>
                          </ul>
                      </li>

                      <li>
                          <a href="#" class="sidenav__menu-link">for him</a>
                          <button class="sidenav__menu-toggle" aria-haspopup="true" aria-label="Open dropdown"><i
                                  class="ui-arrow-down"></i></button>
                          <ul class="sidenav__menu-dropdown">
                              <li>
                                  <a href="#" class="sidenav__menu-link">T-shirt</a>
                              </li>
                              <li>
                                  <a href="#" class="sidenav__menu-link">Hoodie &amp; Jackets</a>
                              </li>
                              <li>
                                  <a href="#" class="sidenav__menu-link">Dress</a>
                              </li>
                              <li>
                                  <a href="#" class="sidenav__menu-link">Suits</a>
                              </li>
                              <li>
                                  <a href="#" class="sidenav__menu-link">Shorts</a>
                              </li>
                          </ul>
                      </li>

                      <li>
                          <a href="#" class="sidenav__menu-link">Watches</a>
                          <button class="sidenav__menu-toggle" aria-haspopup="true" aria-label="Open dropdown"><i
                                  class="ui-arrow-down"></i></button>
                          <ul class="sidenav__menu-dropdown">
                              <li>
                                  <a href="#" class="sidenav__menu-link">Smart Watches</a>
                              </li>
                              <li>
                                  <a href="#" class="sidenav__menu-link">Diving Watches</a>
                              </li>
                              <li>
                                  <a href="#" class="sidenav__menu-link">Sport Watches</a>
                              </li>
                              <li>
                                  <a href="#" class="sidenav__menu-link">Classic Watches</a>
                              </li>
                          </ul>
                      </li>

                  </ul>
              </li>

              <li>
                  <a href="#" class="sidenav__menu-link">News</a>
                  <button class="sidenav__menu-toggle" aria-haspopup="true" aria-label="Open dropdown"><i
                          class="ui-arrow-down"></i></button>
                  <ul class="sidenav__menu-dropdown">
                      <li><a href="blog-standard.html" class="sidenav__menu-link">Blog Standard</a></li>
                      <li><a href="blog-single.html" class="sidenav__menu-link">Single Post</a></li>
                  </ul>
              </li>

              <li>
                  <a href="#" class="sidenav__menu-link">Pages</a>
                  <button class="sidenav__menu-toggle" aria-haspopup="true" aria-label="Open dropdown"><i
                          class="ui-arrow-down"></i></button>
                  <ul class="sidenav__menu-dropdown">
                      <li><a href="catalog.html" class="sidenav__menu-link">Catalog</a></li>
                      <li><a href="single-product.html" class="sidenav__menu-link">Single Product</a></li>
                      <li><a href="cart.html" class="sidenav__menu-link">Cart</a></li>
                      <li><a href="checkout.html" class="sidenav__menu-link">Checkout</a></li>
                      <li><a href="about.html" class="sidenav__menu-link">About</a></li>
                      <li><a href="contact.html" class="sidenav__menu-link">Contact</a></li>
                      <li><a href="login.html" class="sidenav__menu-link">Login</a></li>
                      <li><a href="faq.html" class="sidenav__menu-link">FAQ</a></li>
                      <li><a href="404.html" class="sidenav__menu-link">404</a></li>
                  </ul>
              </li>
            -->
              <li>
                  <a href="#" class="sidenav__menu-link">Sign In</a>
              </li>
          </ul>
      </nav>
  </header> <!-- end mobile sidenav -->