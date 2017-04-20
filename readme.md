# Minimal Artistic Portfolio theme
![Wordpress](https://img.shields.io/wordpress/v/akismet.svg)
![GPL](https://img.shields.io/aur/license/yaourt.svg)
![Status](https://img.shields.io/pypi/status/Django.svg)
![Dependencies](https://img.shields.io/versioneye/d/ruby/rails.svg)


A wordpress theme for artist (painter, sculptor, video-producer, ...) made with SASS (CSS preprocessor) & Gulp (Javascript task runner)


![theme screenshot Nicolas Lebrun logo](https://raw.githubusercontent.com/nclslbrn/Minimal-artist-portfolio/master/screenshot.png)


[Demo here](https://nicolas-lebrun.fr/) (It's not fake content but my own site to show my artistic works)


Note: Translation content function work with [qTranslateX](https://wordpress.org/plugins/qtranslate-x/) but static content is also translated (french/english) with a .po file

### Features
- project post type with new medium field (stored as `cartel` in post_meta) and events links
- event post type with begin and end date field and longitude/latitude to bring [Leafleft](https://github.com/Leaflet/Leaflet) maps on single event template
- event list as chronological, from newer to older, grouped by year
- contact page
- two menus (header & footer), page can be nested in a dropdown in the header navigation bar, these two menus are responsive
- image thumbnail in post content can be opened in full size on a modal with [zoom.js](https://github.com/fat/zoom.js)


### Changelog
- Update grid with flexbox
- Load google font in functions.php
- Fix z-index bug on events list page between year timeline bullet and events link
- Fix z-index bug due to leafleft control and mobile navigation
- Fix heading overflow (changing scale from golden ration to major second)
- Change the behaviour of event thumbnail processing (no crop just resize)
- Add responsive rules on dev/sass/_1-typography.scss for headings

### Installation
- install with `npm install`
- update your change (SASS, PHP, image, fonts) with `gulp watch`
