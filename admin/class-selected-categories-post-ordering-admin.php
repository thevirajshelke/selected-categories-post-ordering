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
	 * Add an options page under the Settings sub menu
	 *
	 * @since  1.0.0
	 */
	public function add_options_page()
	{

		$this->plugin_screen_hook_suffix = add_options_page(
			__('Selected Categories Post Ordering Settings', 'selected-categories-post-ordering'),
			__('Selected Categories Post Ordering', 'selected-categories-post-ordering'),
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
		add_option('scpo_options');
		register_setting($this->plugin_name, 'scpo_options');

		// Add a General section
		add_settings_section(
			 'selected_categories_post_ordering_general',
			__('General Settings', 'selected-categories-post-ordering'),
			array($this, 'selected_categories_post_ordering_general_cb'),
			$this->plugin_name
		);

		$categories = get_categories();

		foreach ($categories as $category) {
			add_settings_field(
				$category->slug . '-category',
				__($category->name, 'selected-categories-post-ordering'),
				array($this, 'selected_categories_post_ordering_category_cb'),
				$this->plugin_name,
				'selected_categories_post_ordering_general',
				array('label_for' => $category->slug.'-category', 'name' => $category->name, 'slug' => $category->slug)
			);

			register_setting($this->plugin_name, `scpo_options[$category->slug]`);
		}
	}
	/**
	 * Render the text for the general section
	 *
	 * @since  1.0.0
	 */
	public function selected_categories_post_ordering_general_cb()
	{
		echo '<p>' . __('Select the categories where you want the post order as chronological. <br>Remaining categories will have the default behaviour.', 'selected-categories-post-ordering') . '</p>';
	}

	/**
	 * Render the categories input fields for this plugin
	 *
	 * @since  1.0.0
	 */
	public function selected_categories_post_ordering_category_cb(array $args)
	{
		$options = get_option('scpo_options');
		echo '<input type="checkbox" name="scpo_options[' . $args['slug'] . ']' . '" id="' . $args['slug'] . '-category' . '" value="1" ' .  checked(1, $options[$args['slug']], false) . '"> ';
	}
}
