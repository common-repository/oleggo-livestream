<?php
/*
Plugin Name: Oleggo LiveStream
Plugin URI: http://www.oleggo.com/oleggo-livestream/
Description: A plugin for livestream interaction. In a simple few steps you can create a page with VideoStreaming (uStream, Youtube, Vimeo, etc...), Twitter conversationd and Facebook conversation.
Author: Oleggo Software Development
Version: 0.2.6
Author URI: http://www.oleggo.com
*/

/*  Copyright 2009  Oleggo Software  (email : contact@oleggo.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

$OLEGGO_LIVESTREAM_URI = get_settings('home').'/wp-content/plugins/oleggo-livestream';

$OLEGGO_LIVESTREAM_CUSTOMTAG = '[oleggo-livestream]';

function print_livestream_plugin($content) {
    global $OLEGGO_LIVESTREAM_CUSTOMTAG;
    ob_start();
    get_livestream_box();
    $liveStream = ob_get_contents();
    ob_end_clean(); 
	
    $content_b=str_ireplace($OLEGGO_LIVESTREAM_CUSTOMTAG,$liveStream,$content);
    return $content_b;
}
add_filter('the_content', 'print_livestream_plugin');

function get_livestream_box() {
  echo '<div id="oleggo-livestream-page">';
    get_video_livestream_box();
    get_twitter_livestream_box();
	get_facebook_livestream_box();
	get_oleggo_signature();
  echo '</div>';
}

function get_oleggo_signature() {
    global $OLEGGO_LIVESTREAM_URI;
	echo '<div id="oleggo-signature">';
	echo '<a href="http://www.oleggo.com"><img src="'.$OLEGGO_LIVESTREAM_URI.'/logo.gif" height="19" width="16" alt="Oleggo Software Develpment"/></a>';
	echo '<span class="text-signature">by <a href="http://www.oleggo.com">Oleggo Software Development</a><span>';
	echo '</div>';
}

function get_facebook_livestream_box() {
  if ( get_option('facebook_active') == 'true' ) {
    echo '<div id="oleggo-livestream-facebookconnect" class="oleggo-livestream-box"><iframe src="http://www.facebook.com/widgets/livefeed.php?app_id=' . get_option('facebook_app_id') . "&width=" . get_option('facebook_box_width') . '&height=' . get_option('facebook_box_height') . '&xid=' .  get_option('facebook_xid') . '" width="' . get_option('facebook_box_width') . '" height="' . get_option('facebook_box_height') . '" marginwidth="0" scrolling="no" frameborder="0"></iframe></div>';
  }
}

function get_video_livestream_box() {
  if ( get_option('video_active') == 'true' ) {
    echo '<div id="oleggo-livestream-video" class="oleggo-livestream-box">' . get_option('video_embed') . '</div>';
  }
}

function get_twitter_livestream_box() {
  global $OLEGGO_LIVESTREAM_URI;
  if ( get_option('twitter_active') == 'true' ) {
    echo '<div id="oleggo-livestream-twitter" class="oleggo-livestream-box">';
	$t_search = get_option('twitter_search');
	$t_refresh = get_option('twitter_refresh');
	$t_width = get_option('twitter_width');
    $t_height = get_option('twitter_height');
    $t_tweetbegin = get_option('twitter_tweetbegin');
	include 'oleggo-twitter.php';	
    echo '</div>';	
  }
}

function get_livestream_box_head() {
    global $OLEGGO_LIVESTREAM_URI;
    echo "\n".'<script type="text/javascript" src="'.$OLEGGO_LIVESTREAM_URI.'/js/prototype.js" ></script>';
	echo "\n".'<link rel="stylesheet" href="'.$OLEGGO_LIVESTREAM_URI.'/css/style.css" type="text/css" media="screen" title="no title" charset="utf-8">';
}
add_action('wp_head', 'get_livestream_box_head');

function get_twitter_livestream_box_head() {
    global $OLEGGO_LIVESTREAM_URI;
    if ( get_option('twitter_active') == 'true' ) {
	    echo "\n".'<script type="text/javascript" src="'.$OLEGGO_LIVESTREAM_URI.'/oleggo-twitter/js/twitter.js?version=1.1" ></script>';
		echo "\n".'<link rel="stylesheet" href="'.$OLEGGO_LIVESTREAM_URI.'/oleggo-twitter/css/style.css" type="text/css" media="screen" title="no title" charset="utf-8">';
	}
}
add_action('wp_head', 'get_twitter_livestream_box_head');

function get_twitter_livestream_box_foot() {
	if ( get_option('twitter_active') == 'true' ) {
		global $OLEGGO_LIVESTREAM_URI;
		$t_search = get_option('twitter_search');
		$t_refresh = get_option('twitter_refresh');
		$t_width = get_option('twitter_width');
		$t_height = get_option('twitter_height');
		$t_tweetbegin = get_option('twitter_tweetbegin');
		include 'oleggo-twitter/oleggo-twitter-script.php';	
	}
}
add_action('wp_footer', 'get_twitter_livestream_box_foot');

function oleggosocial_init() {
  if ( is_admin() ){ // admin actions
    add_action( 'admin_menu', 'oleggo_admin_menu' );
    add_action( 'admin_init', 'register_oleggosettings' );
	if ( get_option('oleggosettings_default_init') != 'true' ) {
		update_option('twitter_active', 'true');
		update_option('twitter_search', 'oleggo');
		update_option('twitter_refresh', '30');
		update_option('twitter_width', '365');
		update_option('twitter_height', '500');
		update_option('twitter_tweetbegin', '#oleggo');
		update_option('facebook_active', 'true');
		update_option('facebook_app_id', '139803203918');
		update_option('facebook_xid', 'oleggo');
		update_option('facebook_box_width', '365');
		update_option('facebook_box_height', '500');	
		
		update_option('oleggosettings_default_init', 'true');
	}
  } 
}
add_action('init', 'oleggosocial_init');

function oleggo_admin_menu() {
    add_options_page('Oleggo LiveStream Settings', 'Oleggo LiveStream', 8, 'oleggo-livestream-settings', 'printOleggoLSOptionsPage');
}

function printOleggoLSOptionsPage() {
    include ("oleggo-options.php");
}

function register_oleggosettings() {
  register_setting( 'oleggo-settings', 'video_active' );  
  register_setting( 'oleggo-settings', 'video_embed' );
  register_setting( 'oleggo-settings', 'twitter_active' );
  register_setting( 'oleggo-settings', 'twitter_search' );
  register_setting( 'oleggo-settings', 'twitter_refresh' );
  register_setting( 'oleggo-settings', 'twitter_width' );
  register_setting( 'oleggo-settings', 'twitter_height' );
  register_setting( 'oleggo-settings', 'twitter_tweetbegin' );
  register_setting( 'oleggo-settings', 'facebook_active' );  
  register_setting( 'oleggo-settings', 'facebook_app_id' );   
  register_setting( 'oleggo-settings', 'facebook_xid' );  
  register_setting( 'oleggo-settings', 'facebook_box_height' );  
  register_setting( 'oleggo-settings', 'facebook_box_width' );
}

if (!isset($_SESSION)) {
  session_start();
}

?>