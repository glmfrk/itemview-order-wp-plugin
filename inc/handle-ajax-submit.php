<?php
// Hook to handle form submission via AJAX
add_action('wp_ajax_nopriv_itemview_handle_order', 'itemview_handle_order');
add_action('wp_ajax_itemview_handle_order', 'itemview_handle_order');

function itemview_handle_order(){
  global $wpdb;

  // Check if required fields are set
  if (!isset($_POST['userName'], $_POST['userPhone'], $_POST['userEmail'], $_POST['userAddress'], $_POST['shippingCost'], $_POST['items'])) {
    wp_send_json_error(array('message' => 'Missing required fields.'));
    return;
  }

  // Sanitize and retrieve form data
  $customer_name = sanitize_text_field( $_POST['userName'] );
  $customer_phone = sanitize_text_field( $_POST['userPhone'] );
  $customer_email = sanitize_email( $_POST['userEmail'] );
  $customer_address = sanitize_text_field( $_POST['userAddress'] );
  $shipping_cost = floatval($_POST['shippingCost']);
  $items = json_decode(stripslashes($_POST['items']), true);

  if (!$items) {
    wp_send_json_error(array('message' => 'Invalid items data.'));
    return;
  }

  // Insert customer details
  $wpdb->insert(
    $wpdb->prefix . 'customer_details',
    array(
      'name' => $customer_name,
      'phone' => $customer_phone,
      'email' => $customer_email,
      'address' => $customer_address,
    )
  );
  $customer_id = $wpdb->insert_id;

  // Insert order
  $wpdb->insert(
    $wpdb->prefix . 'customer_orders',
    array(
        'customer_id' => $customer_id,
        'shipping_cost' => $shipping_cost,
        'order_date' => current_time('mysql'),
        'delivery_date' => '',
    )
  );
  $order_id = $wpdb->insert_id;

  // Insert order items
  foreach ($items as $item) {
    $wpdb->insert(
        $wpdb->prefix . 'order_details',
        array(
            'order_id' => $order_id,
            'product_id' => intval($item['id']),
            'qty' => intval($item['quantity']),
            'unit_price' => floatval($item['price']),
            'total_price' => floatval($item['quantity']) * floatval($item['price']),
        )
    );
  }

   // Return response
   wp_send_json_success(array('message' => 'Order placed successfully!'));
}