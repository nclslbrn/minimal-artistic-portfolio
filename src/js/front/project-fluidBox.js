import 'fluidbox'
import jQuery from 'jquery'

window.onload = function () {
    if (window.jQuery) {
        jQuery('a.fluidbox').fluidbox()
    }
}
