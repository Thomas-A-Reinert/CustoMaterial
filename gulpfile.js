// Defining base pathes
var basePaths = {
    bower: './bower_components/'
};

// Defining requirements
var gulp = require('gulp');
var plumber = require('gulp-plumber');
var sass = require('gulp-sass');
var watch = require('gulp-watch');
var cssnano = require('gulp-cssnano');
var rename = require('gulp-rename');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var merge2 = require('merge2');
var ignore = require('gulp-ignore');
var rimraf = require('gulp-rimraf');
var sourcemaps = require('gulp-sourcemaps');
var livereload = require('gulp-livereload');
var autoprefixer = require('gulp-autoprefixer');
var jshint = require('gulp-jshint'); //validates js
//var concatCss = require('gulp-concat-css');
//var minifyCss = require('gulp-minify-css'); //minifies css

var autoprefixerOptions = {
  browsers: ['last 2 versions', '> 5%']
};

// Default task
// gulp.task('default', ['watch']);

// Run:
// gulp watch
// Starts watcher. Watcher runs gulp sass task on changes
// gulp.task('watch', function () {
//     livereload.listen();
//     gulp.watch('./sass/**/*.scss', ['sass']);
//     gulp.watch('./css/theme.css', ['cssnano']);
//     gulp.watch('./css/**/*').on('change', livereload.changed);
//     gulp.watch('./**/*.php').on('change', livereload.changed);
// });

// Run:
// gulp sass
// Compiles SCSS files in CSS
// gulp.task('sass', function () {
//     return gulp.src('./sass/*.scss')
//         .pipe(plumber())
//         .pipe(sourcemaps.init())
//         .pipe(sass().on('error', sass.logError))
//         .pipe(sourcemaps.write())
//         //.pipe(autoprefixer(autoprefixerOptions))
//         .pipe(gulp.dest('./css/uncompressed'));
// });
var SCSS_SRC = ['./sass/*.scss'];
gulp.task('scss', function() {
  gulp.src(SCSS_SRC)                          //reads all the SASS files
    .pipe(plumber())
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))  //compiles SASS to CSS and logs errors
    .pipe(sourcemaps.write())
    .pipe(rename({
            basename: 'theme',
            extname: '.css'
        }))
    .pipe(gulp.dest('./css/uncompressed')); //writes the renamed file to the destination
});

var BS_SCSS_SRC = ['./sass/bootstrap-sass/*.scss'];
gulp.task('bs-scss', function() {
  return gulp.src(BS_SCSS_SRC)                          //reads all the SASS files
    .pipe(plumber())
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))  //compiles SASS to CSS and logs errors
    .pipe(sourcemaps.write())
    .pipe(rename({
            basename: 'bootstrap',
            extname: '.css'
        }))
    .pipe(gulp.dest('./css/uncompressed')); //writes the renamed file to the destination
});

//var UNCOMPRESSED_CSS_SRC = ['./css/uncompressed/*.css'];
gulp.task('catify', function() { // concat and minify
    gulp.src([
        './css/uncompressed/bootstrap.css',
        './css/uncompressed/bootstrap-material-design.css',
        //'./css/uncompressed/bootstrap.lightbox.css',
        './css/uncompressed/ripples.css',
        './css/uncompressed/theme.css',
        //'./css/uncompressed/theme.css'
    ])
        .pipe(ignore('*.min.css'))
        .pipe(cssnano({discardComments: {removeAll: true}}))
        .pipe(concat('theme_minified.css'))
        .pipe(rename({
            basename: 'theme',
            extname: '.min.css'
        }))
        .pipe(gulp.dest('./css'));
});

var UNCOMPRESSED_JS_SRC = "./js/uncompressed/*.js";
// gulp.task('js', function() {
//   gulp.src(UNCOMPRESSED_JS_SRC)
//     .pipe(ignore('*.min.js'))
//     .pipe(ignore('*bootstrap*'))
//     .pipe(ignore('*jquery*'))
//     .pipe(ignore('*owl*'))
//     // .pipe(jshint())                           //validates the js files
//     // .pipe(jshint.reporter('jshint-stylish'))  //prints the error to the user on the console
//     .pipe(concat('theme.js'))                  //concatenates the js files into one main.js file
//     .pipe(uglify())                           //minifies the js files
//     .pipe(rename({                            //renames the main.js file
//         basename : 'theme',                    //the base name of the renamed file
//         extname: '.min.js'                    //the extension of the renamed file
//     }))
//     .pipe(gulp.dest('./js'));             //the destination folder where the files have be written to
// });

gulp.task('js', function() {
  gulp.src([
        './js/uncompressed/navigation.js',
        './js/uncompressed/skip-link-focus-fix.js',
        './js/uncompressed/material.js',
        //'./js/uncompressed/bootstrap.lightbox.js',
        './js/uncompressed/ripples.js',
        './js/uncompressed/navgoco.js',
    ])
    // .pipe(ignore('*.min.js'))
    // .pipe(ignore('*bootstrap*'))
    // .pipe(ignore('*jquery*'))
    // .pipe(ignore('*owl*'))
    // .pipe(jshint())                           //validates the js files
    // .pipe(jshint.reporter('jshint-stylish'))  //prints the error to the user on the console
    .pipe(concat('theme.js'))                  //concatenates the js files into one main.js file
    .pipe(uglify())                           //minifies the js files
    .pipe(rename({                            //renames the main.js file
        basename : 'theme',                    //the base name of the renamed file
        extname: '.min.js'                    //the extension of the renamed file
    }))
    .pipe(gulp.dest('./js'));             //the destination folder where the files have be written to
});


// Run:
// gulp nanocss
// Minifies CSS files
// http://cssnano.co/options/
gulp.task('cssnano', ['cleancss'], function(){
  return gulp.src('./css/uncompressed/*.css')
    .pipe(ignore('*.min.css'))
    .pipe(plumber())
    .pipe(sourcemaps.init())
    .pipe(rename({suffix: '.min'}))
    .pipe(cssnano({discardComments: {removeAll: true}}))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('./css/'))
    .pipe(livereload());
});

gulp.task('concatcss', function () {
  return gulp.src('./css/*.css')
    .pipe(ignore('*owl*.css'))
    .pipe(concatCss("./css/packaged.css"))
    .pipe(gulp.dest('./'));
});

gulp.task('cleancss', function() {
  return gulp.src('./css/*.min.css', { read: false }) // much faster
    .pipe(ignore('theme.css'))
    .pipe(rimraf());
});

gulp.task('merge-js', function () {
  return merge2(
      gulp.src([
        //'./js/uncompressed/bootstrap.js', // embedded as standalone script
        './js/uncompressed/navigation.js',
        './js/uncompressed/skip-link-focus-fix.js',
        './js/uncompressed/material.js',
        './js/uncompressed/ripples.js',
        './js/uncompressed/jquery.navgoco.js',
        // './js/uncompressed/init.js'
      ])
    )
    .pipe(concat('theme.js'))
    .pipe(gulp.dest('./js/uncompressed/'));
});

gulp.task('uglify-js', function () {
  return gulp.src('js/uncompressed/theme.js')
    .pipe(plumber())
    .pipe(rename({suffix: '.min'}))
    .pipe(uglify())
    .pipe(gulp.dest('js'));
});

// Run:
// gulp copy-assets.
// Copy all needed dependency assets files from bower_component assets to themes /js, /scss and /fonts folder. Run this task after bower install or bower update

gulp.task('copy-assets', function() {

    // Copy all Bootstrap SCSS files
    gulp.src(basePaths.bower + 'bootstrap-sass/assets/stylesheets/**/*')
       .pipe(gulp.dest('./sass/bootstrap-sass'));

    // Copy all Understrap SCSS files
    gulp.src(basePaths.bower + '_s/sass/**/*')
       .pipe(gulp.dest('./sass/_s/sass'));

    gulp.src(basePaths.bower + 'bootstrap-sass/assets/javascripts/**/*.js')
       .pipe(gulp.dest('./js/uncompressed'));

// Copy all Material Design CSS files
    gulp.src(basePaths.bower + 'bootstrap-material-design/dist/css/*.css')
      .pipe(gulp.dest('./css/uncompressed'));

// Copy all Material Design JS files
    gulp.src(basePaths.bower + 'bootstrap-material-design/dist/js/*.js')
      .pipe(gulp.dest('./js/uncompressed'));

// Copy all Bootstrap Fonts
    gulp.src(basePaths.bower + 'bootstrap-sass/assets/fonts/bootstrap/*.{ttf,woff,woff2,eof,svg}')
        .pipe(gulp.dest('./fonts'));

// Copy all Font Awesome Fonts
    gulp.src(basePaths.bower + 'fontawesome/fonts/**/*.{ttf,woff,woff2,eof,svg}')
        .pipe(gulp.dest('./fonts'));

// Copy all Font Awesome SCSS files
    gulp.src(basePaths.bower + 'fontawesome/scss/*.scss')
        .pipe(gulp.dest('./sass/fontawesome'));

// Copy jQuery
    gulp.src(basePaths.bower + 'jquery/dist/*.js')
        .pipe(gulp.dest('./js/uncompressed'));

// _s JS files
    gulp.src(basePaths.bower + '_s/js/*.js')
        .pipe(gulp.dest('./js/uncompressed'));

// Copy all Owl2 JS files
    gulp.src(basePaths.bower + 'OwlCarousel2/dist/*.js')
        .pipe(gulp.dest('./js/uncompressed'));

// Copy all Owl2 SCSS files
    gulp.src(basePaths.bower + 'OwlCarousel2/dist/assets/*.css')
       .pipe(gulp.dest('./css/uncompressed'));

// Copy kirki
    gulp.src(basePaths.bower + 'kirki/**/*')
        .pipe(gulp.dest('./inc/kirki'));

// Copy CMB2
    gulp.src(basePaths.bower + 'CMB2/**/*')
        .pipe(gulp.dest('./inc/CMB2'));
});
