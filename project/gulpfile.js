'use strict';

let gulp = require('gulp'),
  concat = require('gulp-concat'),
  del = require('del'),
  livereload = require('gulp-livereload'),
  sass = require('gulp-sass'),
  uglify = require('gulp-uglify'),
  webpack = require('webpack-stream'),
  babel = require('gulp-babel');
let glob = require('glob');

gulp.task('sass', function() {
  return gulp.src('./app/scss/**/*.scss')
    .pipe(sass.sync().on('error', sass.logError))
    .pipe(gulp.dest('./dist/css'));
});



function toObject(paths) {
  var ret = {};

  paths.forEach(function(path) {
    // you can define entry names mapped to [name] here
    ret[path.split('/').slice(-1)[0]] = path;
  });

  return ret;
}

gulp.task('js', () =>
  gulp.src('app/js/*.js')
  .pipe(webpack({
    // entry: 'app/js/app.js',
    // entry: './app/js/app.js',
    entry: toObject(glob.sync('./app/js/*.js')),
    output: {
      // path: path.resolve(__dirname, 'build'),
      filename: '[name]'
    },
    module: {
      loaders: [{
        test: /\.js$/,
        loader: 'babel-loader',
        query: {
          presets: ['env']
        }
      }]
    },
    stats: {
      colors: true
    },
    // devtool: 'source-map'

  }))
  // .pipe(babel({
  //   presets: ['env']
  // }))
  .pipe(uglify())
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
