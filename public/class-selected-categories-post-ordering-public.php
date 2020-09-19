<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https:://www.thevirajshelke.com
 * @since      1.0.0
 *
 * @package    Selected_Categories_Post_Ordering
 * @subpackage Selected_Categories_Post_Ordering/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Selected_Categories_Post_Ordering
 * @subpackage Selected_Categories_Post_Ordering/public
 * @author     Viraj Shelke <vrjs.29@gmail.com>
 */
class Selected_Categories_Post_Ordering_Public
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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/selected-categories-post-ordering-public.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/selected-categories-post-ordering-public.js', array('jquery'), $this->version, false);
	}

	function get_categories_whose_order_changed()
	{
		$categories_whose_order_we_need_to_reverse = array();
		$scpo_options = get_option('scpo_options');
		foreach ($scpo_options as $scpo_option => $val){
			if($val == "1"){
				array_push($categories_whose_order_we_need_to_reverse, $scpo_option);
			}
		}
		return $categories_whose_order_we_need_to_reverse;
	}

	//function to modify default WordPress query
	function order_posts_by_date_asc($query)
	{		
		$categories  = $this -> get_categories_whose_order_changed();
		if (!is_admin() && $query->is_main_query()) {
			if (count($categories) !== 0 && is_category($categories)) {
				$query->set('orderby', 'date');
				$query->set('order', 'ASC');
			}
		}
	}
}
