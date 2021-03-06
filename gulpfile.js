var ENV_PRODUCTION = 'production',
	ENV_DEV = 'dev';

var environment = ENV_DEV;

var gulp = require('gulp'),
	compass = require('gulp-compass'),
	jshint = require('gulp-jshint'),
	stylish = require('jshint-stylish'),
	imagemin = require('gulp-imagemin'),
	uglify = require('gulp-uglify'),
	util = require('gulp-util'),
	concat = require('gulp-concat'),
	rename = require('gulp-rename'),
	gulpif = require('gulp-if'),
	scsslint = require('gulp-scss-lint'),
	cache = require('gulp-cached'),
	sass = require('gulp-sass'),
	run_sequence = require('run-sequence');

var PUBLIC_DIR = 'public/',
	RESOURCES_DIR = 'resources/',
	ASSETS_DIR = RESOURCES_DIR + 'assets/',
	SASS_DIR = ASSETS_DIR + 'sass/',
	CSS_DIR = PUBLIC_DIR + 'css/',
	JS_DIR = PUBLIC_DIR + 'js/',
	IMAGES_DIR = PUBLIC_DIR + 'images/';

var assets = require('./assets.json');

gulp.task('set-env-dev', function()
{
	environment = ENV_DEV;
});

gulp.task('set-env-production', function()
{
	environment = ENV_PRODUCTION;
});

gulp.task('compass', function()
{
	gulp.src(SASS_DIR + '**/*.scss').pipe(compass(
	{
		config_file: 'config.rb',
		css: CSS_DIR,
		sass: SASS_DIR,
		environment: environment
	})).on('error', function (error)
	{
		console.log(error);

		this.emit('end');
	}).pipe(gulp.dest(CSS_DIR));
});

gulp.task('sass', function()
{
	gulp.src(SASS_DIR + '**/*.scss').pipe(sass()).pipe(gulp.dest(CSS_DIR));
});

gulp.task('scss-lint', function()
{
	gulp.src(SASS_DIR + '**/*.scss').pipe(cache('scsslint')).pipe(scsslint(
	{
		config: 'scss_lint.yml'
	}));
});

gulp.task('lint', function()
{
	return gulp.src(ASSETS_DIR + 'js/**/*.js').pipe(jshint()).pipe(jshint.reporter(stylish));
});

gulp.task('uglify', function()
{
	gulp.src(ASSETS_DIR + 'js/**/*.js')
		.pipe(gulpif(environment === 'production', uglify().on('error', util.log)))
		//.pipe(gulpif(environment === 'production', rename({extname: '.min.js'})))
		.pipe(gulp.dest(JS_DIR));
});

gulp.task('imagemin', function()
{
	return gulp.src(ASSETS_DIR + 'images/**').pipe(gulp.dest(IMAGES_DIR));
});

gulp.task('watch', function()
{
	gulp.watch(SASS_DIR + '**/*.scss', ['scss-lint', 'compass']);
	gulp.watch(ASSETS_DIR + 'js/**/*.js', ['lint', 'uglify']);
});

gulp.task('dev', function(callback)
{
	run_sequence('set-env-dev', ['scss-lint', 'compass', 'lint', 'uglify', 'imagemin', 'watch'], callback);
});

gulp.task('production', function(callback)
{
	run_sequence('set-env-production', ['scss-lint', 'compass', 'lint', 'uglify', 'imagemin', 'watch'], callback);
});