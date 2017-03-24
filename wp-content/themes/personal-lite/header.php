<?php
/**
 * Header template
 * Displays all of the head element
 * @package personal-lite
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php wp_head(); ?>
</head>
<body  <?php body_class(); ?>>
	<div class="container-fluid">
	<?php 
	### Get logo file ###
	get_template_part( 'inc/logo' ); ?>
	</div>
	<div class="container center-nav">
		<div class="site-head navigation">
			<?php wp_nav_menu (
				array(	'theme_location' => 'pagenav',
						'menu_class' => 'navi',
						'items_wrap' => '<ul id="menu" class="%2$s">%3$s</ul>'));
			?>
		</div><!-- site-head -->
	</div><!-- center-nav -->	