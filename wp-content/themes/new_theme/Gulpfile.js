var gulp = require('gulp');
var sass = require('gulp-sass');
var jshint = require('gulp-jshint');
var sourcemaps = require('gulp-sourcemaps');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var plugins = require('gulp-load-plugins')();

gulp.task('sass', function() {
  gulp.src('./development/sass/style.sass')
      .pipe(plugins.sass())
      .pipe(plugins.autoprefixer())
      .pipe(plugins.csso())
      .pipe(plugins.rename({
        suffix: '.min'
      }))
      .pipe(gulp.dest('./'))
});

gulp.task('jshint', function() {
  return gulp.src('./development/js/init.js')
    .pipe(jshint())
    .pipe(jshint.reporter('jshint-stylish'));
});

gulp.task('build-js', function() {
  gulp.src(['./development/js/init.js', './development/js/global/*.js'])
    .pipe(concat('bundle.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./'))
});


gulp.task('watch', function () {
    gulp.watch('./development/sass/**/*.sass', ['sass'] );
    gulp.watch('./development/js/**/*.js', ['jshint']);
    gulp.watch('./development/js/**/*.js', ['build-js']);
});


// define task default
gulp.task('default', ['watch']);

// configure the jshint task
