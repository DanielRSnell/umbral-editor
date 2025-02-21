<?php
/**
 * Plugin Name: Umbral Editor
 * Description: Advanced template editor for WordPress
 * Version: 1.0.0
 */

if (! defined('ABSPATH')) {
    exit;
}

// Vendor
require_once __DIR__ . '/vendor/autoload.php';

// Initialize Timber.
Timber\Timber::init();

require_once __DIR__ . '/src/Artisan.php';
// require_once __DIR__ . '/src/Plugin.php';

// // Bootstrap the plugin
// add_action('plugins_loaded', function () {
//     \ArtisanEditor\Plugin::instance();
// });
