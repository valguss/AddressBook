// Load plugins
var gulp = require('gulp'),
    browserSync             = require('browser-sync').create(),
    cached = require('gulp-cached'),
    concat = require('gulp-concat'),
    cond = require('gulp-cond'),
    gulpstylelint = require('gulp-stylelint'),
    jslint = require('gulp-jslint'),
    newer = require('gulp-newer'),
    postcss                 = require('gulp-postcss'),
    postCSSconditionals     = require('postcss-conditionals'),
    postCSSeach             = require('postcss-each'),
    postCSSextend           = require('postcss-extend'),
    postCSSfor              = require('postcss-for'),
    postCSSmap              = require('postcss-map'),
    postCSSmath             = require('postcss-math'),
    sourcemaps = require('gulp-sourcemaps'),
    uglify = require('gulp-uglify');

// define paths
var path = {
    theme_skin: 'web/assets/',
};

// Array to store PostCSS maps
var maps = {
    basePath: path.theme_skin + 'css',
    maps: [ 'fonts.yml' ]
};

// Array to store PostCSS plugins
var processors = [
    require('postcss-simple-vars')(),
    require('precss')(),
    require('postcss-cssnext')(),
    postCSSconditionals(),
    postCSSeach(),
    postCSSextend(),
    postCSSfor(),
    postCSSmap(maps),
    postCSSmath({precision: 10})
];

// 'postcss' task used to transform CSS using PostCSS
gulp.task('postcss', function () {
    return gulp
        .src(path.theme_skin + 'css/src/styles.css')
        .pipe(
            cond(env === 'development',
                function () {
                    return sourcemaps.init();
                })
        )
        // Pipe the styles in through PostCSS and pass in the 'processors' array.
        .pipe(postcss(processors))
        .pipe(
            cond(env === 'development',
                function () {
                    return sourcemaps.write('.');
                })
        )
        // Output the transformed CSS to the
        .pipe(gulp.dest(path.theme_skin + 'css'))
        .pipe(browserSync.stream({match: '**/*.css'}));
});

// 'css-lint' task used to lint css via stylelint
gulp.task('css-lint', function () {
    return gulp
        .src([path.theme_skin + 'css/src/**/*.css', '!' + path.theme_skin + 'css/src/vendor/*.css'])
        .pipe(gulpstylelint({
            failAfterError: true,
            reporters: [
                {formatter: 'string', console: true}
            ]
        }));
});

gulp.task('css', ['css-lint', 'postcss']);

gulp.task('watch', function () {
    gulp.watch(path.theme_skin + 'css/src/**/*.css', ['css']);
});

gulp.task('browser-sync', function () {
    browserSync.init({
        proxy: "http://"
    });
});

gulp.task('set-prod', function () {
    // use for minified css
    processors.push(require("csswring")());
});

gulp.task('set-dev', function () {
    // use for non minified js and css
    env = 'development';
});

gulp.task('init', ['set-dev', 'css']);
gulp.task('init-prod', ['set-prod', 'css']);
gulp.task('default', ['set-dev', 'init', 'browser-sync', 'watch']);
gulp.task('default-prod', ['set-prod', 'init', 'browser-sync', 'watch']);
