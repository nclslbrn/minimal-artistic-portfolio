function setCookie(key, value) {
    var expires = new Date();
    expires.setTime(expires.getTime() + (1 * 24 * 60 * 60 * 1000));
    document.cookie = key + '=' + value + ';expires=' + expires.toUTCString() + ';path=/';
}

function getCookie(key) {
    var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
    return keyValue ? keyValue[2] : null;
}


jQuery(function($) {

    if (getCookie('mode')) {

        $('body').addClass(getCookie('mode'));

    } else {

        $('body').addClass('light');

    }


    $('input[name="mode-switcher"]:checkbox').change(function() {

        $('body').toggleClass('light dark');

        if ($(this).is(":checked")) {

            setCookie('mode', 'dark');

        } else {

            setCookie('mode', 'light');
        }
    });
})