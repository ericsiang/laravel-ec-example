<div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
        <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
        <div class="profile_pic">
            <!--<img src="images/img.jpg" alt="..." class="img-circle profile_img">-->
        </div>
        <div class="profile_info">
            <span>Welcome,<h2>{{ Auth::user()->name ?? 'None' }}</h2></span>
        </div>
    </div>
    <!-- /menu profile quick info -->

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
            <!--<h3>帳號管理</h3>-->
            <ul class="nav side-menu">
                <li><a href='/manager/accounts'><i class="fa fa-users"></i>帳號管理<span class="fa fa-chevron-down"></span></a>
                    <!--<ul class="nav child_menu">
                        <li><a href="index.html">Dashboard</a></li>
                        <li><a href="index2.html">Dashboard2</a></li>
                        <li><a href="index3.html">Dashboard3</a></li>
                    </ul>-->
                </li>
            </ul>
    
            <!--<h3>首頁</h3>-->
            <!--
            <ul class="nav side-menu">
                <li><a><i class="fa fa-table"></i>首頁管理<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="">首頁Banner</a></li>
                    </ul>
                </li>
            </ul>-->

            <!--<h3>商品管理</h3>-->
            <ul class="nav side-menu">
                <li><a><i class="fa fa-table"></i>商品管理<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="/manager/products">商品列表</a></li>
                    </ul>
                </li>
            </ul>

            <!--<h3>訂單管理</h3>-->
            <ul class="nav side-menu">
                <li><a><i class="fa fa-table"></i>訂單管理<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="/manager/orders">訂單列表</a></li>
                    </ul>
                </li>
            </ul>

        </div>


    </div>
    <!-- sidebar menu -->


    <!-- /menu footer buttons -->
    <!--<div class="sidebar-footer hidden-small">
        <a data-toggle="tooltip" data-placement="top" title="Settings">
            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="Lock">
            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
        </a>
    </div>-->
    <!-- /menu footer buttons -->


</div>
