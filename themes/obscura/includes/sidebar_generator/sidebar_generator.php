<?php

class Sidebar_Generator
{
	protected $sidebar = false;
	
	public function __construct()
	{
		add_action('widgets_init', array(&$this, 'widgets_init'));
		add_action('admin_init', array(&$this, 'admin_init'));
		add_action('admin_menu', array(&$this, 'admin_menu'));
		
		add_action('wp_ajax_sidebar_generator_add', array(&$this, 'sidebar_form'));
		add_action('wp_ajax_sidebar_generator_add_submit', array(&$this, 'sidebar_form_submit'));
		add_action('wp_ajax_sidebar_generator_remove', array(&$this, 'sidebar_remove'));
		add_action('wp_ajax_sidebar_generator_list', array(&$this, 'sidebar_list'));
		
		add_action('save_post', array(&$this, 'save_post'));
		
		$this->sidebar = $this->get_sidebars();
	}
	
	public function dynamic_sidebar( $id )
	{
		global $post;
		$replace = get_post_meta($post->ID, '_sidebar_'.$id, true);
		if ( $replace && $this->sidebar_exists($replace) )
			return dynamic_sidebar($replace);
		return dynamic_sidebar($id);
	}
	
	public function is_active_sidebar( $id )
	{
		global $post;
		$replace = get_post_meta($post->ID, '_sidebar_'.$id, true);
		if ( $replace && $this->sidebar_exists($replace) )
			return is_active_sidebar($replace);
		return is_active_sidebar($id);
	}
	
	public function get_sidebars()
	{
		if ( $this->sidebar === false )
			return get_option('sidebar_generator_sidebar');
		return $this->sidebar;
	}
	
	public function add_sidebar( $sidebar )
	{
		if ( ! is_array($this->sidebar) )
			$this->sidebar = array();
		$this->sidebar[] = $sidebar;
		update_option('sidebar_generator_sidebar', $this->sidebar);
	}
	
	public function remove_sidebar( $slug )
	{
		foreach ( (array)$this->sidebar as $i => $sidebar )
		{
			if ( $sidebar['slug'] == $slug )
				unset($this->sidebar[$i]);
		}
		$this->sidebar = array_merge($this->sidebar);
		update_option('sidebar_generator_sidebar', $this->sidebar);
	}

	public function sidebar_exists( $slug )
	{
		foreach ( (array)$this->sidebar as $i => $sidebar )
		{
			if ( $sidebar['slug'] == $slug )
				return true;
		}
		return false;
	}
	
	public function widgets_init()
	{
		foreach ( (array)$this->sidebar as $i => $sidebar )
		{
			if ( ! is_array($sidebar) )
				continue;
			register_sidebar( array(
				'name' => $sidebar['name'],
				'id' => $sidebar['slug'],
		'before_widget' => '<div id="%1$s" class="sidebox widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
			) );
		}
	}
	
	public function admin_init()
	{
		if ( $_GET['page'] == 'sidebar_generator' )
		{
			wp_enqueue_style('thickbox');
			wp_enqueue_script('thickbox');
		}
		
		add_meta_box('sidebar_generator', __("Sidebar", 'elemis'), array(&$this, 'metabox'), 'post', 'side', 'high');
		add_meta_box('sidebar_generator', __("Sidebar", 'elemis'), array(&$this, 'metabox'), 'page', 'side', 'high');
	}
	
	public function admin_menu()
	{
		add_theme_page(__("Sidebar Generator", 'elemis'), __("Sidebar Generator", 'elemis'), 'edit_themes', 'sidebar_generator', array(&$this, 'option_page'));
	}
	
	
	public function option_page()
	{
		include get_template_directory().'/includes/sidebar_generator/option_page.php';
	}
	
	public function metabox()
	{
		include get_template_directory().'/includes/sidebar_generator/metabox.php';
	}
	
	public function save_post( $post_id )
	{
  		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
    		return $post_id;
    	if ( ! current_user_can( 'edit_post', $post_id ) )
      		return $post_id;
		if ( ! wp_verify_nonce($_POST['sidebar_generator_nonce'], 'sidebar_generator_save_post') )
			return $post_id;
		$sidebar = (array)$_POST['sidebar'];
		foreach ( $sidebar as $default => $replace )
		{
			update_post_meta($post_id, '_sidebar_'.$default, $replace);
		}
	}
	
	public function sidebar_list()
	{
		if ( $_REQUEST['action'] == 'sidebar_generator_list' && ! wp_verify_nonce($_REQUEST['nonce'], 'sidebar_generator_list') )
			die("-1");
		
		include get_template_directory().'/includes/sidebar_generator/sidebar_list.php';
		
		if ( $_REQUEST['action'] )
			exit;
	}
	
	public function sidebar_form()
	{
		include get_template_directory().'/includes/sidebar_generator/sidebar_form.php';
		exit;
	}
	
	public function sidebar_form_submit()
	{
		if ( ! wp_verify_nonce($_POST['nonce'], 'sidebar_generator_add') )
			die("-1");
		$new_sidebar = array(
			'slug' => sanitize_title_with_dashes($_POST['name']),
			'name' => sanitize_text_field($_POST['name']),
			'class' => sanitize_text_field($_POST['class'])
		);
		if ( $this->sidebar_exists($new_sidebar['slug']) )
			die("-2");
		$this->add_sidebar($new_sidebar);
	}
	
	public function sidebar_remove()
	{
		if ( ! wp_verify_nonce($_REQUEST['nonce'], 'sidebar_generator_remove') )
			die("-1");
		$slug = sanitize_text_field($_REQUEST['slug']);
		$this->remove_sidebar($slug);
	}
	
	
	
}

$sidebar_generator = new Sidebar_Generator;



function sg_dynamic_sidebar( $id )
{
	global $sidebar_generator;
	return $sidebar_generator->dynamic_sidebar($id);
}

function sg_is_active_sidebar( $id )
{
	global $sidebar_generator;
	return $sidebar_generator->is_active_sidebar($id);
}



