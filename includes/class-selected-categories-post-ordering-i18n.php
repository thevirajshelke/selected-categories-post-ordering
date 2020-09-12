<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https:://www.thevirajshelke.com
 * @since      1.0.0
 *
 * @package    Selected_Categories_Post_Ordering
 * @subpackage Selected_Categories_Post_Ordering/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Selected_Categories_Post_Ordering
 * @subpackage Selected_Categories_Post_Ordering/includes
 * @author     Viraj Shelke <vrjs.29@gmail.com>
 */
class Selected_Categories_Post_Ordering_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'selected-categories-post-ordering',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
