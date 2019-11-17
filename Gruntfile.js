module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        exec: {
            bower_install: {
                cmd: 'bower install',
                exitCode: [0, 255]
            },
            composer_install: {
                cmd: 'composer install',
                exitCode: [0, 255]
            },
            server: {
                command: "php -S 192.168.0.5:8043",
                cwd: "public"
            },
        }
    });

    grunt.loadNpmTasks('grunt-exec');
    grunt.task.registerTask('development', ['exec']);
}