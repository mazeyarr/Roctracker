$(document).ready(function (e) {
    $(document).idle({
        onIdle: function(){
            window.location.href = "/idle/";
        },
        idle: 60000
    })
});