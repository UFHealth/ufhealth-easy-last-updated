module.exports = function (grunt) {

	// Start out by loading the grunt modules we'll need
	require('load-grunt-tasks')(grunt);

	// Show elapsed time
	require('time-grunt')(grunt);

	grunt.initConfig(
		{

			/**
			 * Update translation file.
			 */
			makepot: {

				target: {
					options: {
						type:        'wp-plugin',
						domainPath:  '/languages',
						mainFile:    'ufhealth-easy-last-updated.php',
						potFilename: 'ufhealth-easy-last-updated.pot',
						exclude:     ['vendor']
					}
				}
			},
		}
	);

	// A very basic default task.
	grunt.registerTask('default', ['makepot']);

};