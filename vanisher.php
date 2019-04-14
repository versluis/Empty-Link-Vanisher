<?php

/**
 * Plugin Name: Empty Link Vansiher
 * Plugin URI: https://wpguru.co.uk
 * Description: Makes empty links disappear by remving them from the DOM
 * Version: 0.1
 * Author: Jay Versluis
 * Author URI: https://wpguru.tv
 * License: GPL2
 * License URI:  http://www.gnu.org/licenses/gpl-2.0.html
 */
 
/*  Copyright 2019  Jay Versluis (email support@wpguru.tv)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// add submenu page under Appearance
// https://codex.wordpress.org/Function_Reference/add_theme_page
function elv_vanisher_menu() {
	// add_theme_page('My Plugin Theme', 'My Plugin', 'edit_theme_options', 'my-unique-identifier', 'my_plugin_function');
	add_theme_page('Link Vanisher', 'Link Vanisher', 'edit_theme_options', 'vanisher', 'elv_vanisher');
}
add_action('admin_menu', 'elv_vanisher_menu');

// *********************
// Main Plugin Function
// *********************
function elv_vanisher () {
	
	// check that the user has the required capability 
    if (!current_user_can('manage_options'))
    {
      wp_die( __('You do not have sufficient privileges to access this page. Sorry!') );
    }	
	
	///////////////////////////////////////
	// MAIN AMDIN CONTENT SECTION
	///////////////////////////////////////
	
	// *****************
	// Handle Form Data 
	// *****************

	// save data if necessary
	if (isset($_POST['elv_submit'])) {
		update_option ('elv_class', stripslashes ($_POST['elv_class_input']));
		echo '<div class="updated"><br>Your settings have been saved.<br><br></div>';
	}
	
	// clear data
	if (isset($_POST['elv_clear'])) {
		delete_option ('elv_class');
		echo '<div class="updated"><br>Your settings were cleared.<br><br></div>';
	}
	
	
	// read in database options
	$elv_class = get_option ('elv_class');
	
	// *******************
	// Display Admin Menu
	// *******************
	?>
    <div class="wrap">
    <div id="icon-index" class="icon32"><br></div>
    <h2>Empty Link Vanisher</h2>
    <p>Makes empty links disappear by removing their parent obejcts from the DOM.</p>
    <hr>
    <p>All objects that contain the <strong>a</strong> tag with an empty <strong>href</strong> property (i.e. empty links) will be removed from your site.</p>
    <p>You can also add a <strong>.class</strong> or <strong>#id</strong> to target obejcts in more detail.</p>
    
    <form name="elvForm" method="post" action="">
    <div class="wrap">
    <input type="text" name="elv_class_input" size="60" value="<?php echo $elv_class;?>">
    <br><br>
    <input type="submit" name="elv_submit" class="button-primary" value="Save Changes">
    <input type="submit" name="elv_clear" class="button-secondary" value="Clear Changes">
    </form>
    <br><br>
    
    <hr>
    </div>
<?php
    // ***************
    // Display Footer 
	// ***************
	?>
	<p><a href="https://wpguru.co.uk" target="_blank"><img src="<?php  
	echo plugins_url('images/guru-header-2013.png', __FILE__); ?>" width="300"></a> </p>

<p><a href="https://wpguru.co.uk/2019/03/show-me-the-cookies-how-to-list-all-cookies-on-your-wordpress-site/" target="_blank">Plugin by Jay Versluis</a> | <a href="https://github.com/versluis/Empty-Link-Vanishers" target="_blank">Contribute on GitHub</a> | <a href="https://patreon.com/versluis" target="_blank">Support me on Patreon</a></p>

<p><span><!-- Social Buttons -->

<!-- YouTube -->
<script src="https://apis.google.com/js/platform.js"></script>
<div class="g-ytsubscribe" data-channel="wphosting"></div>

<!-- Place this tag after the last widget tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<!-- Twitter -->
<a href="https://twitter.com/versluis" class="twitter-follow-button" data-show-count="true">Follow @versluis</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

<!-- Facebook -->
<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FThe-WP-Guru%2F162188713810370&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=21&amp;appId=186277158097599" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;" allowTransparency="true"></iframe>

</span></p>
</div>
<?php
}
	// end of Admin Menu Function

// ********************************
// Additional and Helper Functions
// ********************************

// MAIN FUNCTION
function elv_vanish_links() {
	
	// if we're in the admin interface, don't do anything
	if (is_admin()) {
		return;
	}
	
	// initialise jQuery
	wp_enqueue_script ('jquery');
	
	// initialise our own script
	$elv_vanish = plugins_url('vanisher.js', __FILE__);
	wp_enqueue_script ('elv_vanish', $elv_vanish, '', '', true);
	
	// transfer data to JavaScript
	$elv_data = array (
	'random_value' => 'Hello from PHP',
	'elv_class' => get_option ('elv_class'));
	
	wp_localize_script ('elv_vanish', 'elv_data', $elv_data);
}
add_action ('get_footer', 'elv_vanish_links');