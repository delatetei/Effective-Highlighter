<?php
  /*
  Plugin Name: Effective Highlighter
  Plugin URI: https://delatetei.net/effective_highlighter/
  Description: A plugin to add effective text highlight option to the WordPress editor.
  Version: 1.0
  Author: delatetei
  Author URI: https://delatetei.net/
  License: GPL2
  */

  $effectiveHighlighter = new Effective_Highlighter();
  
  class Effective_Highlighter {
    public function __construct() {
      if (function_exists('register_activation_hook')) {
        register_activation_hook(__FILE__, array(&$this, 'activationHook'));
      }
 
      if (function_exists('register_deactivation_hook')) {
        register_deactivation_hook(__FILE__, array(&$this, 'deactivationHook'));
      }
 
      if (function_exists('register_uninstall_hook')) {
        register_uninstall_hook(__FILE__, 'uninstallHook');
      }

      add_filter('tiny_mce_before_init', array(&$this, 'initialize_tinymce_styles'), 10000);
      add_filter('mce_buttons_2', array(&$this, 'add_styles_to_tinymce_buttons'));

      add_action('admin_init', array(&$this, 'add_editor_style'));
      add_action('wp_enqueue_scripts', array(&$this, 'add_style'));
    }
    
    public function activationHook() {
    }
    
    public function deactivationHook() {
    }

    public static function uninstallHook() {
    }

    public function initialize_tinymce_styles($init_array) {
      $style_formats = array(
        array(
          'title' => 'Effective Highlighter',
          'items' => array(
            array(
              'title' => 'pink',
              'inline' => 'strong',
              'classes' => 'effective-highlighter-pink'
            ),
            array(
              'title' => 'blue',
              'inline' => 'strong',
              'classes' => 'effective-highlighter-blue'
            ),
          )
        )
      );
      $init_array['style_formats'] = json_encode($style_formats);
      return $init_array;
    }
    
    public function add_styles_to_tinymce_buttons($buttons) {
      $temp = array_shift($buttons);
      array_unshift($buttons, 'styleselect');
      array_unshift($buttons, $temp);
    
      return $buttons;
    }

    public function add_editor_style() {
      add_editor_style(plugins_url('editor-style.css', __FILE__));
    }

    public function add_style() {
      wp_enqueue_style('effective_highlighter_style', plugins_url('style.css', __FILE__));
    }
  }
    
/* -*- coding: utf-8-unix -*- */
// vim: et fenc=utf-8 ff=unix sw=2 ts=2 sts=2

