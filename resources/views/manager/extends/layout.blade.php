<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title','Manager')</title>

    @include('manager.inc.head')
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                @include('manager.inc.sideleft')
            </div>

            <!-- top navigation -->
            @include('manager.inc.top_nav')
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
            @yield('content')
            </div>
            <!-- /page content -->

            <!-- footer content -->
            @include('manager.inc.footer')
            <!-- /footer content -->
        </div>
    </div>

    @include('manager.inc.body_js')
</body>

</html>
