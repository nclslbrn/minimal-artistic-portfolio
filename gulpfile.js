var gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    cleanCSS = require('gulp-clean-css'),
    uglify = require('gulp-uglify'),
    imagemin = require('gulp-imagemin'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    notify = require('gulp-notify'),
    cache = require('gulp-cache'),
    del = require('del'),
    watch = require('gulp-watch'),
    sourcemaps = require('gulp-sourcemaps'),
    ignore = require('gulp-ignore'),
    zip = require('gulp-zip'),
    browserSync = require('browser-sync'),
    reload = browserSync.reload;

var COMPATIBILITY = [
      'last 2 versions',
      'ie >= 9',
      'Android >= 2.3'
  ];
gulp.task('styles', function() {
  return sass('dev/sass/**.scss', { style: 'expanded' })
    .pipe(autoprefixer('last 2 version'))
    .pipe(gulp.dest('prod/css'))
    .pipe(rename({suffix: '.min'}))
    //.pipe(sourcemaps.init())
    .pipe(cleanCSS({compatibility: 'ie9'}))
    //.pipe(sourcemaps.write())
    .pipe(gulp.dest('prod/css'))
    .pipe(notify({ message: 'SASS processing minifying and complete' }));
});

gulp.task('scripts', function() {
  return gulp.src('dev/js/**/*.js')
    .pipe(gulp.dest('prod/js'))
    .pipe(rename({suffix: '.min'}))
    .pipe(uglify())
    .pipe(gulp.dest('prod/js'))
    .pipe(notify({ message: 'Scripts task complete' }));
});

gulp.task('images', function() {
  return gulp.src('dev/img/**/*')
    .pipe(imagemin({ optimizationLevel: 3, progressive: true, interlaced: true }))
    .pipe(gulp.dest('prod/img'))
    .pipe(notify({ message: 'Images task complete' }));
});
gulp.task('sync', function() {
    //watch files
    var files = [
    'prod/css/**.css',
    'prod/js/**.js',
    'prod/img/*.{png,jpg,gif}',
    '**/*.php'
    ];

    //initialize browsersync
    browserSync.init(files, {
    //browsersync with a php server
    proxy: "project.dev",
    //port: 8080,
    notify: true,
    injectChanges: true
    });
});

gulp.task('watch', ['sync'], function () {
  gulp.watch('dev/sass/**/**.scss', ['styles']);
  gulp.watch('dev/js/*.js', ['scripts']);
  gulp.watch('dev/img/*.*', ['images']);
  gulp.watch('**/.DS_Store', ['remove']);
  gulp.watch('**/**.php');

});


gulp.task('clean', function() {
  del(['prod/css', 'prod/js', 'prod/img'])
  notify({ message: 'Clean task complete' });
});

gulp.task('remove', function() {
  del('**/.DS_Store')
  notify({ message: 'Clean task complete' });
});

gulp.task('build', function() {

  gulp.src(['**/**','!node_modules/**','!dev/**','!**/.sass-cache','!**/.DS_Store'])
  	.pipe(zip('minimal-artistic-portfolio.zip'))
  	.pipe(gulp.dest('../'))
  	.pipe(notify({ message: 'Zip task complete', onLast: true }));

});
gulp.task('default',['watch']);
