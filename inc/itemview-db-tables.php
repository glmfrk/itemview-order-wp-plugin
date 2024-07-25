<?php

function itemview_create_tables() {
  global $wpdb;

  $charset_collate = $wpdb->get_charset_collate();

  echo $charset_collate;

  $table1 = $wpdb->prefix . 'customer_details';

  $sql1 = "CREATE TABLE $table1 (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    name tinytext NOT NULL,
    phone varchar(15) NOT NULL,
    email varchar(50) NOT NULL,
    dob date DEFAULT '0000-00-00' NOT NULL,
    address text NOT NULL,
    PRIMARY KEY (id)
  ) $charset_collate;";

  $table2 = $wpdb->prefix . 'order_details';

  $sql2 = "CREATE TABLE $table2 (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    order_id mediumint(9) NOT NULL,
    product_id mediumint(9) NOT NULL,
    qty int NOT NULL,
    unit_price float NOT NULL,
    total_price float NOT NULL,
    PRIMARY KEY (id)
  ) $charset_collate;";

  $table3 = $wpdb->prefix . 'customer_orders';

  $sql3 = "CREATE TABLE $table3 (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    customer_id mediumint(9) NOT NULL,
    shipping_cost float NOT NULL,
    order_date datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    delivery_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (id)
  ) $charset_collate;";

  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  dbDelta($sql1);
  dbDelta($sql2);
  dbDelta($sql3);

}