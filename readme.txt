=== wPopularity - Wordpres Plug-In ===
Tags: popular, popularity, widget, feedback, view, comment, trackback, statistics, stats
Contributors: Alexander Holbreich
Requires at least: 2.5.0
Tested up to: 3.0.1
Stable tag: 0.9.3

== Short ==
Enables Popularity statistic of articles.

== Compatibility ==
this Plug-In is compatible to Popularity Contest Plug-In. Yo can switsch it enytime without probelem.
But ist NOT RECOMMENDET to use them simultaniosly!!!

== Description ==

Widgetized Popularity Contest (wPopularity) is based on the great Plug-In Popularity Contest (Alex King) and therefore it can the foolowing:  
-keeps a count of 
--your post, 
--category 
--archive views
--comments
--trackbacks, etc. 
and uses them to determine which of your posts are most popular. There are numerical values assigned to each type of view and feedback;
these are used to create a 'popularity score' for each post.

Additionally there is configurable Widget of Most Popular Post for sidebar of your Blog. Also some small 
improvemnets are done, to the original Plug-In. The core Popolarity calculation stays in this version the same.

The values assigned to each view and feedback type are editable and can be changed at any time. 
When you change any of these values, the 'popularity score' for all posts are updated immediately to reflect the new values.

== Installation == 

1. Download the plugin archive and expand it (you've likely already done this).
2. Upload the wpopularity.php folder to your wp-content/plugins directory.
3. Go to the Plugins page in your WordPress Administration area and click 'Activate' for Popularity Contest. This will create the database table used by Popularity Contest.
4. Congratulations, you've just installed Popularity Contest and it is now tracking data for you.
5. Optional: go into Options > Popularity to modify the values of each view and feedback type. 
6. Optional: set up a CRON job to run the 'reset feedback count' script every night (see how to do this in the FAQ section).

== Known Incompatibilities ==

= Caching =

Since Popularity Contest hooks into the WordPress code that actually displays post content, any caching plugin (like WP-Cache) will affect the ability of Popularity Contest to accurately record views.

= XMLRPC Posting =

Popularity Contest uses the WordPress hooks to know when a new post has been added and those hooks are not included in the XMLRPC posting code. When the XMLRPC posting code is updated to include the WordPress posting hooks, Popularity Contest will work as expected when posting from an external blog client.

== Frequently Asked Questions ==  

= Why are new posts so much more popular than old posts? =  

Since home and feed views have not been recorded for old posts, they won't be ranked as highly as new posts.

= Are pages counted too? =


If you have received comment spam or just need to recount your comments/trackbacks for any reason, you can use the 'Reset Comments/Trackback/Pingback Counts' button on the Options > Popularity page. If somment spam is an ongoing problem for you, you may want to set up a CRON job to run this script every night. This example will run the recount every night at 3am:

`0 3 * * * wget -q http://www.example.com/wordpress/wp-content/plugins/wpopularity.php?ak_action=recount_feedback`

= How do I uninstall Widgetized Populairy Contest? = 

Go back to you Plugins page, and click 'Deactivate' for Popularity Contest.

= What if I want to re-enable 'widgetized Popularity Contest later? = 

No problem. Go back to the Plugins page and click 'Activate' for wPopularity. wPopularity will check to see if there are new posts and feedback since it was last activated, and will "catch up" as much as possible.

= How do I disable showing 'Popularity: n%' on my posts? = 

For this, you need to edit the wPopularity plugin .php file. Just change this:

`@define('AKPC_SHOWPOP', 1);`

to this:

`@define('AKPC_SHOWPOP', 0);`

If you don't want to edit the .php file, you can add this to your WordPress index.php file:

`@define('AKPC_SHOWPOP', 0);`

You can also set this on a conditional basis via your own plugin by accessing the 'akpc_display_popularity' hook.

= How do I turn off the '[?]' on my posts? = 

For this, you need to edit the wPopularity plugin .php file. Just change this:

`@define('AKPC_SHOWHELP', 1);`

to this:

`@define('AKPC_SHOWHELP', 0);`

If you don't want to edit the .php file, you can add this to your WordPress index.php file:

`@define('AKPC_SHOWHELP', 0);`

= How can I show lists of my most popular posts in my sidebar? =
Just use Dynamic sidebar Widget Called 'Most Popular'.
 YOu can configure: Titele of Blog, Maximum number of shown posts. And Advanced mode.
 Advaced mode knows: categories, and archives. So is 
 category is selected, the included sidebar shows a list of most popular posts in that category. When viewing a month archive, the included sidebar shows a list of most popular posts for that month.

= Anything else? =
That about does it - enjoy!

--Alexander Holbreich 
http://alexander.holbreich.org/
