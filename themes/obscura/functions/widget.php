<?php
add_action( 'widgets_init', 'example_load_widgets' );

function example_load_widgets() {
	register_widget( 'Example_Widget' );
}

class Example_Widget extends WP_Widget {

	
	function Example_Widget() {
		$widget_ops = array( 'classname' => 'example', 'description' => __('A widget that displays popular posts with or without thumbnail.', 'example') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'example-widget' );
		$this->WP_Widget( 'example-widget', __('Popular Posts (Obscura)', 'example'), $widget_ops, $control_ops );
	}

	
	function widget( $args, $instance ) {
		extract( $args );
		$show_thumbnail = isset( $instance['show_thumbnail'] ) ? $instance['show_thumbnail'] : false;
		
		echo $before_widget;
			
			if ( $show_thumbnail ) { ?>

			<h3 class="widget-title"><?php _e("Popular Posts", "elemis"); ?></h3>
			<ul class="post-list">
			  <?php $pc = new WP_Query('orderby=comment_count&posts_per_page=3'); ?>
			  <?php while ($pc->have_posts()) : $pc->the_post(); ?>
			  <li> 
			  	<?php if ( has_post_thumbnail() ) { ?>
					<div class="frame"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'list_thumb'); ?></a></div>
				<?php } ?>
			    <div class="meta">
				    <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
				    <em><?php the_time('jS M Y') ?></em>
			    </div>
			  </li>
			  <?php endwhile; ?>
			</ul>
			
			<?php } if ( ! $show_thumbnail ) { ?>
			
			<h3 class="widget-title"><?php _e("Popular Posts", "elemis"); ?></h3>
			<ul class="post-list">
				<?php $pc = new WP_Query('orderby=comment_count&posts_per_page=3'); ?>
				<?php while ($pc->have_posts()) : $pc->the_post(); ?>
				<li>
					<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
					<em><?php the_time('jS M Y') ?></em>
				</li>
				<?php endwhile; ?>
			</ul>
			<?php }

		echo $after_widget;
	}

	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['show_thumbnail'] = $new_instance['show_thumbnail'];

		return $instance;
	}

	
	function form( $instance ) {


		$defaults = array( 'title' => __('Example', 'example'), 'name' => __('John Doe', 'example'), 'thumbnail' => 'male', 'show_thumbnail' => true );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>


		<p>
		  <input class="checkbox" type="checkbox" <?php checked( (bool) $instance['show_thumbnail'], true ); ?> id="<?php echo $this->get_field_id( 'show_thumbnail' ); ?>" name="<?php echo $this->get_field_name( 'show_thumbnail' ); ?>" />
		  <label for="<?php echo $this->get_field_id( 'show_thumbnail' ); ?>">
		    <?php _e('Show thumbnails?', 'elemis'); ?>
		  </label>
		</p>
<?php
	}
}

?>