// Обязательная обёртка
module.exports = function(grunt) {

    // Задачи
    grunt.initConfig({
        // Склеиваем
        concat: {
            main: {
                src: [
                    'components/jquery/dist/jquery.js',
                    'components/bootstrap/dist/js/bootstrap.min.js',
                    'components/rxjs/dist/rx.lite.min.js',
                    'components/Chart.js/Chart.min.js',
                    'scripts/*.js'  // Все JS-файлы в папке
                ],
                dest: 'build/scripts.js'
            }
        },
        // Сжимаем
        uglify: {
            main: {
                files: {
                    // Результат задачи concat
                    'build/scripts.min.js': '<%= concat.main.dest %>'
                }
            }
        },
        less: {
          development: {
            options: {
              compress: true,
              yuicompress: true,
              optimization: 2
            },
            files: {
              "assets/css/master.css": "assets/css/master.less" // destination file and source file
            }
          }
        },
        watch: {
          styles: {
            files: ['assets/css/*.less'], // which files to watch
            tasks: ['less'],
            options: {
              nospawn: true
            }
          }
        }
    });

    // Загрузка плагинов, установленных с помощью npm install
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // Задача по умолчанию
    grunt.registerTask('default', ['concat', 'uglify', 'less', 'watch']);
};