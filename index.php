<?php
/**
 * @package importdennis
 * @version 0.0.1
 */
/*
Plugin Name: Import Users Development Plugin
Plugin URI: github.com/egempiu
Description: Plugin developed to import users from DENNISDB to Wordpress.
Version: 0.8.1
Author URI: github.com/egempiu
*/

// If it doesn't exist, let's create it.
// Register settings using the Settings API
add_action('admin_menu', 'custom_menu');
function custom_menu() {
  add_menu_page(
      'Import users from Users to Wordpress',
      'Import Users to Wordpress',
      'administrator',
      'importdennis',
      'index_callback',
      'dashicons-database'
     );
}

function index_callback() {
  if (is_admin() ) {
      // we are in admin mode
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
      require_once __DIR__ . '/classes.php';
      require_once __DIR__ . '/templates/index.php';
      if(!$_POST) {
      require_once __DIR__ . '/templates/form.php';
      }
        else {
          $formdb = new importdb;
          $users = $formdb->get_users($_POST);
          echo '<div style="overflow:scroll; border:1px solid #000; margin-top:30px; width:50%; height:300px;">';
          $formdb->create_userswp($users);
          echo "</div>";
          // code...



        }

  }

}
