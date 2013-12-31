<!-- BEGIN CUSTOM COLORS (WP THEME CUSTOMIZER) -->
<?php $bonfire_header_background = get_option('bonfire_header_background'); ?>
<?php $bonfire_logo_color = get_option('bonfire_logo_color'); ?>
<?php $bonfire_logo_hover_color = get_option('bonfire_logo_hover_color'); ?>
<?php $bonfire_title_color = get_option('bonfire_title_color'); ?>
<?php $bonfire_title_hover_color = get_option('bonfire_title_hover_color'); ?>
<?php $bonfire_link_color = get_option('bonfire_link_color'); ?>
<?php $bonfire_link_hover_color = get_option('bonfire_link_hover_color'); ?>
<?php $bonfire_commentform_background_color = get_option('bonfire_commentform_background_color'); ?>
<?php $bonfire_commentform_button_color = get_option('bonfire_commentform_button_color'); ?>
<?php $bonfire_readleave_comments = get_option('bonfire_readleave_comments'); ?>
<?php $bonfire_readleave_comments_hover = get_option('bonfire_readleave_comments_hover'); ?>
<?php $bonfire_authordate = get_option('bonfire_authordate'); ?>
<?php $bonfire_authordate_hover = get_option('bonfire_authordate_hover'); ?>
<?php $bonfire_tags = get_option('bonfire_tags'); ?>
<?php $bonfire_tags_hover = get_option('bonfire_tags_hover'); ?>
<?php $bonfire_footer_background_color = get_option('bonfire_footer_background_color'); ?>
<?php $bonfire_commentarea_background_color = get_option('bonfire_commentarea_background_color'); ?>
<?php $bonfire_contactform_background_color = get_option('bonfire_contactform_background_color'); ?>
<?php $bonfire_contactform_button_color = get_option('bonfire_contactform_button_color'); ?>
<?php $bonfire_menu_button_background_color = get_option('bonfire_menu_button_background_color'); ?>
<?php $bonfire_menu_button_background_hover = get_option('bonfire_menu_button_background_hover'); ?>
<style>
#header-wrapper { background-color:<?php echo $bonfire_header_background; ?>; }
.site-logo, .site-logo a { color:<?php echo $bonfire_logo_color; ?>; }
.menu-button:hover .site-logo, .menu-button:hover .site-logo a { color:<?php echo $bonfire_logo_hover_color; ?>; }

.post-title, .page-title, .post-title a, .page-title a, .light .post-title, .light .page-title, .light .post-title a, .light .page-title a, .lighter .post-title, .lighter .page-title, .lighter .post-title a, .lighter .page-title a { color:<?php echo $bonfire_title_color; ?>; }
.post-title a:hover, .page-title a:hover, .light .post-title a:hover, .light .page-title a:hover, .lighter .post-title a:hover, .lighter .page-title a:hover { color:<?php echo $bonfire_title_hover_color; ?>; }

.entry-content a { color:<?php echo $bonfire_link_color; ?>; }
.entry-content a:hover { color:<?php echo $bonfire_link_hover_color; ?>; }

#respond, #respond #cancel-comment-reply-link { background-color:<?php echo $bonfire_commentform_background_color; ?>; }
#respond #submit { background-color:<?php echo $bonfire_commentform_button_color; ?>; }

.read-leave-comments { color:<?php echo $bonfire_readleave_comments; ?>; border-color:<?php echo $bonfire_readleave_comments; ?>; }
.read-leave-comments:hover { background-color:<?php echo $bonfire_readleave_comments_hover; ?> !important; border-color:<?php echo $bonfire_readleave_comments_hover; ?> !important; }

.post-meta-author-date { color:<?php echo $bonfire_authordate; ?>; border-color:<?php echo $bonfire_authordate; ?>; }
.post-meta-author-date:hover { background-color:<?php echo $bonfire_authordate_hover; ?>; border-color:<?php echo $bonfire_authordate_hover; ?>; }

.post-meta-tags { color:<?php echo $bonfire_tags; ?>; border-color:<?php echo $bonfire_tags; ?>; }
.post-meta-tags:hover { background-color:<?php echo $bonfire_tags_hover; ?>; border-color:<?php echo $bonfire_tags_hover; ?>; }

#footer { background-color:<?php echo $bonfire_footer_background_color; ?>; }

.commentwrap { background-color:<?php echo $bonfire_commentarea_background_color; ?>; }

#contactform-wrapper { background-color:<?php echo $bonfire_contactform_background_color; ?>; }
#contact-submit { background-color:<?php echo $bonfire_contactform_button_color; ?>; }

.menu-button { background-color:<?php echo $bonfire_menu_button_background_color; ?>; }
.menu-button-hover-touch, .menu-button-hover { background-color:<?php echo $bonfire_menu_button_background_hover; ?> !important; }

</style>
<!-- END CUSTOM COLORS (WP THEME CUSTOMIZER) -->