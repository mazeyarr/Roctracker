$(document).ready(function (e) {
    /*$(document).idle({
        onIdle: function(){
            window.location.href = "/idle/";
        },
        idle: 600000
    })*/
    var searchbar = $('#searchbar');
    searchbar.focus(function () {
        var container = $('#container-search-results');
        $(document).keypress(function(e) {
            if(e.which === 13) {
                e.preventDefault();
                e.stopPropagation();
            }
        });
        container.fadeIn('fast');
    });

    searchbar.blur(function () {
        var container = $('#container-search-results');
        $(document).keypress(function(e) {
            if(e.which === 13) {}
        });
        container.fadeOut('fast');
    });

    searchbar.keyup(function () {
        var container = $('#container-search-results'),
            list = $('#search-results');

        if ($(this).val() === "") {
            container.fadeOut('fast');
            return;
        }
        container.fadeIn('fast');
        list.empty();
        list.append('<i class="fa fa-circle-o-notch fa-spin" style="right: 50%; font-size:25px; color: #ff66ed;"></i>');

        var url = laroute.route('ajax_search', { search_stroke : $(this).val() });
        $.getJSON(url, function (result) {
            list.empty();

            if (result.length === 0) {
                list.append('<span>Geen Resultaten</span>');
            }
            $.each(result, function (search_results, search_result) {
                list.append($('<li id="search-result-link-'+search_result.id+'" data-url="'+ search_result.url +'">'+ search_result.name +" ("+ search_result.typeOf +') </li>').hide().fadeIn(50));
                $('#search-result-link-'+search_result.id).click(function () {
                    var toUrl = $(this).attr('data-url');
                    window.location.href = toUrl;
                });
            });
        });
    });
});
