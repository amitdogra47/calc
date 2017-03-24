<?php 
/**
 * The template for displaying author pages
 *
 * @package personal-lite
 */

get_header(); ?>

<div class="content-index container">
<?php if ( have_posts() ) : ?>
<?php /* Show author name as title */ ?>
<div class="archive-head">
<h1><?php the_archive_title(); ?></h1>
</div>
<?php while ( have_posts() ) : the_post(); ?>
<div <?php post_class('single-index'); ?>>
<!-- show thumbnail image on top of post - On/Off through theme customizer -->
<?php if ( get_theme_mod('personal_lite_homethumb_options','enable') == 'enable' ): ?>
<?php if ( has_post_thumbnail() ) the_post_thumbnail('personal-index');?><!-- thumbnail picture -->
<?php endif; ?>
<div class="single-index-meta">
<div class="single-header"><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2></div>
<!-- Post meta informations- On/off through theme customizer -->
<?php if ( get_theme_mod('personal_lite_home_meta','enable') == 'enable' ): ?>
<div class="singlemeta-index">
<span><i class="fa fa-calendar"></i><?php the_time( get_option( 'date_format' ) ); ?></span> |
<span><i class="fa fa-pencil-square-o"></i><?php the_author_posts_link(); ?></span> |
<span><i class="fa fa-comment-o"></i><?php comments_popup_link( __( 'Post a Comment', 'personal-lite' ), __( '1 Comment', 'personal-lite' ), __( '% Comments', 'personal-lite' ), __( 'Comments are Closed', 'personal-lite' ));?></span>
<hr>
</div><!-- singlemeta-index -->
<?php endif; ?>
<?php the_excerpt(); ?>
<?php if ( get_theme_mod('personal_lite_home_read','enable') == 'enable' ): ?>
<div class="readmore-a"><a href="<?php the_permalink(); ?>"><?php echo __('Read more', 'personal-lite'); ?></a></div>
<?php endif; ?>
</div><!-- Single-index-meta -->
</div><!-- Single Index -->
<?php endwhile;	?>
<?php endif; ?>
<div class="single-postnav clearfix">
	<div class="row">
	<div class="next-post col-md-6 col-sm-6 col-xs-6"><?php next_posts_link( __('<i class="fa fa-chevron-circle-left"></i> Older posts', 'personal-lite')); ?></div>
	<div class="previous-post col-md-6 col-sm-6 col-xs-6"><?php previous_posts_link( __('Recent posts <i class="fa fa-chevron-circle-right"></i>', 'personal-lite')); ?></div>
	</div><!-- row -->
</div><!-- Single-postnav Clearfix -->
</div><!-- content-index container -->

<?php get_footer(); ?>