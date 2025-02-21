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
        // Hook into plugins_loaded to ensure WordPress is fully loaded
        add_action('plugins_loaded', [$this, 'init']);
    }

    public function init()
    {
        // Debug information
        error_log('Attempting to initialize ArtisanEditor Plugin');

        // Check if Timber class exists
        if (! class_exists('Timber\Timber')) {
            error_log('Timber class not found');
            add_action('admin_notices', [$this, 'timber_missing_notice']);
            return;
        }

        try {
            // Check if Timber is already initialized
            if (! \Timber\Timber::$instance) {
                error_log('Initializing new Timber instance');
                \Timber\Timber::init();
            } else {
                error_log('Timber already initialized');
            }

            // Initialize components after successful Timber init
            Admin::instance();
            Frontend::instance();

            error_log('ArtisanEditor Plugin initialized successfully');
        } catch (\Exception $e) {
            error_log('Timber initialization error: ' . $e->getMessage());
            add_action('admin_notices', [$this, 'timber_error_notice']);
        }
    }

    public function timber_missing_notice()
    {
        echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin or include it as a composer dependency.</p></div>';
    }

    public function timber_error_notice()
    {
        echo '<div class="error"><p>Error initializing Timber. Please check the error logs for more details.</p></div>';
    }
}
