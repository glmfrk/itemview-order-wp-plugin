<?php
/*
 * Plugin Name:       Order Chart Item View
 * Plugin URI:        https://github.com/glmfrk/eorder-item-view
 * Description:       This plugin manages an online shopping cart, updating totals in real-time. It captures items, shipping costs, and user information via AJAX.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Gulam Faruk
 * Author URI:        https://facebook.com/gulamfrk
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       itemview
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// post type require file

if (file_exists(__DIR__ . '/inc/itemview-post-type.php')) {
  require_once __DIR__ . '/inc/itemview-post-type.php';
}

// database tables creations
if (file_exists(__DIR__ . '/inc/itemview-db-tables.php')) {
  require_once __DIR__ . '/inc/itemview-db-tables.php';
}


// AJAX form submission
// if (file_exists(__DIR__ . '/inc/handle-ajax-submit.php')) {
//   require_once __DIR__ . '/inc/handle-ajax-submit.php';
// }


// generate html file shortcode
if (file_exists(__DIR__ . '/order-form.php')) {
  require_once __DIR__ . '/order-form.php';
}

// Activation hook
function itemview_activate() {
  // Register the post type and create tables on activation
  register_itemview_post_type();
  itemview_create_tables();
  // itemview_submit_order();

  // Flush rewrite rules to ensure the custom post type rewrite rules are added
  flush_rewrite_rules();
}

// Deactivation hook
function itemview_deactivate() {
  // Flush rewrite rules to remove the custom post type rewrite rules
  flush_rewrite_rules();
}

// Register activation and deactivation hooks
register_activation_hook(__FILE__, 'itemview_activate');
register_deactivation_hook(__FILE__, 'itemview_deactivate');

// Register the custom post type
add_action('init', 'register_itemview_post_type', 0);