<?php
/**
 * Enqueue scripts for customizer
 */
//customizer Pro

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.1.1
 * @access public
 */
final class Personal_Lite_Customize {
  /**
   * Returns the instance.
   *
   * @since  1.1.1
   * @access public
   * @return object
   */
  public static function get_instance() {
    static $instance = null;
    if ( is_null( $instance ) ) {
      $instance = new self;
      $instance->setup_actions();
    }
    return $instance;
  }
  /**
   * Constructor method.
   *
   * @since  1.1.1
   * @access private
   * @return void
   */
  private function __construct() {}
  /**
   * Sets up initial actions.
   *
   * @since  1.1.1
   * @access private
   * @return void
   */
  private function setup_actions() {
    // Register panels, sections, settings, controls, and partials.
    add_action( 'customize_register', array( $this, 'sections' ) );
    // Register scripts and styles for the controls.
    add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
  }
  /**
   * Sets up the customizer sections.
   *
   * @since  1.1.1
   * @access public
   * @param  object  $manager
   * @return void
   */
  public function sections( $manager ) {
    // Load custom sections.
    require_once( trailingslashit( get_template_directory() ) . 'inc/upgrade/section-pro.php' );
    // Register custom section types.
    $manager->register_section_type( 'Personal_Lite_Customize_Section_Pro' );
    // Register sections.
    $manager->add_section(
      new Personal_Lite_Customize_Section_Pro(
        $manager,
        'personal',
        array(
          'title'    => esc_html__( 'Personal Pro', 'personal-lite' ),
          'pro_text' => esc_html__( 'Buy Pro version',         'personal-lite' ),
          'pro_url'  => 'https://sellfy.com/p/sgXX/',
          'priority' => 1,
        )
      )
    );
  }
  /**
   * Loads theme customizer CSS.
   *
   * @since  1.1.1
   * @access public
   * @return void
   */
  public function enqueue_control_scripts() {
    wp_enqueue_script( 'personal-lite-customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/upgrade/customize-controls.js', array( 'customize-controls' ) );
    wp_enqueue_style( 'personal-lite-customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/upgrade/customize-controls.css' );
  }
}
// Doing this customizer thang!
Personal_Lite_Customize::get_instance();