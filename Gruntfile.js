module.exports = function( grunt ) {

  grunt.initConfig({

    uglify : {
      options : {
        mangle : false
      },

      my_target : {
        files : {
          'assets/js/main.js' : [ 'assets/_js/scripts.js' ]
        }
      }
    }, // uglify

    watch : {
   	  options:{livereload:true},
      dist : {
        files : [
          'css/style.css'
        ]
      }
    }, // watch

    imagemin: {
      png: {
         options: {
            optimizationLevel: 6
         },
         files: [{
            expand: true,
            cwd: 'img',
            src: ['**/*.png'],
            dest: 'img/optimized/'
         }]
      }
   },

    express: {
    	all: {
    		options: {
	    		port: 6000,
	    		hostname:'localhost',
	    		bases: ['.'],
	    		livereload: true
    		}
    	}
    }

  });


  // Plugins do Grunt
  // grunt.loadNpmTasks( 'grunt-contrib-uglify' );
  // grunt.loadNpmTasks( 'grunt-contrib-sass' );
  grunt.loadNpmTasks( 'grunt-contrib-watch' );
  grunt.loadNpmTasks( 'grunt-express' );
  grunt.loadNpmTasks('grunt-contrib-imagemin');


  // Tarefas que serão executadas
  // grunt.registerTask( 'default', [ 'uglify', 'sass' ] )
  grunt.registerTask( 'server',['express'] )
  grunt.registerTask( 'default',['imagemin'] )

  // Tarefa para Watch
  grunt.registerTask( 'w', [ 'watch' ] )

};