<?php
/*
Plugin Name: WooStock : Stock / Inventory Report
Description: Display in the of wordpress admin, a table with the product name and variation, SKU and current Stock of Woo-Coomerce  products. It can also be used with the Shortcode "[woostock]", and displayed in a section of your site, to keep your distributors and/or users with updated information about your products.
Author: Efren Martinez Arteaga
Version: 1.0.1
Author URI: http://efren-martinez.pro/
Plugin URI: http://efren-martinez.pro/blog
*/
function woostock_panel(){      
      include('woostock.php');
   }
   function woostock_add_menu(){   
      if (function_exists('add_options_page')) {
         add_options_page('WooStock', 'WooStock', 8, basename(__FILE__), 'woostock_panel');
      }
   }
   if (function_exists('add_action')) {
      add_action('admin_menu', 'woostock_add_menu'); 
   } 
function woostock_report($atts) {
ob_start();
include(WP_CONTENT_DIR .'/plugins/woostock/woostock.php');
$content = ob_get_clean();
return $content;
}
add_shortcode('woostock', 'woostock_report');
?>