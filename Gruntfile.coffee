module.exports = (grunt)->
  grunt.initConfig
    pkg: grunt.file.readJSON("package.json")
    httpDir: 'web/bundles/album'
    publicDir: 'src/AlbumBundle/Resources/public'
    baseAssetsDir: 'src/AlbumBundle/Resources/assets'
    coffeeDir: '<%= baseAssetsDir %>/coffee'
    sassDir: '<%= baseAssetsDir %>/scss'
    jsDir: '<%= publicDir %>/js'
    cssDir: '<%= publicDir %>/css'
    fontsDir: '<%= publicDir %>/fonts'
    imagesDir: '<%= publicDir %>/images'

#   Cleans the public assets
    clean:
      build:
        src: ['<%= publicDir %>/*']

#   Copies files
    copy:
      templates:
        files: [
          expand: true
          cwd: '<%= coffeeDir %>'
          src: ['**/*.html']
          dest: '<%= jsDir %>'
        ]

#   Compiles the sass files into the public js
    compass:
      options:
        httpPath: '<%= httpDir %>'

        httpJavascriptsPath: '<%= httpDir %>/js'
        javascriptsDir: '<%= jsDir %>'

        httpImagesPath: '<%= httpDir %>/images'
        httpGeneratedImagesPath: '<%= httpDir %>/images'
        imagesDir: '<%= imagesDir %>'

        httpFontsPath: '<%= httpDir %>/fonts'
        fontsPath: '<%= fontsDir %>'

        httpStylesheetsPath: '<%= httpDir %>/css'
        cssDir: '<%= cssDir %>'
        sassDir: '<%= sassDir %>'
      dev:
        options:
          environment: 'development'
          cacheDir: 'app/cache/dev/sass-cache'
      prod:
        options:
          cacheDir: 'app/cache/prod/sass-cache'
          environment: 'production'
          outputStyle: 'compressed'

#   Compiles coffee files
    coffee:
      main:
        expand: true
        cwd: '<%= coffeeDir %>'
        src: ['**/*.coffee']
        dest: '<%= jsDir %>'
        ext: '.js'

#   Lints the coffee files
    coffeelint:
      main:
        files: [
            expand: true
            src: ['<%= coffeeDir %>/**/*.coffee']
        ]

#   Uglifies compiled js files
    uglify:
      main:
        files: [
          expand: true
          cwd: '<%= jsDir %>'
          src: '**/*.js'
          dest: '<%= jsDir %>'
        ]

    watch:
      coffee:
        files: ['<%= coffeeDir %>/**']
        tasks: ['coffee:watch', 'templates:watch']
        options:
          spawn: false
      sass:
        files: ['<%= sassDir %>/**']
        tasks: ['sass:watch']
        options:
          spawn: false

  grunt.loadNpmTasks 'grunt-contrib-compass'
  grunt.loadNpmTasks 'grunt-contrib-watch'
  grunt.loadNpmTasks 'grunt-contrib-copy'
  grunt.loadNpmTasks 'grunt-contrib-clean'
  grunt.loadNpmTasks 'grunt-contrib-coffee'
  grunt.loadNpmTasks 'grunt-contrib-uglify'
  grunt.loadNpmTasks 'grunt-coffeelint'



  # Task for watching Coffee file changes
  grunt.registerTask 'coffee:watch', ['coffee']
  grunt.registerTask 'sass:watch', ['compass:dev']

  # Task for watching templates changes
  grunt.registerTask 'templates:watch', ['copy:templates']

  # Task to run when deploying
  grunt.registerTask 'dev', ['clean', 'copy:templates', 'compass:dev', 'coffee']

  # Task to run when deploying
  grunt.registerTask 'prod', ['clean', 'copy:templates', 'compass:prod', 'coffee', 'uglify']

  # Default task
  grunt.registerTask 'default', ['prod']