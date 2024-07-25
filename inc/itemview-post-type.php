<?php

// Register item view post type
function register_itemview_post_type() {
  $labels = array(
      'name'                  => __( 'Products', 'itemview' ),
      'singular_name'         => __( 'Product', 'itemview' ),
      'menu_name'             => _x( 'Products', 'Admin Menu text', 'itemview' ),
      'name_admin_bar'        => _x( 'Products', 'Add New on Toolbar', 'itemview' ),
      'add_new'               => __( 'Add New', 'itemview' ),
      'add_new_item'          => __( 'Add New Product', 'itemview' ),
      'new_item'              => __( 'New Product', 'itemview' ),
      'edit_item'             => __( 'Edit Product', 'itemview' ),
      'view_item'             => __( 'View Product', 'itemview' ),
      'all_items'             => __( 'All Products', 'itemview' ),
  );

  $args = array(
      'labels'             => $labels,
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'query_var'          => true,
      'rewrite'            => array('slug' => 'item'),
      'capability_type'    => 'post',
      'has_archive'        => true,
      'hierarchical'       => false,
      'menu_position'      => null,
      'supports'           => array('title', 'editor', 'thumbnail'),
  );

  register_post_type('item_view', $args);
}
add_action('init', 'register_itemview_post_type');

// Add meta box for product rate
function add_product_list_itemview_meta_box() {
  add_meta_box(
      'product_list_itemview_meta_box',
      'Set Your Product Rate',
      'product_list_itemview_meta_box_callback',
      'item_view',
      'normal',
      'high'
  );
}
add_action('add_meta_boxes', 'add_product_list_itemview_meta_box');

// Meta box callback
function product_list_itemview_meta_box_callback($post) {
  wp_nonce_field('save_product_list_itemview_meta', 'product_list_itemview_meta_nonce');
  $price = get_post_meta($post->ID, '_price', true);

  echo '<label for="product_list_itemview_price">Add Price: </label>';
  echo '<input type="number" id="product_list_itemview_price" name="product_list_itemview_price" value="' . esc_attr($price) . '" />';
}

// Save meta fields
function save_product_list_itemview_meta($post_id) {
  if (!isset($_POST['product_list_itemview_meta_nonce']) || !wp_verify_nonce($_POST['product_list_itemview_meta_nonce'], 'save_product_list_itemview_meta')) {
      return;
  }

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
      return;
  }

  if (isset($_POST['post_type']) && 'item_view' == $_POST['post_type'] && !current_user_can('edit_post', $post_id)) {
      return;
  }

  if (isset($_POST['product_list_itemview_price'])) {
      $price = sanitize_text_field($_POST['product_list_itemview_price']);
      update_post_meta($post_id, '_price', $price);
  }
}
add_action('save_post', 'save_product_list_itemview_meta');