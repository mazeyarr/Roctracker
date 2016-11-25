<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials._head')
    @yield('styles')
</head>
<body>
<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<div id="wrapper">
    @include('partials._navigation._top-navbar')
    @include('partials._navigation._side-navbar')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            @include('partials._page._pageheader')
            @yield('content')
        </div><!-- /.container-fluid -->
        @include('partials._footer')
    </div><!-- /#page-wrapper -->
</div><!-- /#wrapper -->
@include('partials._javascripts')
@yield('scripts')

{{-- Variable login is set by the Auth controller --}}
@if(Session::has('login'))
<script type="text/javascript">
    $(document).ready(function () {
        $.toast({
            heading: 'Welkom {!! Auth::user()->name !!}'
            , text: 'Success met uw taken !'
            , position: 'top-right'
            , loaderBg: '#ff6849'
            , icon: 'success'
            , hideAfter: 3000
            , stack: 6
        })
    });
@endif

</script> <!--Style Switcher -->
</body>
</html>