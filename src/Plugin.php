<?php
namespace ArtisanEditor;

class Plugin
{
    private static $instance = null;

    public static function instance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
        // Initialize plugin
        add_action('plugins_loaded', [$this, 'init']);
    }

    public function init()
    {
        // Initialize components even if Timber isn't active
        Admin::instance();
        Frontend::instance();

        // Check for Timber after components are loaded
        if (! class_exists('Timber\Timber')) {
            add_action('admin_notices', [$this, 'timber_missing_notice']);
            return;
        }

        \Timber\Timber::init();
    }

    public function timber_missing_notice()
    {
        echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin.</p></div>';
    }
}
