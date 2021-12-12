import gulp from 'gulp'

// Live reload
const browserSync = require('browser-sync').create()

// GULP UTILS
import path from 'path'
import del from 'del'
import plumber from 'gulp-plumber' // Prevent pipe breaking caused by errors from gulp plugins.
import sort from 'gulp-sort' // Recommended to prevent unnecessary changes in pot-file.

// JAVASCRIPT
import { terser } from 'rollup-plugin-terser' // Minifies JS files.
import { rollup } from 'rollup'
import babel from '@rollup/plugin-babel'
import rollupResolveNode from '@rollup/plugin-node-resolve'
import rollupResolveCommonjs from '@rollup/plugin-commonjs'

// CSS
import sourcemaps from 'gulp-sourcemaps' // Maps code in a compressed file (E.g. style.css) back to it’s original position in a source file (E.g. structure.scss, which was later combined with other css files to generate style.css).
import gulpSass from 'gulp-sass' // Gulp plugin for Sass compilation.
import sassCompiler from 'sass'
import autoprefixer from 'gulp-autoprefixer' // Autoprefixing magic.

// IMAGES
import imagemin from 'gulp-imagemin' // Minify PNG, JPEG, GIF and SVG images with imagemin.

// TRANSLATION
import wpPot from 'gulp-wp-pot' // For generating the .pot file.

// CONFIG
import config from './gulp.config'

const sass = gulpSass(sassCompiler)

// HELPER
let isProduction = false

const errorHandler = (error) => {
    console.error(error)
}

/**
 * Copies some other files (e.g. used for fonts, font-awesome icons,...) into the dist directory
 */
export const copyOtherFiles = (done) => {
    if (!config.otherFiles || config.otherFiles.length <= 0) {
        return done()
    }
    const parsedFiles = []

    /**
     * Parses an array of files to copy.
     * The files are often defined in an `assets.json` or `build.json` and can have the following formats.
     * The files configuration can be passed as string or object.
     * If it's a string this string/glob will be used as src and the function will try to build a base if it has wildcards. The destination will be null (should be set by gulp.dest)
     * If it's an object the origPath and path will be used for src and dest, base is optional and will not be built.
     * The returned array can be used to build multiple promises with Promise.all See the example gulpfile.
     * @see examples directory for example configurations.
     *
     * @param {Object[]|string[]} files Different file configs to parse. If string can be a glob to pass to gulp.
     * @param {string} files[].origPath The source path of the file to copy.
     * @param {string} [files[].base] The base path to use for gulp.src
     * @param {string} files[].path The destination path to copy the file too.
     * @returns {Object[]} Array of file objects to be used in a gulp task. Each Object has a src, base and dest property.
     */
    config.otherFiles.forEach((el) => {
        if (typeof el === 'object') {
            parsedFiles.push({
                src: el.origPath,
                base: el.base || null,
                dest: el.path
            })
        } else {
            let srcPath = el
            const wildcardPosition = el.indexOf('*')
            if (wildcardPosition) {
                srcPath = el.substring(0, wildcardPosition)
            }

            const baseDir = path.dirname(srcPath)
            parsedFiles.push({
                src: el,
                base: baseDir || null,
                dest: null
            })
        }
    })

    const tasks = []

    parsedFiles.forEach((fileSet) => {
        tasks.push(
            gulp
                .src(fileSet.src, { base: fileSet.base || null })
                .pipe(gulp.dest(fileSet.dest || config.dstDir))
        )
    })

    return Promise.all(tasks)
}

/**
 * Bundles, transpiles and minifies scripts and adds sourcemaps.
 */
export const scripts = () => {
    let paths = Array.isArray(config.scripts.entries) // ensure src is array
        ? config.scripts.entries
        : [config.scripts.entries]
    // prefix srcDir
    paths = paths.map((p) => {
        if (typeof p === 'string') {
            return { path: path.join(config.scripts.srcDir, p) }
        }

        const { path: entryPath, ...entryConfig } = p

        return {
            path: path.join(config.scripts.srcDir, entryPath),
            ...entryConfig
        }
    })

    const tasks = paths.map((entry) => {
        const { path: entryPath, ...entryConfig } = entry

        return rollup({
            input: entryPath,
            plugins: [
                rollupResolveNode(),
                rollupResolveCommonjs(),
                babel({
                    presets: config.scripts.babelPreset,
                    // exclude full node_modules -> only transpile own code; definately exclude /core-js/ to avoid circular references
                    exclude: [/node_modules/],
                    babelHelpers: 'bundled',
                    ...(entryConfig.babelConfig || {})
                })
            ],
            external: config.scripts.external,
            ...(entryConfig.rollupConfig || {})
        })
            .then((bundle) =>
                bundle.write({
                    dir: config.scripts.dstDir,
                    globals: config.scripts.globals,
                    intro: config.scripts.intro || '',
                    format: 'iife',
                    sourcemap: true,
                    plugins: isProduction ? [terser()] : []
                })
            )
            .catch((err) => {
                console.error(err.message)
            })
    })

    return Promise.all(tasks)
}

/**
 * Bundles, compiles and minifies stiles and adds sourcemaps.
 */
export const styles = () => {
    let paths = Array.isArray(config.styles.src) // ensure src is array
        ? config.styles.src
        : [config.styles.src]
    paths = paths.map((p) => path.join(config.styles.srcDir, p)) // prefix srcDir

    const outputStyle = isProduction ? 'compressed' : 'expanded'
    return gulp
        .src(paths, {
            base: config.styles.srcDir
        })
        .pipe(plumber(errorHandler))
        .pipe(sourcemaps.init())
        .pipe(
            sass
                .sync({ includePaths: ['node_modules'], outputStyle })
                .on('error', sass.logError)
        )
        .pipe(autoprefixer())
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(config.styles.dstDir))
        .pipe(browserSync.stream())
}

/**
 * Optimizes all images
 */
export const optimizeImages = () =>
    gulp
        .src(path.join(config.images.srcDir, '**/*'), {
            base: config.images.srcDir
        })
        .pipe(plumber(errorHandler))
        .pipe(
            imagemin([
                imagemin.gifsicle({ interlaced: true }),
                imagemin.mozjpeg({ progressive: true }),
                imagemin.optipng({ optimizationLevel: 3 }),
                imagemin.svgo({
                    plugins: [{ removeViewBox: true }, { cleanupIDs: false }]
                })
            ])
        )
        .pipe(gulp.dest(config.images.dstDir))

/**
 * Translates WordPress php files to pot files.
 */
export const translateWordPress = () => {
    let paths = Array.isArray(config.translate.src) // ensure src is array
        ? config.translate.src
        : [config.translate.src]
    paths = paths.map((p) => path.join(config.translate.srcDir, p)) // prefix srcDir
    return gulp
        .src(paths)
        .pipe(plumber(errorHandler))
        .pipe(sort())
        .pipe(wpPot())
        .pipe(
            gulp.dest(
                path.join(config.translate.dstDir, config.themeSlug + '.pot')
            )
        )
}

/**
 * Cleans the dist directory.
 */
export const clean = () =>
    del([`${config.dstDir}/**/*`, `!${config.dstDir}/.gitkeep`])

/**
 * Watches CSS, JS and image directories for changes and calls the respective task.
 */
const watch = () => {
    browserSync.init({
        proxy: config.server.proxy,
        port: config.server.port
    })

    gulp.watch(`${config.styles.srcDir}/**/*.scss`, styles)
    gulp.watch(`${config.scripts.srcDir}/**/*.js`, scripts)
    gulp.watch(`${config.images.srcDir}/**/*`, optimizeImages)
    gulp.watch('*/*.php').on('change', browserSync.reload)
}

/**
 * Build Task:
 * Sets isProduction to true to enable minify
 * Clean dist directory, copy other files (before everything else if src files depend on it)
 * and build scripts, styles, images and translations.
 */
export const build = (done) => {
    isProduction = true
    return gulp.series(
        clean,
        copyOtherFiles,
        gulp.parallel(scripts, styles, optimizeImages) // translateWordPress
    )(done)
}

/**
 * Develop Task: Call same tasks as in build task (but with isProduction not changed from default false) and watch for changes.
 */
export const develop = (done) =>
    gulp.series(
        clean,
        copyOtherFiles,
        gulp.parallel(scripts, styles, optimizeImages), // translateWordPress
        watch
    )(done)

/**
 * Export develop task as default.
 */
export default develop
