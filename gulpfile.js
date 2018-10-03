'use strict';

// -----------------------------------------------------------------------------
// Dependencies
// -----------------------------------------------------------------------------

const gulp = require('gulp');
const sass = require('gulp-sass');
const wait = require('gulp-wait');
const plumber = require('gulp-plumber');
const runSequence = require('run-sequence');
const concat = require('gulp-concat');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const svgSprite = require("gulp-svg-sprites"); //generate sprites for svg
const revReplace = require('gulp-rev-replace');

// -----------------------------------------------------------------------------
// Configuration
// -----------------------------------------------------------------------------

//CSS
const sassSource = 'src/scss/**/*.scss';
const cssDest = './';
const sassOptions = { outputStyle: 'compressed' }; //expanded

// -----------------------------------------------------------------------------
// Compile CSS
// -----------------------------------------------------------------------------
gulp.task('sass', function () {
    return gulp.src(sassSource)
        .pipe(wait(500))
        .pipe(plumber())
        .pipe(sass(sassOptions))
        .pipe(postcss([autoprefixer()]))
        .pipe(concat('style.css'))
        .pipe(gulp.dest(cssDest))
})

// -----------------------------------------------------------------------------
// Manage SVG
// -----------------------------------------------------------------------------
//Manage svg files:
// 1. Gathers the files in the src/svg directory and creates
// a sprite.svg and a _sprite.scss
gulp.task('sprites', function () {
    return gulp.src('src/svg-test/*.svg')
        .pipe(svgSprite({
            mode: "symbols",
            svgId: "svg-%f",
            cssFile: '_sprite.scss',
            svgPath: 'svg/sprite.svg'
        }))
        // .pipe(svg2png())
        .pipe(gulp.dest("src/scss/"))
})

// // 2. The sprite.svg gets copied first in the compiled (for development) and then in the dist/svg folder (for production) (the scss get compiled into app.css)
gulp.task('copy-svg', ['sprites'], function () {
    return gulp.src(['src/scss/svg/*.svg'])
        .pipe(revReplace())
        .pipe(gulp.dest('svg/'))
})

// -----------------------------------------------------------------------------
// Watchers
// -----------------------------------------------------------------------------
gulp.task('watch', ['sass'], function () {
    gulp.watch('src/scss/**/*.scss', ['sass']);
})

// -----------------------------------------------------------------------------
// Production build
// -----------------------------------------------------------------------------
gulp.task('build-production', function (callback) {
    runSequence(
        'sass',
        'copy-svg',
        callback
    )
})



