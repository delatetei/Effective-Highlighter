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

  if (!function_exists('initialize_tinymce_styles')):
  function initialize_tinymce_styles($init_array) {
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
  endif;
  add_filter('tiny_mce_before_init', 'initialize_tinymce_styles', 10000);
  
  if ( !function_exists( 'add_styles_to_tinymce_buttons' ) ):
  function add_styles_to_tinymce_buttons($buttons) {
    $temp = array_shift($buttons);
    array_unshift($buttons, 'styleselect');
    array_unshift($buttons, $temp);
  
    return $buttons;
  }
  endif;
  add_filter('mce_buttons_2','add_styles_to_tinymce_buttons');
    
/* -*- coding: utf-8-unix -*- */
// vim: et fenc=utf-8 ff=unix sw=2 ts=2 sts=2

