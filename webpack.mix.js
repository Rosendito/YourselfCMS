const mix = require('laravel-mix')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
	// Config Webpack
	.webpackConfig({
		resolve: {
			alias: {
				'@': path.resolve(
					__dirname,
					'resources/apps/',
				),
			}
		}
	})


	// Homepage
	.js('resources/assets/js/app.js', 'public/js/app.js')
	.sass('resources/assets/styles/homepage/app.scss', 'public/css/style.css')

	// Admin
	.js('resources/apps/index.js', 'public/admin-assets/app.js')
	.sass('resources/assets/styles/admin/app.scss', 'public/admin-assets/style.css')

	// Material Design Icons | Generate once
	// .sass(
	// 	'resources/assets/styles/materialdesign-icons/materialdesignicons.scss',
	// 	'public/css/materialdesign-icons.css'
	// );
	// 