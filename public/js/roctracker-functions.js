
function swalShowLoad(bool) {
    var btn = $('.confirm');
    if (bool) {
        btn.button('loading');
    }else {
        btn.button('reset');
    }
}