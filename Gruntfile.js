const mozjpeg = require( 'imagemin-mozjpeg' );
const path = require('path');

const sass = require('node-sass');

/**
 * ============================================================
 *
 * https://www.tutorialspoint.com/nodejs/nodejs_path_module.htm
 *
 * ============================================================
 */
const ABSPATH          = path.resolve( '../../../' );
const WP_CONTENT       = ABSPATH + path.sep + 'wp-content';
const WP_PLUGIN_PATH   = WP_CONTENT + path.sep + 'plugins' + path.sep;
const WPMU_PLUGIN_PATH = WP_CONTENT + path.sep + 'mu-plugins' + path.sep;
const WP_THEME_PATH    = WP_CONTENT + path.sep + 'themes' + path.sep;
const TEMPLATEPATH     = WP_THEME_PATH + 'italystrap' + path.sep;
const STYLESHEETPATH   = WP_THEME_PATH + path.basename( path.resolve() ) + path.sep;

const NODE_PATH = 'node_modules/';
const BOOTSTRAP_PATH = NODE_PATH + 'bootstrap/';
const BOOTSTRAP_JS_PATH = BOOTSTRAP_PATH + 'js/dist/';
const BOOTSTRAP_JS_FILES = [
	NODE_PATH + '@popperjs/core/cjs/popper.js',
	BOOTSTRAP_JS_PATH + 'dom/data.js',
	BOOTSTRAP_JS_PATH + 'dom/event-handler.j',
	BOOTSTRAP_JS_PATH + 'dom/manipulator.js',
	BOOTSTRAP_JS_PATH + 'dom/polyfill.js',
	BOOTSTRAP_JS_PATH + 'dom/selector-engine.js',
	BOOTSTRAP_JS_PATH + 'alert.js',
	BOOTSTRAP_JS_PATH + 'button.js',
	BOOTSTRAP_JS_PATH + 'carousel.js',
	BOOTSTRAP_JS_PATH + 'collapse.js',
	BOOTSTRAP_JS_PATH + 'dropdown.js',
	BOOTSTRAP_JS_PATH + 'modal.js',
	BOOTSTRAP_JS_PATH + 'popover.js',
	BOOTSTRAP_JS_PATH + 'scrollspy.js',
	BOOTSTRAP_JS_PATH + 'tab.js',
	BOOTSTRAP_JS_PATH + 'toast.js',
	BOOTSTRAP_JS_PATH + 'tooltip.js',
];

const AUTH = {
	host: 'ftp.your-host.tld',
	port: 21,
	authKey: 'key1'
};
const SFTP_AUTH = {
	host: 'ftp.your-host.tld',
	port: 22,
	authKey: 'sftp'
};

const PARENT_PATH = 'E:/xampp/htdocs/italystrap/wp-content/';

const italystrap_theme = [
	'**',
	'!codecept',
	'!.git/**',
	'!.gitattributes',
	'!.gitignore',
	'!.sass-cache/**',
	'!node_modules/**',
	'!bower/**',
	'!tests/**',
	'!future-inclusions/**',
	'!sass/**',
	'!css/src/**',
	'!js/src/**',
	'!snippets.md',
	'!bower.json',
	'!Gruntfile.js',
	'!package.json',
	'!*.yml',
	'!*.zip',
	'!**/*.map',
];

const SITEMAP = [
];

module.exports = function(grunt) {
	'use strict';

	/**
	 * https://www.npmjs.com/package/load-grunt-tasks
	 */
	require('load-grunt-tasks')(grunt);

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

        exec: { // https://github.com/jharding/grunt-exec
            theme_json: 'composer run json',
            unit_debug: 'composer run unit:debug'
        },

		babel: {
			options: {
				sourceMap: false,
				presets: ['@babel/preset-env']
			},
			dist: {
				files: {
					'assets/temp/bootstrap.js': [
						'assets/temp/concat-bootstrap.js',
					],
				}
			}
		},

		ts: {
			default: {
				tsconfig: './tsconfig.json',
				src: ['assets/ts/index.ts'],
			},
		},

		uglify: {
			src: {
				options: {
					sourceMap: true,
					beautify: true,
					mangle: false,
				},
				files: {
					'assets/js/index.js': [
						NODE_PATH + 'jarallax/dist/jarallax.min.js',
						BOOTSTRAP_PATH + 'dist/js/bootstrap.js',
						'assets/ts/index.js' // <- Modify this
					],
				}
			},
			dist: {
				files: {
					'assets/js/index.min.js': [
						NODE_PATH + 'jarallax/dist/jarallax.min.js',
						BOOTSTRAP_PATH + 'dist/js/bootstrap.js',
						'assets/ts/index.js' // <- Modify this
					],
				}
			}
		},

		jshint: {
			all: [
				'Gruntfile.js',
				'assets/js/*.js',
			],
			options: true,
		},

		sass:{
			options: {
				force:true,
				sourceMap: true,
				implementation: sass,
				// sassDir:'assets/sass',
				// cssDir:'assets/css',
				// imagesDir:'assets/img',
				// fontsDir: 'fonts',
				// fontsPath: 'assets/fonts/',
				// relativeAssets: true,
				// importPath: BOOTSTRAP_PATH,
			},
			dist: {                            // Target
				// options: {                       // Target options
				// 	style: 'expanded'
				// },
				files: {                         // Dictionary of files
					'assets/css/index.css': 'assets/sass/index.scss',
					'assets/css/index.min.css': 'assets/sass/index.min.scss',
					'assets/css/editor-style.css': 'assets/sass/editor-style.scss',
				}
			},
		},

		uncss: {
			options: {

			},
			dist: {
				files: [
					{
						nonull: true,
						src: SITEMAP,
						dest: 'assets/css/critical.min.css'
					}
				]
			}
		},

		postcss: { // https://github.com/nDmitry/grunt-postcss
			options: {
				processors: [
					require('pixrem')(), // add fallbacks for rem units
					require('autoprefixer')({browsers: 'last 5 versions'}), // add vendor prefixes
					require('cssnano')() // minify the result
				],
			},
			dist: {
				src: 'assets/css/*.min.css'
			}
		},

		csslint: { // http://astainforth.com/blogs/grunt-part-2
			files: ['assets/css/*.css',],
			options: {
				csslintrc: '.csslintrc'
			}
		},

		/**
		 * https://www.npmjs.com/package/grunt-svgmin
		 * $ grunt svg
		 */
		svgmin: { //minimize SVG files
			options: {
				plugins: [
					{
						removeViewBox: true
					},
					{
						removeUselessStrokeAndFill: false
					},
					{
						removeAttrs: {
							attrs: ['xmlns', 'height', 'width']
						}
					}
				]
			},
			bg: {
				expand: true,
				cwd: 'assets/svg',
				src: ['*.svg'],
				dest: 'assets/img',
				// ext: '.colors-light-danger-success.svg'
				ext: '.svg'
			}
		},

		/**
		 * https://www.npmjs.com/package/grunt-contrib-imagemin
		 */
		imagemin: {
			options: {
				optimizationLevel: 3,
				svgoPlugins: [{removeViewBox: false}],
				// use: [mozjpeg()], // Example plugin usage
				concurrency: 1,
			},
			dynamic: {
				files: [{
					expand: true,
					cwd: 'assets/img/src/',
					src: ['**/*.{png,jpg,gif}'],
					dest: 'assets/img/'
				}]
			}
		},

		/**
		 * https://github.com/nfroidure/grunt-ttf2woff
		 */
		ttf2woff: {
			default: {
				src: ['assets/fonts/*.ttf'],
				dest: 'assets/fonts/'
			}
		},

		/**
		 * https://github.com/jmalonzo/grunt-ttf2woff2
		 */
		ttf2woff2: {
			default: {
				src: ["assets/fonts/*.ttf"],
				dest: "assets/fonts"
			},
		},

		/**
		 * Copy updated dependency
		 * $ grunt copy
		 */
		copy: { // https://github.com/gruntjs/grunt-contrib-copy
			parent_theme: {
				expand: true, // https://github.com/gruntjs/grunt-contrib-copy/issues/90
				cwd: PARENT_PATH + 'themes/ItalyStrap/',
				src: ['**', '!node_modules/**', '!bower/**', '!tests/**'],
				dest: '../italystrap/',
				filter: 'isFile',
			},
		},

		clean: { // https://github.com/gruntjs/grunt-contrib-clean
			options: { force: true },
			clean: [
				"assets/temp/**.*",
			]
		},

		compress: { // https://github.com/gruntjs/grunt-contrib-compress
			main: {
				options: {
					archive: '../<%= pkg.name %> <%= pkg.version %>.zip' // Create zip file in theme directory
				},
				files: [
					{
						src: italystrap_theme, // What should be included in the zip
						dest: '<%= pkg.name %>/',        // Where the zipfile should go
						filter: 'isFile',
					},
				]
			}
		},

		watch: { // https://github.com/gruntjs/grunt-contrib-watch
			sass: {
				files: ['assets/sass/**/**/*.{scss,sass}'],
				tasks: ['css'],
			},
			ts: {
				files: ['assets/ts/*.ts'],
				tasks: ['js'],
			},
			// js: {
			// 	files: ['src/js/*.js'],
			// 	tasks: ['js'],
			// },
			bg: {
				files: ['assets/svg/*.svg'],
				tasks: ['svgmin'],
			},
			img: {
				files: ['assets/img/src/**.{png,jpg,gif}'],
				tasks: ['imagemin'],
			},
			themeJson: {
				files: ['src/JsonData.php'],
				tasks: ['exec:theme_json'],
			},
			php: {
				files: ['src/**.php', 'tests/unit/**/*.php'],
				tasks: ['exec:unit_debug'],
			},
			options: {
				livereload: true,
			},
		},

	});

	grunt.registerTask( 'css', ['sass', 'postcss'] );
	grunt.registerTask( 'js', ['ts', 'uglify'] );
	grunt.registerTask( 'cs', ['jshint', 'csslint'] );
	grunt.registerTask( 'font', ['ttf2woff', 'ttf2woff2'] );

    grunt.registerTask( 'build', [
			'css',
			'js'
        ]
    );

    /**
     * This task is only for my personal use.
     */
    // grunt.registerTask( 'parent', [
    //     'clean',
    //     'copy:parent_theme',
    //     'copy:parent_plugins',
    //     ]
    // );

	grunt.event.on('watch', function( action, filepath ) {
		grunt.log.writeln( filepath + ' has ' + action );
	});

	/**
	 * http://gruntjs.com/api/grunt.log
	 */
    grunt.registerTask( 'debug', 'Debug mode.', function( arg ) {
        // var msg = 'Doing something...';
        // var ABSPATH = path.resolve('../../../' );
        // var theme_name = path.basename( path.resolve() );
        // grunt.verbose.write( theme_name );
        // grunt.verbose.write( ABSPATH );
        // grunt.verbose.write( WP_CONTENT );
        // grunt.verbose.write( STYLESHEETPATH );
        grunt.verbose.write( arg );
        // grunt.verbose.write( pkg.name );
        return null;
    });
};