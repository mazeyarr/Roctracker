@if(Session::has('success'))
    <script type="text/javascript">
        $(document).ready(function () {
            $.toast({
                heading: 'Success'
                , text: '{!! Session::get('success') !!}'
                , position: 'top-right'
                , icon: 'success'
                , hideAfter: 3000
                , stack: 6
            })
        });
    </script>
@endif
@if(Session::has('warning'))
    <script type="text/javascript">
        $(document).ready(function () {
            $.toast({
                heading: 'Success'
                , text: '{!! Session::get('warning') !!}'
                , position: 'top-right'
                , loaderBg: '#ff6849'
                , icon: 'warning'
                , hideAfter: 3500
                , stack: 6
            })
        });
    </script>
@endif