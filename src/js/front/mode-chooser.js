/**
 * Detect and change color theme
 * https://stackoverflow.com/questions/56300132/how-to-override-css-prefers-color-scheme-setting#answer-56550819
 */

//determines if the user has a set theme
const detectColorScheme = () => {
    let theme = 'light' //default to light

    //local storage is used to override OS theme settings
    if (localStorage.getItem('theme')) {
        if ('dark' === localStorage.getItem('theme')) {
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
    if ('dark' === theme) {
        document.documentElement.setAttribute('data-theme', 'dark')
    } else {
        document.documentElement.setAttribute('data-theme', 'light')
    }
}

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

detectColorScheme()

const modeSwitches = document.querySelectorAll('input[name="mode-switcher"]')
const modeButtons = document.querySelectorAll('button.theme-mode-button')

if ('undefined' !== typeof modeSwitches) {
    for (let i = 0; i < modeSwitches.length; i++) {
        modeSwitches[i].addEventListener('change', switchTheme, false)
        if ('dark' === document.documentElement.dataset.theme) {
            modeSwitches[i].checked = true
        }
    }
}

if ('undefined' !== typeof modeButtons) {
    for (let i = 0; i < modeButtons.length; i++) {
        const theme = modeButtons[i].dataset.mode
        if (null !== theme) {
            modeButtons[i].addEventListener('click', (event) => {
                event.preventDefault()
                document.documentElement.setAttribute('data-theme', theme)
            })
        }
    }
}
