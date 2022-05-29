const { src, dest, watch, parallel } = require("gulp");

// Css
const sass = require("gulp-sass")(require('sass'));
const plumber = require("gulp-plumber");
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const postcs = require('gulp-postcss');
const sourcemaps = require('gulp-sourcemaps')

// Imagenes
const cache = require('gulp-cache')
const imagemin = require('gulp-imagemin')
const webp = require('gulp-webp')
const avif = require('gulp-avif')

// JavaScript
const terser = require('gulp-terser-js')

function css(done) {
    // Identificar archivos .SCSS a compilar
    src("src/scss/**/*.scss")
        .pipe(sourcemaps.init()) // Map de busqueda
        .pipe(plumber())
        .pipe(sass()) // Compilamos
        .pipe(postcs([autoprefixer(), cssnano()])) // Acortar Css
        .pipe(sourcemaps.write('.'))
        .pipe(dest('build/css')) // Almacenamos en el disco duro
    done();
}

function imagenes(done) {
    const opciones = {
        optimizationLevel: 3
    };
    src('src/img/**/*.{png,jpg}')
        .pipe(cache(imagemin(opciones)))
        .pipe(dest('build/img'))
    done();
}

function versionWebp(done) {
    const opciones = {
        quality: 50
    };

    src('src/img/**/*.{png,jpg}')
        .pipe(webp(opciones))
        .pipe(dest('build/img'))

    done();
}

function versionAvif(done) {
    const opciones = {
        quality: 50
    };

    src('src/img/**/*.{png,jpg}')
        .pipe(avif(opciones))
        .pipe(dest('build/img'))

    done();
}

function javascript(done) {
    src('src/js/**/*.js')
        .pipe(terser())
        .pipe(dest('build/js'));

    done();
}

function dev(done) {
    watch("src/scss/**/*.scss", css)
    watch("src/js/**/*.js", javascript)
    done();
}


exports.css = css;
exports.js = javascript;
exports.imagenes = imagenes;
exports.versionWebp = versionWebp;
exports.versionAvif = versionAvif;
exports.dev = parallel(imagenes, versionWebp, versionAvif, javascript, dev);