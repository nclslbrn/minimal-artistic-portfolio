var gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    cssnano = require('gulp-cssnano'),
    //jshint = require('gulp-jshint'),
    uglify = require('gulp-uglify'),
    imagemin = require('gulp-imagemin'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    notify = require('gulp-notify'),
    cache = require('gulp-cache'),
    livereload = require('gulp-livereload'),
    del = require('del'),
    watch = require('gulp-watch'),
    sourcemaps = require('gulp-sourcemaps'),
    ignore = require('gulp-ignore'),
    zip = require('gulp-zip'),
    browserSync = require('browser-sync').create();

gulp.task('styles', function() {
  return sass('dev/sass/**.scss', { style: 'expanded' })
    .pipe(sourcemaps.init())
    .pipe(autoprefixer('last 2 version'))
    .pipe(gulp.dest('prod/css'))
    .pipe(rename({suffix: '.min'}))
    .pipe(cssnano())
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('prod/css'))
    .pipe(livereload())
    .pipe(notify({ message: 'SASS processing minifying and complete' }));
});

gulp.task('scripts', function() {
  return gulp.src('dev/js/**/*.js')
    //.pipe(jshint('.jshintrc'))
    //.pipe(jshint.reporter('default'))
    //.pipe(concat('main.js'))
    .pipe(gulp.dest('prod/js'))
    .pipe(rename({suffix: '.min'}))
    .pipe(uglify())
    .pipe(gulp.dest('prod/js'))
    .pipe(livereload())
    .pipe(notify({ message: 'Scripts task complete' }));
});

gulp.task('images', function() {
  return gulp.src('dev/img/**/*')
    .pipe(imagemin({ optimizationLevel: 3, progressive: true, interlaced: true }))
    .pipe(gulp.dest('prod/img'))
    .pipe(livereload())
    .pipe(notify({ message: 'Images task complete' }));
});

gulp.task('watch', function () {
  gulp.watch('dev/sass/**/**.scss', ['styles']);
  gulp.watch('dev/js/*.js', ['scripts']);
  gulp.watch('dev/img/*.*', ['images']);
  gulp.watch('**/.DS_Store', ['remove']);
  gulp.watch('**/**.php');

  livereload.listen();
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
