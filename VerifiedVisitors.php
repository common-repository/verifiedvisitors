<?php

namespace VerifiedVisitors;

/**
 * @package VerifiedVisitors
 * @version 1.1.2
 *
 * Plugin Name: VerifiedVisitors
 * Description: WordPress access control integration for VerifiedVisitors.
 * Tags: Bots, security, firewall, bot mitigation, Account Takeover, protection, bot management, API endpoint protection, credit card gateway protection, payment gateway protection, ATO
 * Author: VerifiedVisitors
 * Author URI: https://www.verifiedvisitors.com/
 * Version: 1.1.2
 * Stable tag: 1.1.2
 * Requires at least: 4.9
 * Requires PHP: 7.2
 * Tested up to: 6.4
 * License: GPLv3 or later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 */

// Make sure we don't expose any info if called directly
if (!function_exists('add_action')) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

define('VERIFIED_VISITORS_PLUGIN_DIR', plugin_dir_path(__FILE__));

require_once(VERIFIED_VISITORS_PLUGIN_DIR . 'class.config.php');
require_once(VERIFIED_VISITORS_PLUGIN_DIR . 'models/class.visitor-id.php');
require_once(VERIFIED_VISITORS_PLUGIN_DIR . 'models/class.worker.php');
require_once(VERIFIED_VISITORS_PLUGIN_DIR . 'models/class.vac-request.php');
require_once(VERIFIED_VISITORS_PLUGIN_DIR . 'models/class.vac-response.php');
require_once(VERIFIED_VISITORS_PLUGIN_DIR . 'utils/class.cookie-utils.php');
require_once(VERIFIED_VISITORS_PLUGIN_DIR . 'utils/class.request-utils.php');
require_once(VERIFIED_VISITORS_PLUGIN_DIR . 'utils/class.validate-utils.php');
require_once(VERIFIED_VISITORS_PLUGIN_DIR . 'utils/class.string-utils.php');
require_once(VERIFIED_VISITORS_PLUGIN_DIR . 'class.vac.php');
require_once(VERIFIED_VISITORS_PLUGIN_DIR . 'class.admin.php');
require_once(VERIFIED_VISITORS_PLUGIN_DIR . 'class.fingerprint.php');

define('VERIFIED_VISITORS_VERSION', Config::VERSION);

$vac = new VAC();
add_action('init', array($vac, 'check'), 0);

$fingerprint = new Fingerprint();
add_action('wp_enqueue_scripts', array($fingerprint, 'enqueue_scripts'));

if (is_admin()) {
    $admin = new Admin();
    add_action('init', array($admin, 'init'), 0);
    register_uninstall_hook(__FILE__, array($admin, 'uninstall'), 0);
}
