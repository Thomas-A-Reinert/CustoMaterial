// Included Tasks:
//
// 'gulp imagemin' - Minifies all files in 'images.src' to 'images.dest'
// 'gulp-size' - https://github.com/sindresorhus/gulp-size
// 'gulp-sass' - https://github.com/dlmanning/gulp-sass , https://github.com/sass/node-sass#options
// https://knpuniversity.com/screencast/gulp/on-end-async-and-listeners


var basePaths = {
	src: '_dev/',
	dest: 'assets/',
	bower: 'bower_components/'
};
var paths = {
	images: {
		src: basePaths.src + '/imgs/*.jpg',
		dest: basePaths.dest + 'imgs/'
	},
	scripts: {
		src: basePaths.src + 'js/',
		dest: basePaths.dest + 'js/'
	},
	styles: {
		src: basePaths.src + 'sass/',
		dest: basePaths.dest + 'css/'
	},
	bootstrap: {
		src: basePaths.src + 'sass/bootstrap-sass/bootstrap.scss',
		dest: basePaths.dest + 'css/'
	},
	material: {
		src: basePaths.src + 'sass/material-sass/*.scss',
		dest: basePaths.dest + 'css/'
	},
	theme: { // Bundles understrap and theme styles
		src: basePaths.src + 'sass/material-sass/*.scss',
		dest: basePaths.dest + 'css/'
	}
};

// var bootstrap_Files = {
// 	styles: paths.styles.src + 'bootstrap-sass/**/*.scss',
// 	scripts: paths.scripts.src + 'scripts.js'
// };

// var vendorFiles = {
// 	styles: '',
// 	scripts: ''
// };

/*
	Let the magic begin
*/

var gulp = require('gulp');

var es = require('event-stream');
var gutil = require('gulp-util');

var plugins = require("gulp-load-plugins")({
	pattern: ['gulp-*', 'gulp.*'],
	replaceString: /\bgulp[\-.]/
});

// Allows gulp --dev to be run for a more verbose output
var isProduction = true;
var sassStyle = 'compressed';
var sourceMap = false;

if(gutil.env.dev === true) {
	sassStyle = 'expanded';
	sourceMap = true;
	isProduction = false;
}

// var changeEvent = function(evt) {
// 	gutil.log('File', gutil.colors.cyan(evt.path.replace(new RegExp('/.*(?=/' + basePaths.src + ')/'), '')), 'was', gutil.colors.magenta(evt.type));
// };


//
// Compress Images
//
gulp.task('imagemin', function() {
    // gulp.src(paths.images.src)
   		var s = plugins.size()
        .pipe(plugins.cache(plugins.imagemin({
            optimizationLevel: 5,
            progressive: true,
            interlaced: true,
            multipass: true
        })))

        .pipe(gulp.dest(paths.images.dest))
});



gulp.task('css', function(){

	var bootstrap_Files = gulp.src(paths.bootstrap.src)
		.pipe(plugins.sass({
			precision: 2
		}))
		.pipe(plugins.sass().on('error', plugins.sass.logError))  //compiles SASS to CSS and logs errors
		.on('error', function(err){
			new gutil.PluginError('CSS', err, {showStack: true})


		.pipe(gulp.dest(paths.styles.dest))
		.pipe(plugins.size()) // Why the hell does this NOT work?
	});

	// var bootstrap_Files = gulp.src(paths.styles.src+'theme.scss')
	// 	.pipe(plugins.sass({
	// 		style: sassStyle, sourceMapEmbed: true, precision: 2
	// 	}))
	// 	.pipe(plugins.sass().on('error', plugins.sass.logError))  //compiles SASS to CSS and logs errors
	// 	.on('error', function(err){
	// 		new gutil.PluginError('CSS', err, {showStack: true});
	// 	});
	// .pipe (gutil(bootstrap_Files))



	// return es.concat(gulp.src(paths.material.src), bootstrap_Files)
	// 	.pipe(plugins.concat('theme.min.css'))
	// 	.pipe(plugins.autoprefixer('last 2 version','ie 9'))
	// 	.pipe(isProduction ? plugins.combineMediaQueries({
	// 		log: true
	// 	}) : gutil.noop())
	// 	.pipe(isProduction ? plugins.cssmin() : gutil.noop())
	// 	.pipe(plugins.size())
	// 	.pipe(gulp.dest(paths.styles.dest));
});

gulp.task('scripts', function(){

	gulp.src(vendorFiles.scripts.concat(appFiles.scripts))
		.pipe(plugins.concat('app.js'))
		.pipe(isProduction ? plugins.uglify() : gutil.noop())
		.pipe(plugins.size())
		.pipe(gulp.dest(paths.scripts.dest));

});


gulp.task('watch', ['css', 'scripts'], function(){
	gulp.watch(appFiles.styles, ['css']).on('change', function(evt) {
		changeEvent(evt);
	});
	gulp.watch(paths.scripts.src + '*.js', ['scripts']).on('change', function(evt) {
		changeEvent(evt);
	});
	gulp.watch(paths.sprite.src, ['sprite']).on('change', function(evt) {
		changeEvent(evt);
	});
});

gulp.task('default', ['css', 'scripts']);


gulp.task('copy-assets', function () {

// Copy all Bootstrap SCSS files
    gulp.src(basePaths.bower + 'bootstrap-sass/assets/stylesheets/**/*')
        .pipe(paths.styles.dest('./bootstrap-sass'));

// Copy all Bootstrap Javascript files
    gulp.src(basePaths.bower + 'bootstrap-sass/assets/javascripts/**/*.js')
        .pipe(paths.scripts.dest('js/uncompressed'));

// Copy all Bootstrap Fonts
    gulp.src(basePaths.bower + 'bootstrap-sass/assets/fonts/bootstrap/*.{ttf,woff,woff2,eof,svg}')
        .pipe(gulp.dest('./fonts'));

// Copy all Font Awesome Fonts
    gulp.src(basePaths.bower + 'fontawesome/fonts/**/*.{ttf,woff,woff2,eof,svg}')
        .pipe(gulp.dest('./fonts'));

// Copy all Font Awesome SCSS files
    gulp.src(basePaths.bower + 'fontawesome/scss/*.scss')
        .pipe(paths.styles.dest('./sass/fontawesome'));

// Copy all Understrap SCSS files
    gulp.src(basePaths.bower + '_s/sass/**/*')
        .pipe(paths.styles.dest('./sass/_s/sass'));

// Copy all Understrap _s JS files
    gulp.src(basePaths.bower + '_s/js/*.js')
        .pipe(paths.scripts.dest('./js/uncompressed'));

// Copy all Material Design CSS files
    gulp.src(basePaths.bower + 'bootstrap-material-design/dist/css/*.css')
        .pipe(ignore('*.min.css'))
        .pipe(paths.styles.dest('./css/uncompressed'));

// Copy all Material Design JS files
    gulp.src(basePaths.bower + 'bootstrap-material-design/dist/js/*.js')
        .pipe(ignore('*.min.js'))
        .pipe(paths.scripts.dest('./js/uncompressed'));

// Copy jQuery
    gulp.src(basePaths.bower + 'jquery/dist/*.js')
        .pipe(paths.scripts.dest('./js/uncompressed'));

// Copy all Owl2 JS files
    gulp.src(basePaths.bower + 'OwlCarousel2/dist/*.js')
        .pipe(paths.scripts.dest('./js/uncompressed'));

// Copy all Owl2 SCSS files
    gulp.src(basePaths.bower + 'OwlCarousel2/dist/assets/*.css')
        .pipe(paths.styles.dest('./css/uncompressed'));

// Copy kirki
    gulp.src(basePaths.bower + 'kirki/**/*')
        .pipe(gulp.dest('./inc/kirki'));

// Copy CMB2
    gulp.src(basePaths.bower + 'CMB2/**/*')
        .pipe(gulp.dest('./inc/CMB2'));
});
