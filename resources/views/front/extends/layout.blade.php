<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title','')</title>
    
    @include('front.inc.head')
</head>


<body>

    @include('front.inc.mobile_header')

    <main class="main oh" id="main">
    @include('front.inc.nav')
    
 
    @yield('content','')

    @include('front.inc.footer')
    </main> <!-- end main-wrapper -->     

    
    @include('front.inc.body_js')
    
</body>
</html>    