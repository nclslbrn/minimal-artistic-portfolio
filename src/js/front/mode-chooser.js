/**
 * Detect and change color theme
 * https://stackoverflow.com/questions/56300132/how-to-override-css-prefers-color-scheme-setting#answer-56550819
 */

//determines if the user has a set theme
function detectColorScheme() {
    var theme = 'light' //default to light

    //local storage is used to override OS theme settings
    if (localStorage.getItem('theme')) {
        if (localStorage.getItem('theme') == 'dark') {
            var theme = 'dark'
        } else {
            var theme = 'light'
        }
    } else if (!window.matchMedia) {
        //matchMedia method not supported
        return false
    } else if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
        //OS theme setting detected as dark
        var theme = 'dark'
    }

    //dark theme preferred, set document with a `data-theme` attribute
    if (theme == 'dark') {
        document.documentElement.setAttribute('data-theme', 'dark')
    } else {
        document.documentElement.setAttribute('data-theme', 'light')
    }
}
detectColorScheme()

const modeSwitch = document.querySelector('input[name="mode-switcher"]')

const switchTheme = (e) => {
    if (e.target.checked) {
        localStorage.setItem('theme', 'dark')
        document.documentElement.setAttribute('data-theme', 'dark')
        modeSwitch.checked = true
    } else {
        localStorage.setItem('theme', 'light')
        document.documentElement.setAttribute('data-theme', 'light')
        modeSwitch.checked = false
    }
}

if (modeSwitch) {
    modeSwitch.addEventListener('change', switchTheme, false)
    if (document.documentElement.getAttribute('data-theme') == 'dark') {
        modeSwitch.checked = true
    }
}
