<?php
/**
 * @package Autolinkerseo
 */
/*
Plugin Name: Simple Autolinker SEO Tool
Plugin URI: http://www.autolinkerseo.com/
Description: Simple Autolinker SEO Tool Is the simplest way to automatically add links to your text. From a box on the bottom of every post and page you can specify a link and keyword to be attached to any text that you insert.Thanks to Autolinker's minimal design there is no conflict with even the most complex themes.Automatically apply links, targets, and no follows to comma separated keywords you specify.
Version: 1.0.2
Author: Dustin, Rakesh
Author URI: http://www.autolinkerseo.com/
License: GPLv2 or later
Text Domain: autolinkerseo
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

define('auto_linker_seo__PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define('auto_linker_seo__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define('auto_linker_seo__MAIN_FILE', __FILE__ );

/* Runs when plugin is activated */
//register_activation_hook(__FILE__,'auto_linker_seo_install'); 

/* Runs on plugin deactivation*/
//register_deactivation_hook( __FILE__, 'auto_linker_seo_remove' );

/* Add MetaBox to Wordpress Post and page editing*/
function auto_linker_seo_add_meta_box() {

	$screens = array( 'post', 'page' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'auto_linker_seo_sectionid',
			__( 'Simple Autolinker SEO Tool', 'auto_linker_seo_textdomain' ),
			'auto_linker_seo_meta_box_callback',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'auto_linker_seo_add_meta_box' );

function auto_linker_seo_meta_box__wp_admin_style() {
        wp_enqueue_script( 'auto_linker_seo_meta_box_htmltourl_js', auto_linker_seo__PLUGIN_URL.'url-html-link.js' );
		//wp_enqueue_script( 'auto_linker_seo_meta_box_zerocopy_js', auto_linker_seo__PLUGIN_URL.'ZeroClipboard.min.js' );
       // wp_enqueue_script( 'auto_linker_seo_meta_box_copy_js', auto_linker_seo__PLUGIN_URL.'clipBoard.js' );        
        wp_enqueue_style( 'auto_linker_seo_meta_box_bootstrap_css', auto_linker_seo__PLUGIN_URL. 'bootstrap.min.css' );
}
add_action( 'admin_enqueue_scripts', 'auto_linker_seo_meta_box__wp_admin_style' );

/**
 * Prints the box content.
 * 
 *
 */
function auto_linker_seo_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'auto_linker_seo_meta_box', 'auto_linker_seo_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	//$value = get_post_meta( $post->ID, '_my_meta_value_key', true );
	  
	echo <<<EOD
	<div class="auto_linker_seo_meta_box">
	  
        <div class="row">
        <div class="col-md-6">
  
	<div class="form-group">
	      <label for="beforeText">Text</label>
	      <textarea class="form-control" rows="5" id="beforeText"></textarea>
   	 </div>
    <div class="form-group">
      <label for="oldUrl">URL</label>
       <input type="text" class="form-control required" name="oldUrl" id="oldUrl" placeholder="URL">
    </div>    
    <div class="form-group">
      <label for="keywordText">Key Word (case sensitive)</label>
      <input type="text" class="form-control required" name="keywordText" id="keywordText" placeholder="Key Words">
    </div>

	<div class="form-group">
	      <label for="classText">Class For Links</label>
	      <input type="text" class="form-control" name="classText" id="classText" placeholder="class">
    	</div>

	<div class="form-group">
	      <label for="idText">ID For Links</label>
	      <input type="text" class="form-control" name="idText" id="idText" placeholder="ID">
    	</div>
	
	<div class="form-group">
	<div class="checkbox">
	  <label><input type="checkbox" value="1" id="noFollow">No Follow</label>
	</div>
	 </div>
	<div class="form-group">
	<label for="lTarget">Target</label>
	<select id="lTarget" class="form-control">
		<option value="nope">No Target</option>
		<option value="_blank">_blank (New Window)</option>
		<option value="_self">_self</option>
		<option value="_parent">_parent</option>
		<option value="_top">_top</option>
	</select>
 	</div>

	<!--<div class="form-group">
	      <label for="afterText">Text After URL</label>
	      <textarea class="form-control" rows="5" id="afterText"></textarea>
   	 </div>-->
</div>

<div class="col-md-6">   
 <div class="form-group">
      <label for="newCode">HTML Code</label>
      <textarea class="form-control" rows="5" id="newCode"></textarea>
	  <button data-clipboard-target="newCode" class="btn btn-default frmbtn btn-copy" onclick="return false">Click To Copy</button>
<span class="span-message"></span>
    </div>
    <div class="form-group">
<button onclick="return convertURL()" class="btn btn-default frmbtn">Convert Text to HTML</button>



 </div>


<div class="form-group">
<button class="btn btn-default frmbtn btn-clear">Click To Clear</button>
 </div>
</div>
</div>
</div>
EOD;
}