var gulp = require('gulp'),
	sass = require('gulp-sass'),
	csso = require('gulp-csso'),
    jshint = require('gulp-jshint'),
    uglify = require('gulp-uglify'),
	autoprefixer = require('gulp-autoprefixer'),
	shorthand = require('gulp-shorthand'),
	notify = require('gulp-notify'),
	plumber = require('gulp-plumber'),
	watch = require('gulp-watch'),
	runSequence = require('run-sequence');

var paths = {
	scss: './resources/scss/*.scss',
    css: './assets/css',
    jsSrc: './resources/js/*.js',
	js: './assets/js'
};

gulp.task('sass', function() {

	gulp.src(paths.scss)
    .pipe(plumber({errorHandler: notify.onError("SASS error: <%= error.message %> in <%= error.filename %>")}))
    .pipe(sass({
        outputStyle: 'expanded',
    }))
    .pipe(csso())
    .pipe(autoprefixer({
        browsers: ['> 1%'],
        cascade: false
    }))
    .pipe(gulp.dest(paths.css));

});

gulp.task('dependencies', function() {

    var deps = require('./package.json').dependencies;

    console.log(deps);

    var mains = [];

    for(var name in deps) {
        var package = require('./node_modules/'+name+'/package.json');
        mains.push('./node_modules/'+name+'/'+package.main+'.js');
    }

    return gulp.src(mains)
            .pipe(plumber({errorHandler: notify.onError("JS uglification error: <%= error.message %>")}))
            .pipe(concat('dependencies.js'))
            .pipe(uglify())
            .pipe(gulp.dest(paths.js));

});

gulp.task('uglify', function() {
    return gulp.src(paths.jsSrc)
        .pipe(plumber({errorHandler: notify.onError("JS uglification error: <%= error.message %>")}))
        .pipe(jshint())
        .pipe(jshint.reporter('jshint-stylish'))
        .pipe(uglify())
        .pipe(gulp.dest(paths.js));
});


gulp.task('build', function() {
    runSequence('sass','uglify');
});

gulp.task('default', function() {
	gulp.watch(paths.scss, ['sass']);
    gulp.watch(paths.jsSrc, ['uglify']);
});
