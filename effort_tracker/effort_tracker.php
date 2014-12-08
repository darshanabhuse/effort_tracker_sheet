<?php 
    /*
    Plugin Name: Effort Tracker Sheet
    Plugin URI: http://www.google.com   
    Description: Plugin for displaying tweets for a profile
    Author: Darshana Bhuse
    Version: 1.0
    Author URI: http://www.webemps.
    */
//add_action('get_template_part_content','twitter_block');
function wps_effort_tracker_page () {
    include('effort_tracker_admin.php');  
}
function wps_effort_tracker () {
add_menu_page('Wps Admin', 'Effort Tracker Sheet', 'manage_options', 'wps_effort_tracker', 'wps_effort_tracker_page');
}
add_action('admin_menu','Wps_effort_tracker');
/* Database table create.  */
include('database.php');
register_activation_hook( __FILE__, 'effort_tracker_table_create');
//include('database.php');
//register_activation_hook( __FILE__, 'twitter_table_create' );
///*================================== Site FE ============================================*/ 
//function Cust_Twitter_Block($para = array()){
//  extract(shortcode_atts(array(  
//  'id' => '1'    
// ), $para));
//  global $wpdb, $blog_id;
//  //echo $id;
//  $fetch = "SELECT * from " . $wpdb->prefix . "twitter_block WHERE id = " . $id;
//  $myferows = $wpdb->get_results($fetch);  
//  //print_r($myferows);
//  $count = $myferows[0]->count ;
//  $width = $myferows[0]->width;
//  $height = $myferows[0]->height;
//  $profile = $myferows[0]->profile;
//  $block_back = $myferows[0]->block_back_color;
//  $block_text = $myferows[0]->block_text_color;
//  $tweet_back = $myferows[0]->tweet_back_color;
//  $tweet_text = $myferows[0]->tweet_text_color;
//  $link = $myferows[0]->link_color;
//  echo '<script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>';
//  $html.="
//                  <script>
//                  new TWTR.Widget({
//                    version: 2,
//                    type: 'profile',
//                    rpp: ".$count.",
//                    interval: 30000,
//                    width: ".$width.",
//                    height: ".$height.",
//                    theme: {
//                      shell: {
//                        background: '".$block_back."',
//                        color: '".$block_text."'
//                      },
//                      tweets: {
//                        background: '".$tweet_back."',
//                        color: '".$tweet_text."',
//                        links: '".$link."'
//                      }
//                    },
//                    features: {
//                      scrollbar: false,
//                      loop: false,
//                      live: false,
//                      behavior: 'all'
//                    }
//                  }).render().setUser('".$profile."').start();
//                  </script>";
//  echo $html;
//}
//add_shortcode('cust_twitter_block', 'Cust_Twitter_Block');
