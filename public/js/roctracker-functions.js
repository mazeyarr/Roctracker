
function swalShowLoad(bool) {
    var $this = $('.confirm');
    if (bool) {
        $this.button('loading');
    }else {
        $this.button('reset');
    }
}