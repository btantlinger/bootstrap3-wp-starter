var gulp = require('gulp');

//define plugins
var sass = require('gulp-sass');
var flatten = require('gulp-flatten');
var gulpFilter = require('gulp-filter'); // 4.0.0+
var uglify = require('gulp-uglify');
var cleanCSS = require('gulp-clean-css');
var rename = require('gulp-rename');
var sourcemaps = require('gulp-sourcemaps');
var mainBowerFiles = require('main-bower-files');

var config = {
    bootstrapDir: './bower_components/bootstrap-sass',
    publicDir: './public/wp-content/themes/devdmbootstrap3-child',
};

gulp.task('sass', function () {
    return gulp.src('./sass/theme.scss')
        .pipe(sass({
            includePaths: [config.bootstrapDir + '/assets/stylesheets'],
        }).on('error', sass.logError))
        .pipe(gulp.dest(config.publicDir + '/css'))
        .pipe(sourcemaps.init())
        .pipe(cleanCSS())
        .pipe(sourcemaps.write('./'))
        .pipe(rename({
            suffix: ".min"
        }))
        .pipe(gulp.dest(config.publicDir + '/css'));
});

gulp.task('bs-fonts', function () {
    return gulp.src(config.bootstrapDir + '/assets/fonts/**/*')
        .pipe(gulp.dest(config.publicDir + '/fonts'));
});

// grab libraries files from bower_components, minify and push in /public
gulp.task('import-bower-files', function () {
    var jsFilter = gulpFilter('**/*.js', {restore: true});
    var cssFilter = gulpFilter('**/*.css', {restore: true});
    var fontFilter = gulpFilter(['**/*.eot', '**/*.woff', '**/*.svg', '**/*.ttf'], {restore: true});

    return gulp.src(mainBowerFiles())

        // grab vendor js files from bower_components, minify and push in /public
        .pipe(jsFilter)
        .pipe(gulp.dest(config.publicDir + '/js/'))
        .pipe(sourcemaps.init())
        .pipe(uglify())
        .pipe(rename({
            suffix: ".min"
        }))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(config.publicDir + '/js/'))
        .pipe(jsFilter.restore)

        // grab vendor css files from bower_components, minify and push in /public
        .pipe(cssFilter)
        .pipe(gulp.dest(config.publicDir + '/css'))
        .pipe(sourcemaps.init())
        .pipe(cleanCSS())
        .pipe(sourcemaps.write('./'))
        .pipe(rename({
            suffix: ".min"
        }))
        .pipe(gulp.dest(config.publicDir + '/css'))
        .pipe(cssFilter.restore)

        // grab vendor font files from bower_components and push in /public
        .pipe(fontFilter)
        .pipe(flatten())
        .pipe(gulp.dest(config.publicDir + '/fonts'));
});

gulp.task('import-assets', ['bs-fonts', 'import-bower-files']);

gulp.task('watch-sass',function() {
    gulp.watch('sass/**/*.scss', ['sass']);
});

gulp.task('default', ['sass', 'import-assets']);

