<?php
/*
Plugin Name: MS Local Dev
Plugin URI: http://konstruktors.com
Description: Enable Local Dev Environment for WordPress Multisite
Version: 0.1
Author: Kaspars Dambis
Author URI: http://konstruktors.com
*/

// See README for things you need to put in wp-config.php for this to work

add_filter( 'blog_option_siteurl', 'set_local_siteurl', 10, 2 );
add_filter( 'blog_option_home', 'set_local_siteurl', 10, 2 );
add_filter( 'option_siteurl', 'set_local_siteurl' );
add_filter( 'option_home', 'set_local_siteurl' );

function set_local_siteurl( $url, $blog_id = null ) {
	global $dev_sites, $current_blog;

	// Run on option_*
	if ( ! $blog_id && isset( $dev_sites[ $current_blog->blog_id ] ) )
		return 'http://' . $_SERVER['HTTP_HOST'] . PATH_CURRENT_SITE . $dev_sites[ $current_blog->blog_id ] . '/';

	// Run on blog_option_*
	if ( isset( $dev_sites[ $blog_id ] ) )
		return 'http://' . $_SERVER['HTTP_HOST'] . PATH_CURRENT_SITE . $dev_sites[ $blog_id ]; 

	return $url;
}


