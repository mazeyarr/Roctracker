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
                heading: 'Waarschuwing'
                , text: '{!! Session::get('warning') !!}'
                , position: 'top-right'
                , loaderBg: '#ffef6b'
                , icon: 'warning'
                , hideAfter: 3500
                , stack: 6
            })
        });
    </script>
@endif

@if(Session::has('info'))
    <script type="text/javascript">
        $(document).ready(function () {
            $.toast({
                heading: 'Info'
                , text: '{!! Session::get('info') !!}'
                , position: 'top-right'
                , loaderBg: '#6a84ff'
                , icon: 'info'
                , hideAfter: 2500
                , stack: 6
            })
        });
    </script>
@endif

@if(isset($warning))
    <script type="text/javascript">
        $(document).ready(function () {
            $.toast({
                heading: 'Waarschuwing'
                , text: '{!! $warning !!}'
                , position: 'top-right'
                , loaderBg: '#ff6849'
                , icon: 'warning'
                , hideAfter: 3500
                , stack: 6
            })
        });
    </script>
@endif

@if($errors->all())
    <script type="text/javascript">
        $(document).ready(function () {
            $.toast({
                heading: 'Error'
                , text: '{!! $errors->first() !!}'
                , position: 'top-right'
                , loaderBg: '#ff6849'
                , icon: 'error'
                , hideAfter: 3500
                , stack: 6
            })
        });
    </script>
@endif
<script type="text/javascript">
    function ezToast(header, text, icon, time, color) {
        $.toast({
            heading: header
            , text: text
            , position: 'top-right'
            , loaderBg: color
            , icon: icon
            , hideAfter: time
            , stack: 6
        })
    }
</script>

