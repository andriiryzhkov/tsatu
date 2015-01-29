'use strict';
module.exports = function (grunt) {
    // Load all tasks
    require('load-grunt-tasks')(grunt);
    // Show elapsed time
    require('time-grunt')(grunt);

    var jsFileList = [
        'assets/vendor/bootstrap/js/transition.js',
        'assets/vendor/bootstrap/js/alert.js',
        'assets/vendor/bootstrap/js/button.js',
        'assets/vendor/bootstrap/js/carousel.js',
        'assets/vendor/bootstrap/js/collapse.js',
        'assets/vendor/bootstrap/js/dropdown.js',
        'assets/vendor/bootstrap/js/modal.js',
        'assets/vendor/bootstrap/js/tooltip.js',
        'assets/vendor/bootstrap/js/popover.js',
        'assets/vendor/bootstrap/js/scrollspy.js',
        'assets/vendor/bootstrap/js/tab.js',
        'assets/vendor/bootstrap/js/affix.js',
        'assets/vendor/jquery/dist/jquery.js',
        'assets/vendor/flexslider/jquery.flexslider.js',
        'assets/js/plugins/*.js',
        'assets/js/_*.js'
    ];

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        jshint: {
            options: {
                jshintrc: '.jshintrc'
            },
            all: [
                'Gruntfile.js',
                'assets/js/*.js',
                '!assets/js/scripts.js',
                '!assets/**/*.min.*'
            ]
        },
        less: {
            dev: {
                files: {
                    'assets/css/main.css': [
                        'assets/less/main.less'
                    ]
                },
                options: {
                    compress: false,
                    // LESS source map
                    // To enable, set sourceMap to true and update sourceMapRootpath based on your install
                    sourceMap: true,
                    sourceMapFilename: 'assets/css/main.css.map',
                    sourceMapRootpath: '/wp-content/themes/tsatu/'
                }
            },
            build: {
                files: {
                    'assets/css/main.min.css': [
                        'assets/less/main.less'
                    ]
                },
                options: {
                    compress: true
                }
            }
        },
        concat: {
            options: {
                separator: ';',
            },
            dist: {
                src: [jsFileList],
                dest: 'assets/js/scripts.js',
            },
        },
        copy: {
            fonts: {
                expand: true,
                flatten: true,
                src: [
                    'assets/vendor/bootstrap/fonts/*',
                    'assets/vendor/fontawesome/fonts/*',
                    'assets/vendor/flexslider/fonts/*'
                ],
                dest: 'assets/fonts'
            },
            tinymce_css: {
                expand: true,
                flatten: true,
                src: [
                    'assets/vendor/bootstrap/dist/css/bootstrap.min.css'
                ],
                dest: 'includes/shortcodes/tinymce/css'
            },
            tinymce_js: {
                expand: true,
                flatten: true,
                src: [
                    'assets/vendor/bootstrap/dist/js/bootstrap.min.js',
                    'assets/vendor/jquery/dist/jquery.min.js',

                ],
                dest: 'includes/shortcodes/tinymce/js'
            }
        },
        uglify: {
            dist: {
                files: {
                    'assets/js/scripts.min.js': [jsFileList]
                }
            }
        },
        autoprefixer: {
            options: {
                browsers: ['last 2 versions', 'ie 8', 'ie 9', 'android 2.3', 'android 4', 'opera 12']
            },
            dev: {
                options: {
                    map: {
                        prev: 'assets/css/'
                    }
                },
                src: 'assets/css/main.css'
            },
            build: {
                src: 'assets/css/main.min.css'
            }
        },
        modernizr: {
            build: {
                devFile: 'assets/vendor/modernizr/modernizr.js',
                outputFile: 'assets/js/vendor/modernizr.min.js',
                files: {
                    'src': [
                        ['assets/js/scripts.min.js'],
                        ['assets/css/main.min.css']
                    ]
                },
                extra: {
                    shiv: false
                },
                uglify: true,
                parseFiles: true
            }
        },
        version: {
            default: {
                options: {
                    format: true,
                    length: 32,
                    manifest: 'assets/manifest.json',
                    querystring: {
                        style: 'tsatu_css',
                        script: 'tsatu_js'
                    }
                },
                files: {
                    'includes/scripts.php': 'assets/{css,js}/{main,scripts}.min.{css,js}'
                }
            }
        },
        watch: {
            less: {
                files: [
                    'assets/less/*.less',
                    'assets/less/**/*.less'
                ],
                tasks: ['less:dev', 'autoprefixer:dev']
            },
            js: {
                files: [
                    jsFileList,
                    '<%= jshint.all %>'
                ],
                tasks: ['jshint', 'concat']
            },
            livereload: {
                // Browser live reloading
                // https://github.com/gruntjs/grunt-contrib-watch#live-reloading
                options: {
                    livereload: false
                },
                files: [
                    'assets/css/main.css',
                    'assets/js/scripts.js',
                    'includes/*.php',
                    '*.php'
                ]
            }
        },
        makepot: {
            target: {
                options: {
                    domainPath: '/languages/',
                    potFilename: 'tsatu.pot',
                    type: 'wp-theme'
                }
            }
        },
        compress: {
            main: {
                options: {
                    archive: 'release/tsatu-<%= pkg.version %>.zip'
                },
                files: [
                    {
                        src: [
                            '*.php',
                            '*.css',
                            '*.md',
                            'screenshot.png',
                            'assets/manifest.json',
                            'assets/css/*.css',
                            'assets/fonts/*',
                            'assets/img/**',
                            'assets/js/scripts.js',
                            'assets/js/scripts.min.js',
                            'assets/js/customizer.js',
                            'assets/js/skip-link-focus-fix.js',
                            'assets/js/vendor/modernizr.min.js',
                            'languages/*',
                            'includes/**'
                        ],
                        dest: 'tsatu/'
                    }
                ]
            }
        }

    });

    // Register tasks
    grunt.registerTask('default', [
        'dev'
    ]);
    grunt.registerTask('dev', [
        'jshint',
        'less:dev',
        'autoprefixer:dev',
        'concat'
    ]);
    grunt.registerTask('build', [
        'jshint',
        'less:build',
        'autoprefixer:build',
        'copy',
        'uglify',
        'modernizr',
        'makepot',
        'version'
    ]);
    grunt.registerTask('release', [
        'dev',
        'build',
        'compress'
    ]);
};
