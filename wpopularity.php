<?php
/*
Plugin Name: wPopularity
Plugin URI: http://alexander.holbreich.org/downloads/
Description: This will enable ranking of your posts by popularity using the behavior of your visitors to determine each post's popularity. That Plugin is based on <a href="http://alexking.org/projects/wordpress">Popularity Contest Plug-In</a>  designed by Alex King. Additionaly this plugin adds configurable Widget wich is not awailable in the origin. Both PlugIns should be compatible. But don't run them simultanoiosly.
Version: 1.0.0
Author: Alexander Holbreich (based on work of Alex King)
Author URI: http://alexander.holbreich.org/
*/

// Copyright (c) 2008 Alexander Holbreich. All rights reserved.
//
// Released under the GPL license
// http://www.opensource.org/licenses/gpl-license.php
//
// This is an add-on for WordPress
// http://wordpress.org/
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
// **********************************************************************
//
// Known Issues
// - When spam comments/pingbacks/trackbacks are deleted or marked as
//   spam, their value is not always removed from the posts they were
//   applied to. This is because the hooks in WP do not seem to fire
//   consistently with sufficient data. Hopefully this will be fixed in
//   a future release of WP.

/* -- INSTALLATION --------------------- */

// Change this to "0" below if you don't want to show each post's popularity with the post content
@define('AKPC_SHOWPOP', 0);


// To hide the popularity score on a per post/page basis, add a custom field to the post/page as follows:
//   name: hide_popularity
//   value: 1

// Change this to "0" if you don't want to show the little [?] that links to the explanation of what the popularity means
@define('AKPC_SHOWHELP', 0);

/* ------------------------------------- */


/**
 * Inits everything
 *
 */
if(!function_exists("wpop_init"))
{
	function wpop_init()
	{
		global $wpdb, $wpop;
		require_once(ABSPATH .'/wp-blog-header.php');
    	require_once('functions.php');
    	require_once('adminhandler.php');
    	require_once('popmanager.php');

		$wpdb->table_popularity = $wpdb->prefix.'w_popularity';
		$wpdb->table_popularity_options = $wpdb->prefix.'w_popularity_options';

		$wpop = new Popmanager();

		//Registering of Widgets
		$dims90 = array( 'height' => 120, 'width' => 350 );
		if(function_exists(wp_register_sidebar_widget))
		{
			wp_register_sidebar_widget('widget_wpopular', __('Most Popular'), 'widget_wpopular');
			wp_register_widget_control('widget_wpopular', __('Most Popular Widget Settings'), 'widget_wpopular_control', $dims90);
		}
		$current = get_option('active_plugins');
		if (in_array('wPopularity', $current) )
		{
			//$wpop->get_settings(); // will fail if not activated before.
		}
	}
}

load_plugin_textdomain('holbreich.de');
if(!function_exists("widget_wpopular"))
{
	/**
	* Creates Most popular widget
	*/
	function widget_wpopular($args)
	{
		extract($args);
		$options 	= get_option('widget_wpopular1');
		$title 		= (empty($options['title'])) ? __('Most Popular Articles') : $options['title'];
		$advanced 	= $options['advanced'] ? '1' : '0';

		if ( !$number = (int) $options['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 20 )
			$number = 20;

		echo $before_widget.$before_title.$title.$after_title;
		echo "<ul>";
		if($advanced)
		{
			if (is_category())
			{
				akpc_most_popular_in_cat($number);
			} else if( is_month() || is_day())
			{
				akpc_most_popular_in_month($number);
			}else if( is_year())
			{
				akpc_most_popular_in_year($number);
			}else if (!is_archive() && !is_category())
			{
				akpc_most_popular($number);
			}
		}
		else
		{
			akpc_most_popular($number);
		}
		echo "</ul>";
		echo $after_widget;
	}
}



if(!function_exists("widget_wpopular_control"))
{
/**
* Controll of widget in the Widgets dialog
*/
function widget_wpopular_control() {
	$options = $newoptions = get_option('widget_wpopular');
	if ( $_POST["wpopular-submit"] )
	{
		$newoptions['title'] = strip_tags(stripslashes($_POST["wpopular-title"]));
		$newoptions['advanced'] = isset($_POST["wpopular-advanced"]);
		$newoptions['number'] = (int) $_POST["wpopular-number"];
	}
	if ( $options != $newoptions ) {
		$options = $newoptions;
		update_option('widget_wpopular1', $options);
	}
	$title = attribute_escape($options['title']);
	$count = $options['advanced'] ? 'checked="checked"' : '';
	if ( !$number = (int) $options['number'] )
		$number = 7;
?>
			<p>
				<label for="wpopular-title"><?php _e('Title:'); ?>
				<input style="width: 300px;" id="wpopular-title" name="wpopular-title" type="text" value="<?php echo $title; ?>" />
				</label>
			</p>
			<p>
				<label for="wpopular-number"><?php _e('Maximum number of posts to show:'); ?>
				<input style="width: 25px; text-align: center;" id="wpopular-number" name="wpopular-number" type="text" value="<?php echo $number; ?>" /></label>
				<?php _e('(at most 20)'); ?>
			</p>
			<p style="text-align:right;margin-right:25px;">
				<label for="wpopular-advanced"><?php _e('Category and Archives aware'); ?>
				<input class="checkbox" type="checkbox" <?php echo $count; ?> id="wpopular-advanced" name="wpopular-advanced" />
				</label>
			</p>
			<input type="hidden" id="wpopular-submit" name="wpopular-submit" value="1" />
<?php
}
}

 // --------- Hookable Functions
if(!function_exists("wpop_activate"))
{
function wpop_activate()
{
    global $wpdb, $wpop;
	// CHECK FOR POPULARITY TABLES
	wpop_init(); //inititalization is needed
		$result = mysql_list_tables(DB_NAME);
		$tables = array();
		while ($row = mysql_fetch_row($result))
		{
			$tables[] = $row[0];
		}
		if (isset($tables) && !in_array($wpdb->table_popularity, $tables) && !in_array($wpdb->table_popularity_options, $tables))
		{
			$wpop->install();
		}
		else
		{
			$wpop->get_settings();
			$wpop->mine_gap_data();
		}
}
}


// -------- Register Actions ----

	// for WP 2
register_activation_hook(__FILE__, 'wpop_activate');


if (AKPC_SHOWPOP == 1) {
	add_action('the_content', 'akpc_content_pop');
	add_action('the_excerpt', 'akpc_content_pop');
}

add_action('init', 'wpop_init');

add_action('admin_menu', 'akpc_options');
add_action('admin_head', 'akpc_options_css');

add_action('the_content', 'akpc_view');
add_action('comment_post', 'akpc_feedback_comment');
add_action('pingback_post', 'akpc_feedback_pingback');
add_action('trackback_post', 'akpc_feedback_trackback');

add_action('publish_post', 'akpc_publish');
add_action('delete_post', 'akpc_post_delete');

add_action('publish_page', 'akpc_publish');
add_action('delete_page', 'akpc_post_delete');

// Unfortunately, these don't seem to get called reliably
// w/ usable data available. If they do become available,
// the code here is ready!
add_action('wp_set_comment_status', 'akpc_comment_status');
add_action('delete_comment', 'akpc_comment_delete');

?>