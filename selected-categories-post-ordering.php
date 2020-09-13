<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https:://www.thevirajshelke.com
 * @since             1.0.0
 * @package           Selected_Categories_Post_Ordering
 *
 * @wordpress-plugin
 * Plugin Name:       Selected Categories Post Ordering
 * Plugin URI:        https://wordpress.org/plugins/selected-categories-post-ordering
 * Description:       Simple plugin to change the order of your posts for selected categories (As of now the order is cronological! More options coming soon).
 * Version:           1.0.0
 * Author:            Viraj Shelke
 * Author URI:        https:://www.thevirajshelke.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       selected-categories-post-ordering
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('SELECTED_CATEGORIES_POST_ORDERING_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-selected-categories-post-ordering-activator.php
 */
function activate_selected_categories_post_ordering()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-selected-categories-post-ordering-activator.php';
	Selected_Categories_Post_Ordering_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-selected-categories-post-ordering-deactivator.php
 */
function deactivate_selected_categories_post_ordering()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-selected-categories-post-ordering-deactivator.php';
	Selected_Categories_Post_Ordering_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_selected_categories_post_ordering');
register_deactivation_hook(__FILE__, 'deactivate_selected_categories_post_ordering');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-selected-categories-post-ordering.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_selected_categories_post_ordering()
{

	$plugin = new Selected_Categories_Post_Ordering();
	$plugin->run();
}
run_selected_categories_post_ordering();
