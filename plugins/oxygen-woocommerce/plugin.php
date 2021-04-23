<?php

/*
Plugin Name: Oxygen Elements for WooCommerce
Author: Soflyy
Author URI: https://oxygenbuilder.com
Description: Build beautiful WooCommerce websites.
Version: 1.4
*/

require_once("admin/includes/updater/edd-updater.php");
define("CT_OXYGEN_WOOCOMMERCE_VERSION",   "1.4");

add_action('plugins_loaded', 'oxygen_woocommerce_init');
function oxygen_woocommerce_init()
{

  // check if WooCommerce installed and active
  if (!class_exists('WooCommerce')) {
    return;
  }

  // check if Oxygen installed and active
  if (!class_exists('OxygenElement')) {
    return;
  }

  define("OXY_WOO_ASSETS_PATH", plugins_url("elements/assets", __FILE__));

  require_once('OxyWooEl.php');
  require_once('OxyWooCommerce.php');

  $OxyWooCommerce = new OxyWooCommerce();
}
