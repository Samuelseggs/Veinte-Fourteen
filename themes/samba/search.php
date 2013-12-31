<?php 
	get_header(); 
	$show_sidebar=$prk_samba_frontend_options['right_sidebar'];
	if ($show_sidebar=="yes")
		$show_sidebar=true;
	else
		$show_sidebar=false;
?>
<div id="centered_block" class="prk_inner_block columns centered main_no_sections">
<div id="main_block" class="row">
  <div id="headings_wrap" data-img="no" class="bd_headings_text_shadow zero_color">
    <div class="prk_inner_block extra_pad centered twelve columns">
          <div class="single_page_title twelve columns">
            <h1 class="header_font">
                <?php 
                if (!have_posts()) 
                  { 
                    echo($prk_translations['submit_search_no_results'] );
                    echo '<span class="zero_color bd_headings_text_shadow"> "'.get_search_query().'"</span>';
                  }
                  else
                  {
                    echo($prk_translations['submit_search_res_title']);
                    echo '<span class="zero_color bd_headings_text_shadow"> "'.get_search_query().'"</span>';
                  }  
              ?>                    
            </h1>
                          </div>
          <div class="clearfix"></div>
        </div>
    </div>
    <div id="content">
        <div id="main" role="main" class="main_no_sections">
        	<?php
              if ($show_sidebar)
              {
                echo '<div class="twelve columns sidebarized">';
              }
              else
              {
                echo '<div class="twelve columns">';
              }
        echo '<ul id="search_ul">';
			 	while (have_posts()) : the_post(); 
				?>
            	<li id="post-<?php the_ID(); ?>" <?php post_class('prk_search_res'); ?>>
                <div class="prk_titlify_father">
              		<h3 class="header_font zero_color small">
                    	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                     </h3>
                   </div>
                		<?php //roots_entry_meta(); ?>
              		<div class="entry-content">
                		<?php if (is_archive() || is_search()) { ?>
                  		<?php echo the_excerpt_dynamic(64);
      								?>
      								  <div class="theme_button small">
      									  <a href="<?php the_permalink() ?>"><?php echo($prk_translations['read_more']); ?></a>
      								  </div>
                		<?php } else { ?>
                  		<?php the_content(); ?>
                		<?php } ?>
              		</div>
            	</li>
                
        	<?php endwhile; /* End loop */ ?>
        </ul>
            <div class="clearfix"></div>
            </div>
           <?php 
              if ($show_sidebar) 
              {
                  ?>
                  
                <aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?> inside right_floated zero_right" role="complementary">
                    <?php get_sidebar(); ?>
                </aside><!-- #sidebar -->
                <?php
              }
            ?>
            <div class="clearfix"></div>
          </div>
          
        </div><!-- /#main -->
    </div><!-- /#content -->
</div><!-- #main_block -->
</div>
	<?php get_footer(); ?>