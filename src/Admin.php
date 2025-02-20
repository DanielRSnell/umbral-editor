<?php
namespace ArtisanEditor;

class Admin {
  private static $instance = null;

  public static function instance() {
    if (null === self::$instance) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  private function __construct() {
    add_action('admin_menu', [$this, 'add_admin_menu']);
  }

  public function add_admin_menu() {
    // Add your admin menu items here
  }
}
