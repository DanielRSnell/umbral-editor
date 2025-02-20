<?php
namespace ArtisanEditor;

class Frontend {
  private static $instance = null;

  public static function instance() {
    if (null === self::$instance) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  private function __construct() {
    add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
  }

  public function enqueue_scripts() {
    // Add your frontend scripts/styles here
  }
}
