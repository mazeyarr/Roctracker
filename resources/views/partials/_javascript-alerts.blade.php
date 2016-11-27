@if(Session::has('success'))
    <script type="text/javascript">
        $(document).ready(function () {
            $.toast({
                heading: 'Success'
                , text: '{!! Session::get('success') !!}'
                , position: 'top-right'
                , loaderBg: '#ff6849'
                , icon: 'success'
                , hideAfter: 3000
                , stack: 6
            })
        });
    </script>
@endif