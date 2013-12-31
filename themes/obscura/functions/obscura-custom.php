<?php
/* Custom Post Type Fullscreen */
add_action('init', 'fullscreen_type');
function fullscreen_type() 
{
  $labels = array(
    'name' => _x('Fullscreen', 'post type general name', 'elemis'),
    'singular_name' => _x('Fullscreen', 'post type singular name', 'elemis'),
    'add_new' => _x('Add New', 'fullscreen', 'elemis'),
    'add_new_item' => __('Add New Gallery', 'elemis'),
    'edit_item' => __('Edit Gallery', 'elemis'),
    'new_item' => __('New Gallery', 'elemis'),
    'view_item' => __('View Gallery', 'elemis'),
    'search_items' => __('Search Fullscreen', 'elemis'),
    'not_found' =>  __('No Galleries found', 'elemis'),
    'not_found_in_trash' => __('No Galleries found in Trash', 'elemis'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'supports' => array('title','editor','author','thumbnail','revisions')
  ); 
  register_post_type('Fullscreen',$args);
  flush_rewrite_rules( false );
}
?>