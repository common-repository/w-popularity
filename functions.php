<?php
if (!function_exists('is_admin_page')) {

	function is_admin_page() {
		if (function_exists('is_admin')) {
			return is_admin();
		}
		if (function_exists('check_admin_referer'))
		{
			return true;
		}
		else {
			return false;
		}
	}
}




if(!function_exists("akpc_view"))
{
function akpc_view($content) {
	global $wpop;
	$wpop->record_view();
	return $content;
}
}

if(!function_exists("akpc_feedback_comment"))
{
function akpc_feedback_comment() {
	global $wpop;
	$wpop->record_feedback('comment');
}
}

if(!function_exists("akpc_comment_status"))
{
function akpc_comment_status($comment_id) {
	global $wpop;
	$wpop->edit_feedback($comment_id, 'status');
}
}

if(!function_exists("akpc_comment_delete"))
{
function akpc_comment_delete($comment_id) {
	global $wpop;
	$wpop->edit_feedback($comment_id, 'delete');
}
}

if(!function_exists("akpc_feedback_pingback"))
{
function akpc_feedback_pingback() {
	global $wpop;
	$wpop->record_feedback('pingback');
}
}

if(!function_exists("akpc_feedback_trackback"))
{
function akpc_feedback_trackback() {
	global $wpop;
	$wpop->record_feedback('trackback');
}
}

if(!function_exists("akpc_publish"))
{
function akpc_publish($post_ID) {
	global $wpop;
	$wpop->create_post_record($post_ID);
}
}

if(!function_exists("akpc_post_delete"))
{
function akpc_post_delete($post_ID) {
	global $wpop;
	$wpop->delete_post_record($post_ID);
}
}



// -- TEMPLATE FUNCTIONS

if(!function_exists("akpc_the_popularity"))
{
function akpc_the_popularity() {
	global $wpop, $post;
	$wpop->show_post_rank($post->ID);
}

function akpc_most_popular($limit = 10, $before = '<li>', $after = '</li>') {
	global $wpop;
	$wpop->show_top_ranked($limit, $before, $after);
}

function akpc_most_popular_in_cat($limit = 10, $before = '<li>', $after = '</li>', $cat_ID = '') {
	global $wpop;
	$wpop->show_top_ranked_in_cat($limit, $before, $after, $cat_ID);
}

function akpc_most_popular_in_month($limit = 10, $before = '<li>', $after = '</li>', $m = '') {
	global $wpop;
	$wpop->show_top_ranked_in_month($limit, $before, $after, $m);
}

/**
* Year most popular
*/
function akpc_most_popular_in_year($limit = 10, $before = '<li>', $after = '</li>', $m = '') {
	global $wpop;
	$wpop->show_top_ranked_in_year($limit, $before, $after, $m);
}

function akpc_content_pop($str) {
	global $wpop, $post;
	$show = true;
	$show = apply_filters('akpc_display_popularity', $show, $post);
	if (is_feed() || is_admin_page() || get_post_meta($post->ID, 'hide_popularity', true) || !$show) {
		return $str;
	}
	return $str.'<p class="akpc_pop">'.$wpop->get_post_rank($post->ID).'</p>';
}
}
?>