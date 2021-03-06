<?php 
/**
 * The template for displaying pages
 *
 * @package personal-lite
 */

get_header(); ?>

<div <?php post_class( 'content-index single-solo container' ); ?>>
<?php the_post(); ?>
<div class="single-index">
<!-- show thumbnail image on top of post - On/Off through theme customizer -->
<?php if ( get_theme_mod('personal_lite_postthumb_options','enable') == 'enable' ): ?>
<?php if ( has_post_thumbnail() ) the_post_thumbnail('personal-index');?>
<?php endif; ?>
<div class="single-index-meta">
<div class="single-header"><h1><?php the_title(); ?></h1></div><!-- single-header -->
<div class="single-content"><?php the_content(); ?></div><!-- single-content -->
<div class="single-tags clearfix"><?php the_tags('<span>'.__( 'Tags : ', 'personal-lite' ).'</span>',''); ?></div><!-- single-tags -->
 <?php wp_link_pages(); ?> 
<hr>
<!-- navigation links at end of every post -->
<?php if ( get_theme_mod('personal_lite_post_link','enable') == 'enable' ): ?>
<div class="single-postnav clearfix">
	<div class="row">
	<div class="next-post col-md-6 col-sm-6 col-xs-6"><?php next_post_link( '<i class="fa fa-chevron-circle-left"></i> %link'); ?></div><!-- next-post -->
	<div class="previous-post col-md-6 col-sm-6 col-xs-6"><?php previous_post_link( '%link <i class="fa fa-chevron-circle-right"></i>'); ?></div><!-- previous-post -->
	</div><!-- row -->
</div><!-- single-postnav -->
<hr>
<?php endif; ?>
<?php comments_template(); ?>
</div><!-- single-index-meta -->
</div><!-- single-index -->
</div><!-- content-index -->

<?php get_footer(); ?>