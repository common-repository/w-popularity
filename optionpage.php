<div class="wrap">
	<h2>
		<?php echo __('Popularity Contest Options', 'holbreich.de'); ?>
	</h2>
	<form name="wpopularity" action="<?php echo $_SERVER['REQUEST_URI']; //echo get_bloginfo('wpurl').'/wp-admin/options-general.php'; ?>" method="post">
	<fieldset class="options">
		<legend>
			<?php echo __('Popularity Values', 'holbreich.de'); ?>
		</legend>
		<p><?php echo __('Adjust the values below as you see fit. When you save the new options the <a href="index.php?page=wpopularity/wpopularity.php"><strong>popularity rankings</strong></a> for your posts will be automatically updated to reflect the new values you have chosen.', 'holbreich.de');
		    ?>
		</p>
		<table width="100%" cellspacing="2" cellpadding="5" class="editform">
			<tr valign="top">
				<th width="33%" scope="row">
					<label for="single_value">
				<?php echo __('Permalink Views:', 'holbreich.de'); ?>
					</label>
				</th>
				<td>
				<input type="text" name="single_value" id="single_value" value="<?php echo $wpop->single_value; ?>" />
				<?php echo __("(default: $temp->single_value)", 'holbreich.de'); ?></td>
			</tr>
			<tr valign="top">
				<th width="33%" scope="row"><label for="home_value">
				<?php echo __('Home Views:', 'holbreich.de'); ?></label>
				</th>
				<td>
				<input type="text" name="home_value" id="home_value" value="<?php echo $wpop->home_value; ?>" />
				<?php echo __("(default: $temp->home_value)", 'holbreich.de'); ?></td>
				</tr>
				<tr valign="top">
				<th width="33%" scope="row"><label for="archive_value">
				<?php echo __('Archive Views:', 'holbreich.de'); ?></label>
				</th>
				<td><input type="text" name="archive_value" id="archive_value" value="<?php echo $wpop->archive_value; ?>" />
				<?php echo __("(default: $temp->archive_value)", 'holbreich.de'); ?></td>
							</tr>
							<tr valign="top">
								<th width="33%" scope="row"><label for="category_value">

						<?php echo __('Category Views:', 'holbreich.de'); ?></label></th>
								<td><input type="text" name="category_value" id="category_value" value="<?php echo $wpop->category_value; ?>" />

							<?php echo __("(default: $temp->category_value)", 'holbreich.de'); ?></td>
							</tr>
							<tr valign="top">
								<th width="33%" scope="row"><label for="feed_value">
						<?php echo __('Feed Views (full content only):', 'holbreich.de'); ?></label></th>
								<td><input type="text" name="feed_value" id="feed_value" value="<?php echo $wpop->feed_value; ?>" />
						<?php echo __("(default: $temp->feed_value)", 'holbreich.de'); ?></td>
							</tr>
							<tr valign="top">
								<th width="33%" scope="row"><label for="comment_value">

						<?php echo __('Comments:', 'alexking.org'); ?></label></th>
								<td><input type="text" name="comment_value" id="comment_value" value="<?php echo $wpop->comment_value; ?>" />
						 <?php echo __("(default: $temp->comment_value)", 'holbreich.de'); ?></td>
							</tr>
							<tr valign="top">
								<th width="33%" scope="row"><label for="pingback_value">
					<?php echo __('Pingbacks:', 'alexking.org'); ?></label></th>
								<td><input type="text" name="pingback_value" id="pingback_value" value="<?php echo $wpop->pingback_value; ?>" />
					 <?php echo __("(default: $temp->pingback_value)", 'holbreich.de'); ?></td>
							</tr>
							<tr valign="top">
								<th width="33%" scope="row"><label for="trackback_value">
					<?php echo __('Trackbacks:', 'alexking.org'); ?></label></th>
								<td><input type="text" name="trackback_value" id="trackback_value" value="<?php echo $wpop->trackback_value; ?>" />
					 <?php echo __("(default: $temp->trackback_value)", 'holbreich.de'); ?></td>
							</tr>
						</table>
						<h3>
					<?php echo __('Example', 'holbreich.de'); ?>
					  </h3>
						<ul>
							<li>
							<?php echo __('Post #1 receives 11 Home Page Views (11 * 2 = 22), 6 Permalink Views (6 * 10 = 60) and 3 Comments (3 * 20 = 60) for a total value of: <strong>142</strong>', 'alexking.org'); ?></li>
							<li>
						<?php echo __('Post #2 receives 7 Home Page Views (7 * 2 = 14), 10 Permalink Views (10 * 10 = 100), 7 Comments (7 * 20 = 140) and 3 Trackbacks (3 * 80 = 240) for a total value of: <strong>494</strong>', 'alexking.org'); ?></li>
						</ul>
						<input type="hidden" name="ak_action" value="update_popularity_values" />
					</fieldset>
					<p class="submit">
						<input type="submit" name="submit" value="<?php  echo __('Update Popularity Values', 'holbreich.de'); ?>" />
						<input type="button" name="recount" value="<?php echo __('Reset Comments/Trackback/Pingback Counts', 'holbreich.de'); ?>" onclick="location.href='<?php echo get_bloginfo('wpurl').'/wp-admin/options-general.php?ak_action=recount_feedback'; ?>';" />
					</p>
				</form>
			</div>
			<div class="wrap">
			  <h2>Most Popular Posts Widget</h2>
			  <p>
			   One of the features of Widgetized Popular Contest Plug-In is provided and <a href="<?php echo get_bloginfo('wpurl').'/wp-admin/widgets.php'; ?>">configurable Widged</a> for available sidebars.
			  </p>
			  <h3>Configuration options</h3>

			  	<ul>
			  	<li><i>Title</i> - is showsn as title of Widget on the sidebar</li>
			  	<li><i>Max.Number of Posts</i> </li>
			  	<li><i>Category and Archive aware</i> options assures that only such most popular post are shown, that belong to selected category or  Archive (months or year). </li>
			  	</ul>

			</div>
			<div class="wrap">
			<h2>Aknowledges</h2>
			  <p>
			  The core of the Widgetized Popularity Contest Plug-Ing (<b>wPopularity</b>) is based on great Popularity Contest Plug-In of Alex King. <b>wPopularity</b> prowides only some additional configuration options and some small improvements.
			  It is not considered to do some changes to the core at this time.</p>
			  <p>More informaton about this wPopularity can be found on <a href="http://holbreich.de/">My Blog</a></p>
			</div>