'use strict';

let gulp = require('gulp'),
  concat = require('gulp-concat'),
  del = require('del'),
  livereload = require('gulp-livereload'),
  sass = require('gulp-sass'),
  uglify = require('gulp-uglify'),
  webpack = require('webpack-stream'),
  babel = require('gulp-babel');

gulp.task('sass', function() {
  return gulp.src('./app/scss/**/*.scss')
    .pipe(sass.sync().on('error', sass.logError))
    .pipe(gulp.dest('./dist/css'));
});




gulp.task('js', () =>
    gulp.src('app/js/app.js')
    .pipe(webpack({
      // entry: 'app/js/app.js',
      output: {
        filename: 'app.js'
      }
    }))
    // .pipe(babel({
    //   presets: ['env']
    // }))
    // .pipe(uglify())
    .pipe(gulp.dest('dist/js'))
);


gulp.task("watch", function() {
  livereload.listen();
  return gulp.watch(['app/scss/**/*', 'app/*/*', 'app/js/**/*.js'], ['build'])
})

gulp.task('clean', function() {
  del(['./dist'])
});

gulp.task("build", ['sass', 'js'], function() {
  return gulp.src(["scss/*", "js/*"], {
      base: './app/'
    })
    .pipe(gulp.dest('dist/'))
    .pipe(livereload());

});

gulp.task("default", ["watch"]);
