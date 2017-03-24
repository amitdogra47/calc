<?php
/**
 * Footer template
 *
 * @package personal-lite
 */
?>
<div class="footer main-footer container-fluid">
	<div class="container">
		<div class="row">
		<div class="footer-single col-md-4">
			<?php dynamic_sidebar( 'footone-sidebar'); ?>
		</div><!-- footer-single -->
		<div class="footer-single col-md-4">
			<?php dynamic_sidebar( 'foottwo-sidebar'); ?>
		</div><!-- footer-single -->
		<div class="footer-single col-md-4">
			<?php dynamic_sidebar( 'footthree-sidebar'); ?>
		</div><!-- footer-single -->
		</div><!-- row -->
	</div><!-- container -->
</div><!-- footer main-footer -->
<div class="container-fluid credit-footer">
	<div class="container">
	<div class="row">
	<div class="footer-left col-md-6">
		<p><?php echo esc_html__( 'Copyright  &copy; ', 'personal-lite' ). date('Y'); ?><a href="<?php echo esc_url( home_url() ); ?>">  <?php echo esc_html( get_bloginfo( 'name' ) ); ?></a></p> 
	</div><!-- footer-left -->
	<div class="footer-right col-md-6">
		<p><?php echo esc_html__( 'powered by: ', 'personal-lite' )?><a href="http://www.wordpress.org" target="_blank" rel="nofollow"><?php echo esc_html__( 'WordPress', 'personal-lite' )?></a></p> 
	</div><!-- footer-right -->
	</div><!-- row -->
	</div><!-- container -->
</div><!-- credit-footer -->
</body><!-- body -->
<?php wp_footer(); ?>
</html><!-- html -->