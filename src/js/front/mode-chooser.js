/**
 * Detect and change color theme
 * https://stackoverflow.com/questions/56300132/how-to-override-css-prefers-color-scheme-setting#answer-56550819
 */

//determines if the user has a set theme
const detectColorScheme = () => {
    let theme = 'light' //default to light

    //local storage is used to override OS theme settings
    if (localStorage.getItem('theme')) {
        if (localStorage.getItem('theme') == 'dark') {
            theme = 'dark'
        } else {
            theme = 'light'
        }
    } else if (!window.matchMedia) {
        //matchMedia method not supported
        return false
    } else if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
        //OS theme setting detected as dark
        theme = 'dark'
    }

    //dark theme preferred, set document with a `data-theme` attribute
    if (theme == 'dark') {
        document.documentElement.setAttribute('data-theme', 'dark')
    } else {
        document.documentElement.setAttribute('data-theme', 'light')
    }
    console.log(
        'init theme',
        document.documentElement.getAttribute('data-theme')
    )
}

detectColorScheme()

const modeSwitches = document.querySelectorAll('input[name="mode-switcher"]')

const switchTheme = (e) => {
    if (e.target.checked) {
        localStorage.setItem('theme', 'dark')
        document.documentElement.setAttribute('data-theme', 'dark')
        updateCheckBox(true)
    } else {
        localStorage.setItem('theme', 'light')
        document.documentElement.setAttribute('data-theme', 'light')
        updateCheckBox(false)
    }
}

const updateCheckBox = (checked) => {
    for (let i = 0; i < modeSwitches.length; i++) {
        modeSwitches[i].checked = checked
    }
}

if (typeof modeSwitches !== 'undefined') {
    for (let i = 0; i < modeSwitches.length; i++) {
        modeSwitches[i].addEventListener('change', switchTheme, false)
        if (document.documentElement.getAttribute('data-theme') == 'dark') {
            modeSwitches[i].checked = true
        }
    }
}
