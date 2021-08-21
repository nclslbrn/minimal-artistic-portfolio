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
    updateAll(theme == 'dark')
}

const switchTheme = (e) => {
    let mode = false

    if (e && e.currentTarget && 'undefined' !== e.currentTarget.checked)
        mode = e.currentTarget.checked ? 'dark' : 'light' // hidden input[type="checkbox"][name="mode-switcher"] switch
    if (e && e.currentTarget && 'undefined' !== e.currentTarget.value)
        mode = e.currentTarget.value // select|input[name="mode-switcher"] menu & buttons

    if (mode) {
        localStorage.setItem('theme', mode)
        document.documentElement.setAttribute('data-theme', mode)
        updateAll(mode === 'dark')
    }
}

const updateCheckBox = (isDark) => {
    for (let i = 0; i < modeSwitches.length; i++) {
        modeSwitches[i].checked = isDark
        modeSwitches[i].value = isDark ? 'light' : 'dark'
    }
}
const updateLabel = (isDark) => {
    const themeLabels = document.querySelectorAll(
        '[data-current-theme] svg use'
    )
    if (themeLabels) {
        themeLabels.forEach((icon) => {
            if (isDark) {
                icon.setAttribute('xlink:href', '#icon-moon')
            } else {
                icon.setAttribute('xlink:href', '#icon-sun')
            }
        })
    }
}

const updateSelect = (isDark) => {
    const modeOptionOrder = {
        light: 0,
        dark: 1
    }
    const themeSelect = document.querySelectorAll('select[name="mode-switcher"')
    themeSelect.forEach((select) => {
        if (isDark) {
            select.selectedIndex = modeOptionOrder.dark
        } else {
            select.selectedIndex = modeOptionOrder.light
        }
    })
}

const updateAll = (isDark) => {
    updateCheckBox(isDark)
    updateLabel(isDark)
    updateSelect(isDark)
}
const modeSwitches = document.querySelectorAll('[name="mode-switcher"]')
const modeButtons = document.querySelectorAll('.theme-mode-button')

detectColorScheme()

if ('undefined' !== typeof modeSwitches) {
    for (let i = 0; i < modeSwitches.length; i++) {
        modeSwitches[i].addEventListener('change', switchTheme, false)
        if ('dark' === document.documentElement.dataset.theme) {
            modeSwitches[i].checked = true
        }
        switchTheme()
    }
}

if ('undefined' !== typeof modeButtons) {
    for (let i = 0; i < modeButtons.length; i++) {
        const theme = modeButtons[i].value
        if (null !== theme) {
            modeButtons[i].addEventListener('click', switchTheme, false)
        }
        switchTheme()
    }
}
