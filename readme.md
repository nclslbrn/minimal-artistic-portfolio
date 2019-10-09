# Minimal Artistic Portfolio theme
![Wordpress](https://img.shields.io/wordpress/v/akismet.svg)


A wordpress theme for artist (painter, sculptor, video-producer, ...) made with SASS, Babel, 
Webpack and more.
![theme screenshot Nicolas Lebrun logo](https://raw.githubusercontent.com/nclslbrn/Minimal-artist-portfolio/master/screenshot.png)


[Demo here](https://nicolas-lebrun.fr/) (It's not demo content but my own artistic works)


Note: Translation content function work with [qTranslateX](https://wordpress.org/plugins/qtranslate-x/) you can use another plugin static content is also translated (french/english) with a .po file.

## Features
### Project post
- They can have a cartel (technical information of the artwork)
- They can be linked to an event post
- They can have featured image and a video (currently Plyr library is used to display a player of a Vimeo or YouTube vimeo)
- Change searchbar submit text button by a magnifying glass icon (for regular user/non screen-reader)


### Events post
- They can have a begin and an end date
- They can have a location to display a map [Leafleft](https://github.com/Leaflet/Leaflet)
- They are ordered from newer to older on the events.php page template (grouped by year)


### Commons features
- They can have a gallery by adding thumbnail linked to full size image in post content with [Fluidbox](http://terrymun.github.io/Fluidbox/demo/index.html#content)
- They have share button (Facebook, Twitter and email)
- contact page template 
- two menus (header & footer), page can be nested in a dropdown in the header navigation bar, these two menus are responsive


## Changelog

### Ver.1.0.2
- Update Inter UI font 
- Change paragraph font from Inconsolata to [Fira Code](https://github.com/tonsky/FiraCode)
- Add video metabox on project post and [Plyr](https://github.com/sampotts/plyr) player on frontend

### Ver.1.0.1
- Change Google font Oxygen and Source sans mono to [Inter Ui](https://rsms.me/inter/) and [Inconsolata](https://fonts.google.com/specimen/Inconsolata0)
- Enhance typographic rythm with [Plumber-Sass](https://jamonserrano.github.io/plumber-sass/)
- Add a switch with dark/light mode

### Ver. 1.0.0
- Update grid with flexbox
- Load google font in functions.php
- Fix z-index bug on events list page between year timeline bullet and events link
- Fix z-index bug due to leafleft control and mobile navigation
- Fix heading overflow (changing scale from golden ration to major second)
- Change the behaviour of event thumbnail processing (no crop just resize)
- Add responsive rules on dev/sass/_1-typography.scss for headings

### Installation
- install with `npm install`
- update your change (SASS, PHP, image, fonts) with `npm run watch` and build it with `npm run build`


## Build with/thanks

<a href="https://github.com/WordPress/WordPress" style="text-decoration: none;">
<img src="https://raw.githubusercontent.com/WordPress/WordPress/master/wp-admin/images/wordpress-logo.png" alt="Wordpress" width="139">
</a>

<a href="https://github.com/webpack/webpack" style="text-decoration: none;">
<img src="https://camo.githubusercontent.com/d18f4a7a64244f703efcb322bf298dcb4ca38856/68747470733a2f2f7765627061636b2e6a732e6f72672f6173736574732f69636f6e2d7371756172652d6269672e737667" alt="Webpack" width="100">
</a>

<a href="https://github.com/cssnano/cssnano" style="text-decoration: none;">
<img src="https://camo.githubusercontent.com/d9f9a3bba9fdb5fba126be247ddb1228da667c64/68747470733a2f2f7261776769742e636f6d2f6373736e616e6f2f6373736e616e6f2f6d61737465722f6d656469612f6c6f676f2e737667" alt="CSSNano" width="139">
</a>

<a href="https://github.com/sass/sass" style="text-decoration: none;">
<img src="https://raw.githubusercontent.com/github/explore/80688e429a7d4ef2fca1e82350fe8e3517d3494d/topics/sass/sass.png" alt="Sass" width="100">
</a>

<a href="https://github.com/postcss/autoprefixer" style="text-decoration: none;">
<img src="https://camo.githubusercontent.com/f265315f74ed08b94e473cd7f6f04c291e59a8e2/687474703a2f2f706f73746373732e6769746875622e696f2f6175746f70726566697865722f6c6f676f2e737667" alt="Autoprefixer" width="100">
</a>

<a href="https://github.com/Browsersync/browser-sync" style="text-decoration: none;">
<img src="https://raw.githubusercontent.com/BrowserSync/browsersync.github.io/master/public/img/logo-gh.png" alt="browserSync" width="139">
</a>

<a href="https://github.com/npm/cli" style="text-decoration: none;">
<img src="https://raw.githubusercontent.com/npm/logos/master/npm%20square/n-large.png" alt="NPM" width="100">
</a>
