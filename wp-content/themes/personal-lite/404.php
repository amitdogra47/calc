<?php 
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package personal-lite
 */
get_header(); ?>

<div class="container content-index not-found">
<div class="single-index-meta">
	<div class="single-header"><h1><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for', 'personal-lite' ); ?></h1></div>
	<div class="content-align-center">
	<p><?php _e( 'please get your desired article through the search box or below navigational links', 'personal-lite' ); ?></p>
	<?php get_search_form(); ?>
	</div>
	<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
	<h2>Categories</h2>
	<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 'TRUE', 'title_li' => '', 'number' => '10' ) ); ?>
	<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
</div>
</div>

<?php get_footer(); ?>