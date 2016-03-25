// // If you want to quickstart with GULP.js :
// http://emilrosenius.com/getting-started-with-gulp-js/
// http://ilikekillnerds.com/2014/07/how-to-basic-tasks-in-gulp-js/
//
//
// Some of the code below was adapted from https://knpuniversity.com/search?q=gulp
//
// // Included Tasks:
//
// 'gulp images'	- compresses and copies all images from _dev/imgs to assets/imgs
// 'gulp styles'    - compiles scss to css, concatenates and minifies all files from given input-Pipeline in given order to assets/css and generates sourcemaps
// 'gulp scripts'   - concatenates and uglifies all files from given input-Pipeline in given order to assets/js and generates sourcemaps
// 'gulp watch'		- runs gulp images, gulp styles, gulp scripts and watches for changes in those folder plus any changes on PHP-files. Triggers LiveReload.
//  Download LiveReload Plugin for Chrome here: https://chrome.google.com/webstore/detail/livereload/jnihajbhpnppcggbcgedagnkighmdlei
//
//
//  Gulp project prerequisites
//  Your directory structure should look like this:
//
//  root
//  | - _dev    (This is where all your development files will go in and from where we´re going to build the built-files)
//              (The 'gulp bowerUpdate' task will copy files to the _dev subdirectories)
//        | - css
//        | - imgs
//        | - js
//        | - sass (Includes all SCSS files, including understraps SCSS files)
//  | - assets (This is where you´re production files will be automatically generated)
//        | - css
//        | - js
//        | - imgs
//
//  NOTE: You don´t have to generate the "assets"-directory and it´s subdirs. They SHOULD be generated automatically.
//  IMPORTANT: Once you´ll do a 'bower update' and run 'gulp bowerUpdate' your files in _dev-Directory may get overwritten. Take neccessary precautions BEFORE running that task!
//
//
//  Gulp dependencies installation:
//  $npm install --save bower gulp-load-plugins del q gulp-util gulp-plumber gulp-sass gulp-sourcemaps gulp-size gulp-concat gulp-ignore gulp-uglify gulp-rename gulp-cache gulp-autoprefixer gulp-imagemin gulp-livereload

var gulp = require('gulp');
var plugins = require('gulp-load-plugins')(); // Probably the smartest way of accessing gulp plugins via package.json
var del = require('del');
var Q = require('q');
var config = {
    devDir: '_dev',      // Import Dir
    exportDir: 'assets',    // Export Dir
    sassPattern: 'sass/**/*.scss',
    production: !!plugins.util.env.production,
    sourceMaps: !plugins.util.env.production,
    bowerDir: 'bower_components',
};

var app = {};
app.addStyle = function(paths, outputFilename) {
    return gulp.src(paths)
        .pipe(plugins.plumber())
        //.pipe(plugins.if(config.sourceMaps, plugins.sourcemaps.init()))
        .pipe(plugins.sass())
        .pipe(plugins.autoprefixer('last 2 versions'))
        .pipe(plugins.concat(config.exportDir + '/css/' + outputFilename))
        .pipe(plugins.minifyCss())
        //.pipe(plugins.if(config.sourceMaps, plugins.sourcemaps.write('.' )))
        .pipe(gulp.dest('.' )).on('end',function() {
            plugins.util.log('Compressed CSS ready with:')
        })
		.pipe(plugins.size())
};

app.addScript = function(paths, outputFilename) {
    return gulp.src(paths)
        .pipe(plugins.plumber())
        .pipe(plugins.if(config.sourceMaps, plugins.sourcemaps.init()))
        .pipe(plugins.concat(outputFilename))
        .pipe(plugins.if(config.sourceMaps, plugins.sourcemaps.write('.')))
        .pipe(gulp.dest(config.exportDir + '/js/uncompressed')).on('end',function() {
            plugins.util.log('Uncompressed JS ready with:')
        })
        .pipe(plugins.size())
        // Now that we got the concatenated version, let´s create th euglyfied version
        .pipe(plugins.ignore.exclude('*.js.map'))
        .pipe(plugins.uglify()).on('end',function() {
            plugins.util.log('Compressed JS ready with:')
        })
        .pipe(plugins.rename({
            basename: 'theme',                          // base name of the renamed file
            extname: '.min.js'                          // extension of the renamed file
          }))
        .pipe(plugins.size())
        .pipe(gulp.dest(config.exportDir + '/js'))
};

app.copy = function(srcFiles, outputDir) {
    gulp.src(srcFiles)
        .pipe(gulp.dest(outputDir));
};

// Add Pipelining..
var Pipeline = function() {
    this.entries = [];
};
Pipeline.prototype.add = function() {
    this.entries.push(arguments);
};
Pipeline.prototype.run = function(callable) {
    var deferred = Q.defer();
    var i = 0;
    var entries = this.entries;
    var runNextEntry = function() {
        // see if we're all done looping
        if (typeof entries[i] === 'undefined') {
            deferred.resolve();
            return;
        }
        // pass app as this, though we should avoid using "this"
        // in those functions anyways
        callable.apply(app, entries[i]).on('end', function() {
            i++;
            runNextEntry();
        });
    };
    runNextEntry();
    return deferred.promise;
};


// Start tasks..
//
// 'gulp styles'
gulp.task('styles', function() {
    var pipeline = new Pipeline();
    pipeline.add([
        config.devDir + '/sass/bootstrap-sass/bootstrap.scss',
        //config.devDir + '/sass/theme.scss', // Add more in the correct order to be processed if needed.
        config.devDir + '/css/bootstrap-material-design.css',
        config.devDir + '/css/font-awesome.css',
        config.devDir + '/css/ripples.css',
        config.devDir + '/sass/theme.scss'
    ], 'theme.min.css');
    pipeline.run(app.addStyle);
});

// 'gulp scripts'
gulp.task('scripts', function() {
    var pipeline = new Pipeline();
    pipeline.add([
        config.devDir + '/js/navigation.js',
        config.devDir + '/js/skip-link-focus-fix.js',
        config.devDir + '/js/material.js',
        // config.devDir + '/js/bootstrap.lightbox.js', // Add more in the correct order to be processed if needed.
        config.devDir + '/js/ripples.js',
        config.devDir + '/js/navgoco.js',
        config.devDir + '/js/theme.js'
    ], 'theme.js');
    pipeline.run(app.addScript);
});

// 'gulp images'
gulp.task('images', function() {
    return gulp.src([config.devDir + '/imgs/*.jpg', config.devDir + '/imgs/*.png', config.devDir + '/imgs/*.gif'])
        //.pipe(plugins.ignore.exclude('*.js.map'))
        .pipe(plugins.cache(plugins.imagemin({
            optimizationLevel: 5,
            progressive: true,
            interlaced: true,
            multipass: true
        })))
        .pipe(gulp.dest(config.exportDir + '/imgs/')).on('end',function() {
            plugins.util.log('All images processed with:')
        })
        .pipe(plugins.size())
});

// 'gulp fonts'
gulp.task('fonts', function() {  // You´ll probably never ever gonna need to run that manually.
    app.copy(
        config.bowerDir+'/fontawesome/fonts/*',
        'fonts'
    );
    app.copy(
        config.bowerDir+'/bootstrap/fonts/*',
        'fonts'
    );
});

// 'gulp bowerUpdate'
// Copies all needed dependency assets from bower_component assets to themes _dev/js, _dev/scss and _dev/fonts folders. Run this task after bower install or bower update.
// NOTICE: Handle with care, it MAY overwrite your existing customized files! That being said: It does not overwrite your understrap files.

gulp.task('bowerUpdate', function () {

    // Copy all Bootstrap SCSS files
    gulp.src(bowerDir + 'bootstrap-sass/assets/stylesheets/**/*')
        .pipe(gulp.dest('./sass/bootstrap-sass'));

    // Copy all Understrap SCSS files
    gulp.src(bowerDir + '_s/sass/**/*')
        .pipe(gulp.dest('./sass/_s/sass'));

    gulp.src(bowerDir + 'bootstrap-sass/assets/javascripts/**/*.js')
        .pipe(gulp.dest('./_dev/js/uncompressed'));

// Copy all Material Design CSS files
    gulp.src(bowerDir + 'bootstrap-material-design/dist/css/*.css') // You´ll probably not gonna need this. More info on Bootstrap Material Design: http://fezvrasta.github.io/bootstrap-material-design/
        .pipe(gulp.dest('./_dev/css/uncompressed'));

// Copy all Material Design JS files
    gulp.src(bowerDir + 'bootstrap-material-design/dist/js/*.js')
        .pipe(gulp.dest('./_dev/js/uncompressed'));

// Copy all Bootstrap Fonts
    gulp.src(bowerDir + 'bootstrap-sass/assets/fonts/bootstrap/*.{ttf,woff,woff2,eof,svg}')
        .pipe(gulp.dest('./assets/fonts'));

// Copy all Font Awesome Fonts
    gulp.src(bowerDir + 'fontawesome/fonts/**/*.{ttf,woff,woff2,eof,svg}')
        .pipe(gulp.dest('./assets/fonts'));

// Copy all Font Awesome SCSS files
    gulp.src(bowerDir + 'fontawesome/scss/*.scss')
        .pipe(gulp.dest('./_dev/sass/fontawesome'));

// Copy jQuery
    gulp.src(bowerDir + 'jquery/dist/*.js')
        .pipe(gulp.dest('./_dev/js/uncompressed'));

// _s JS files
    gulp.src(bowerDir + '_s/js/*.js')
        .pipe(gulp.dest('./_dev/js/uncompressed'));

// Copy all Owl2 JS files
    gulp.src(bowerDir + 'OwlCarousel2/dist/*.js')
        .pipe(gulp.dest('./_dev/js/uncompressed'));

// Copy all Owl2 SCSS files
    gulp.src(bowerDir + 'OwlCarousel2/dist/assets/*.css')
        .pipe(gulp.dest('./_dev/css/uncompressed'));

// Copy kirki
    gulp.src(bowerDir + 'kirki/**/*') // You´ll probably not gonna need this. More info on Kirki-customizer Framework: https://kirki.org/
        .pipe(gulp.dest('./inc/kirki'));

// Copy CMB2
    gulp.src(bowerDir + 'CMB2/**/*')  // You´ll probably not gonna need this. More info on CMB2 Framework: https://github.com/WebDevStudios/CMB2
        .pipe(gulp.dest('./inc/CMB2'));
});

// 'gulp clean'
gulp.task('clean', function() {
    del.sync('assets/css/*');
    del.sync('assets/js/*');
    del.sync('assets/fonts/*');
});

// 'gulp watch'  - checks for any changes in scss files in "_dev" and runs 'gulp styles' thereafter. Same goes for js files.
gulp.task('watch', function() {
    plugins.livereload.listen();
    gulp.watch(config.devDir + '/' + config.sassPattern, ['styles']);
    gulp.watch(config.devDir + '/js/**/*.js', ['scripts']);
    gulp.watch(config.exportDir + '/js/*.js').on('change', plugins.livereload.changed);
    gulp.watch(config.exportDir + '/css/*.css').on('change', plugins.livereload.changed);
    gulp.watch('**/*.php').on('change', plugins.livereload.changed);
    gulp.watch(config.devDir + '/imgs/**/*', ['images']);
});

// 'gulp' runs most important tasks.
gulp.task('default', [
    //'clean',
    'styles',
    'scripts',
    'fonts',
    'images',
    'watch']);
