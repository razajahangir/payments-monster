<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


/**
 * Plugin Name: Payments Monster
 * Plugin URI: https://www.example.com/payments-monster
 * Description: A flexible and modular payment solution for WordPress with support for multiple payment gateways as add-ons.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://www.example.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: payments-monster
 */

/// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// Define the plugin's path and URL for easier access.
define('PAYMENTS_MONSTER_PATH', plugin_dir_path(__FILE__));
define('PAYMENTS_MONSTER_URL', plugin_dir_url(__FILE__));

// Require Composer's autoloader.
require_once PAYMENTS_MONSTER_PATH . 'vendor/autoload.php';

use PaymentsMonster\PaymentsMonster;

$paymentsMonster = PaymentsMonster::getInstance();

// $paymentsMonster->setup_admin();
