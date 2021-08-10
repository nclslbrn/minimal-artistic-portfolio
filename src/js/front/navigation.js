jQuery('.menu-toggle').click(function () {
    jQuery(this).toggleClass('open')
    jQuery('#site-navigation').toggleClass('toggled')
    jQuery('body').toggleClass('fixed')
})

jQuery('.menu-item-has-children').click(function () {
    jQuery(this).toggleClass('open')
})

jQuery('.menu-toggle').click()
