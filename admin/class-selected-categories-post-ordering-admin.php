<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https:://www.thevirajshelke.com
 * @since      1.0.0
 *
 * @package    Selected_Categories_Post_Ordering
 * @subpackage Selected_Categories_Post_Ordering/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Selected_Categories_Post_Ordering
 * @subpackage Selected_Categories_Post_Ordering/admin
 * @author     Viraj Shelke <vrjs.29@gmail.com>
 */
class Selected_Categories_Post_Ordering_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The options name to be used in this plugin
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$option_name 	Option name of this plugin
	 */
	private $option_name = 'selected_categories_post_ordering';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Selected_Categories_Post_Ordering_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Selected_Categories_Post_Ordering_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/selected-categories-post-ordering-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Selected_Categories_Post_Ordering_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Selected_Categories_Post_Ordering_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/selected-categories-post-ordering-admin.js', array('jquery'), $this->version, false);
	}

	/**
	 * Add an options page under the Settings submenu
	 *
	 * @since  1.0.0
	 */
	public function add_options_page()
	{

		$this->plugin_screen_hook_suffix = add_options_page(
			__('Selected Category Post Ordering Settings', 'selected-categories-post-ordering'),
			__('Selected Category Post Ordering', 'selected-categories-post-ordering'),
			'manage_options',
			$this->plugin_name,
			array($this, 'display_options_page')
		);
	}
	/**
	 * Render the options page for plugin
	 *
	 * @since  1.0.0
	 */

	public function display_options_page()
	{
		include_once 'partials/selected-categories-post-ordering-admin-display.php';
	}

	/**
	 * Register all related settings of this plugin
	 *
	 * @since  1.0.0
	 */
	public function register_setting()
	{
		// Add a General section
		add_settings_section(
			$this->option_name . '_general',
			__('General', 'selected-categories-post-ordering'),
			array($this, $this->option_name . '_general_cb'),
			$this->plugin_name
		);

		add_settings_field(
			$this->option_name . '_categories',
			__('Enter the categories seperated with comma', 'selected-categories-post-ordering'),
			array($this, $this->option_name . '_categories_cb'),
			$this->plugin_name,
			$this->option_name . '_general',
			array('label_for' => $this->option_name . '_categories')
		);

		register_setting($this->plugin_name, $this->option_name . '_categories', array($this, $this->option_name . '_sanitize_categories'));
	}
	/**
	 * Render the text for the general section
	 *
	 * @since  1.0.0
	 */
	public function selected_categories_post_ordering_general_cb()
	{
		echo '<p>' . __('Please change the settings accordingly.', 'selected-categories-post-ordering') . '</p>';
	}

	/**
	 * Render the treshold day input for this plugin
	 *
	 * @since  1.0.0
	 */
	public function selected_categories_post_ordering_categories_cb()
	{
		$categories = get_option($this->option_name . '_categories');
		echo '<input type="text" name="' . $this->option_name . '_categories' . '" id="' . $this->option_name . '_categories' . '" value="' . $categories . '"> ' . __('categories', 'selected-categories-post-ordering');
	}

	/**
	 * Sanitize the text position value before being saved to database
	 *
	 * @param  string $position $_POST value
	 * @since  1.0.0
	 * @return string           Sanitized value
	 */
	public function selected_categories_post_ordering_sanitize_categories($categories)
	{
		// TODO
		return $categories;
	}
}
