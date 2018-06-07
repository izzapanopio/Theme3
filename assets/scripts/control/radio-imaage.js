var $ = jQuery;

$(document).ready(() => {
    setTimeout(() => {
        $('.radio-image-lockup label').click((ev) => {
            $('.radio-image-lockup .active').removeClass('active');
            $(ev.currentTarget).addClass('active'); 
        });
    }, 500);
});


