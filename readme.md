# Minimal Artistic Portfolio theme

![Wordpress](https://img.shields.io/wordpress/v/akismet.svg)

A wordpress theme for artist (painter, sculptor, video-producer, ...) made with SASS, Babel,
Webpack and more.

[Demo here](https://nicolas-lebrun.fr/) (It's not demo content but my own artistic works)

1st Note: Translation content function work with [qTranslateX](https://wordpress.org/plugins/qtranslate-x/) you can use another plugin, static contents are translated (english/french) with a .po file.
2nd Note: Currently Gutenbeg blocks are not supported but if your site use only one language, it should work.

## Features

### Project post

-   They can have a cartel (technical information of the artwork)
-   They can be linked to an event post
-   They can have featured image and a video (currently Plyr library is used to display a player of a Vimeo or YouTube video)

### Events post

-   They can have a begin and an end date
-   They can have a location to display a map [Leafleft](https://github.com/Leaflet/Leaflet)
-   They are ordered from newer to older on the events.php page template (grouped by year)

### GIFs post

-   A simple image post to build a single gallery page.
-   Grid gallery show thumbnail but also embed a hidden image to be preloaded,
    this tricks should make GIF playing more smooth but could be also usefull with large image.

### Commons features

-   Projects and events can have galleries, you just have to add thumbnail linked to full size image into post content, the editor will detect it and add `fluidbox` class.
-   They have share button (Facebook, Twitter and email)
-   contact page template (admin email is used to recieve email, there is no option to change it)
-   two menus (header & footer), page can be nested in a dropdown in the header navigation bar, these two menus are responsive


## Changelog

### Ver.1.0.5
- Project and event are now editable with Gtutenberg (WordPress Block)
- Add a lightbox for .wp-block-gallery and a.fluidbox with [BaguetteBox](https://github.com/feimosi/baguetteBox.js)
- Add an alternate style to gallery block, tiled, to compose irregular grid of picture
- Add three styles, column 1, 2, 3 to image block for image sizing within or without tiled image gallery
- Borders are back

### Ver.1.0.4
- Refactoring with phpcs and wp-coding-standarts (composer dependency)
- Move top sidebar to bottom (before footer)
- Move color variables (relative to light and dark modes) from Sass to CSS variable
- Change front bundler from Webpack to Gulp
- Loops optimization (with pagination)
- Complete CSS rewrite from [_s theme](https://github.com/automattic/_s) Sass folders and files structure
- Create a widget for dark mode with an option for switching from differents UI elements

### Ver.1.0.3

Added a simple image post called gif (but could be used with static picture), with a posts grid template page.

### Ver.1.0.2

-   Update workflow from [Gulp](https://gulpjs.com/) to [Webpack](https://webpack.js.org/)
-   Update Inter UI font
-   Change paragraph font from Inconsolata to [Fira Code](https://github.com/tonsky/FiraCode)
-   Add video metabox on project post and [Plyr](https://github.com/sampotts/plyr) player on frontend
-   Change searchbar submit text button by a magnifying glass icon (for regular user/non screen-reader)

### Ver.1.0.1

-   Change Google font Oxygen and Source sans mono to [Inter Ui](https://rsms.me/inter/) and [Inconsolata](https://fonts.google.com/specimen/Inconsolata0)
-   Enhance typographic rythm with [Plumber-Sass](https://jamonserrano.github.io/plumber-sass/)
-   Add a switch with dark/light mode

### Ver. 1.0.0

-   Update grid with flexbox
-   Load google font in functions.php
-   Fix z-index bug on events list page between year timeline bullet and events link
-   Fix z-index bug due to leafleft control and mobile navigation
-   Fix heading overflow (changing scale from golden ration to major second)
-   Change the behaviour of event thumbnail processing (no crop just resize)
-   Add responsive rules on dev/sass/\_1-typography.scss for headings

### Installation

-   install with `npm install` or `yarn`
-   update your change (SASS, PHP, image, fonts) with `npm run dev`/`yarn dev` and build it with `npm run build`/`yarn build`

