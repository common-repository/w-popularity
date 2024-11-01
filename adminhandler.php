<?php
// -- HANDLE ACTIONS

if(!function_exists("akpc_options_form"))
{
	function akpc_options_form()
	{
		global $wpop;
		$temp = new Popmanager();
		include('optionpage.php');
	}
}

if(!function_exists("akpc_view_stats"))
{
function akpc_view_stats() {
	global $wpop;
	$wpop->view_stats();
}
}


if(!function_exists("akpc_options"))
{
function akpc_options() {
	if (function_exists('add_options_page'))
	{
		//add_submenu_page('options-general.php', 'Sociable', 'Sociable', 8, 'Sociable', 'sociable_submenu');
		add_options_page(
			__('wPopularity', 'holbreich.de')
			, __('wPopularity', 'holbreich.de')
			, 10
			, __('wPopularity', 'holbreich.de')
			, 'akpc_options_form'
		);
	}
	if (function_exists('add_submenu_page')) {
		add_submenu_page(
			'index.php'
			, __('Most Popular Posts', 'holbreich.de')
			, __('Most Popular Posts', 'holbreich.de')
			, 0
			, __FILE__
			, 'akpc_view_stats'
		);
	}
}

}

if(!function_exists("akpc_options_css"))
{
function akpc_options_css() {
	echo('<link rel="stylesheet" type="text/css" href="');
	bloginfo('wpurl');
	echo('/wp-content/plugins/wpopularity/adminhandler.php?ak_action=css" />');
}
}

// ----- Handling -----
if (isset($_POST['ak_action']))
{
	switch($_POST['ak_action']) {
		case 'update_popularity_values':
			require_once('wpopularity.php');
			wpop_init();
			$wpop->get_settings();
			$wpop->update_settings();
			break;
	}
}
if (isset($_GET['ak_action']))
{
	switch($_GET['ak_action']) {
		case 'recount_feedback':
			require_once('wpopularity.php');
			wpop_init();
			$wpop->get_settings();
			$wpop->recount_feedback();
			wp_die(" URAAAAA!");
			break;
		case 'css':
			header("Content-type: text/css");
?>
#akpc_most_popular {
	height: 250px;
	overflow: auto;
	margin-bottom: 10px;
}
#akpc_most_popular td.right, #akpc_options_link {
	text-align: right;
}
#akpc_most_popular td a {
	border: 0;
}
.akpc_report {
	float: left;
	margin: 5px 30px 20px 0;
	width: 200px;
}
.akpc_report h3 {
	border-bottom: 1px solid #999;
	color #333;
	margin: 0 0 4px 0;
	padding: 0 0 2px 0;
}
.akpc_report ol {
	margin: 0 0 0 20px;
	padding: 0;
}
.akpc_report ol li span {
	float: right;
}
.akpc_report ol li a {
	border: 0;
	display: block;
	margin: 0 30px 0 0;
}
.clear {
	clear: both;
	float: none;
}
#akpc_template_tags dl {
	margin-left: 10px;
}
#akpc_template_tags dl dt {
	font-weight: bold;
	margin: 0 0 5px 0;
}
#akpc_template_tags dl dd {
	margin: 0 0 15px 0;
	padding: 0 0 0 15px;
}
<?php
			die();
			break;
	}
}

?>