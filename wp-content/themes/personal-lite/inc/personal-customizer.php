<?php

/**
* Personal customizer setup
* @package personal-lite
*/

function personal_lite_customize_register( $wp_customize ) {
#####---=== Customizer setting ===--- #####


	$wp_customize->add_panel('personal_lite_general', array(
		'title' => esc_html__('Theme Options', 'personal-lite'), 
		'description' => '', 
		'capability' => 'edit_theme_options', 
		'theme_supports' => '', 
		'priority' => 2
	));


	#####---=== Homepage settings ===--- #####
	$wp_customize->add_section( 'personal_lite_home', array(
		'title'    => __( 'Homepage', 'personal-lite' ),
		'priority' => 10,
		'panel' => 'personal_lite_general'
	) );
	#####---=== Thumbnail image on Homepage settings ===--- #####
	$wp_customize->add_setting( 'personal_lite_homethumb_options', array(
		'default' => 'enable',
		'sanitize_callback' => 'personal_lite_select_callback'
	) );
	$wp_customize->add_control('thumb-options', array(
		'label' => esc_html__('Do you wish to show image thumbnail on homepage', 'personal-lite'),
		'section' => 'personal_lite_home', 
		'settings' => 'personal_lite_homethumb_options',
		'type' => 'select', 
		'choices' => array('enable' => esc_html__('Enable', 'personal-lite'), 'disable' => esc_html__('Disable', 'personal-lite'))
	) );
	#####---=== Post meta on Homepage settings ===--- #####
	$wp_customize->add_setting( 'personal_lite_home_meta', array(
		'default' => 'enable',
		'sanitize_callback' => 'personal_lite_select_callback'
	) );
	$wp_customize->add_control('meta-options', array(
		'label' => esc_html__('Show post info', 'personal-lite'),
		'section' => 'personal_lite_home', 
		'settings' => 'personal_lite_home_meta',
		'type' => 'select', 
		'choices' => array('enable' => esc_html__('Enable', 'personal-lite'), 'disable' => esc_html__('Disable', 'personal-lite'))
	) );
	#####---=== Read more on Homepage settings ===--- #####
	$wp_customize->add_setting( 'personal_lite_home_read', array(
		'default' => 'enable',
		'sanitize_callback' => 'personal_lite_select_callback'
	) );
	$wp_customize->add_control('more-options', array(
		'label' => esc_html__('Show Read More Link?', 'personal-lite'),
		'section' => 'personal_lite_home', 
		'settings' => 'personal_lite_home_read',
		'type' => 'select', 
		'choices' => array('enable' => esc_html__('Enable', 'personal-lite'), 'disable' => esc_html__('Disable', 'personal-lite'))
	) );

	#####---=== Post settings ===--- #####
	$wp_customize->add_section( 'personal_lite_post', array(
		'title'    => __( 'Single Post options', 'personal-lite' ),
		'priority' => 15,
		'panel' => 'personal_lite_general'
	) );
	#####---=== Thumbnail image on Single post ===--- #####
	$wp_customize->add_setting( 'personal_lite_postthumb_options', array(
		'default' => 'enable',
		'sanitize_callback' => 'personal_lite_select_callback'
	) );
	$wp_customize->add_control('postthumb-options', array(
		'label' => esc_html__('Image thumbnail on top?', 'personal-lite'),
		'section' => 'personal_lite_post', 
		'settings' => 'personal_lite_postthumb_options',
		'type' => 'select', 
		'choices' => array('enable' => esc_html__('Enable', 'personal-lite'), 'disable' => esc_html__('Disable', 'personal-lite'))
	) );
	#####---=== Post meta on Single post ===--- #####
	$wp_customize->add_setting( 'personal_lite_post_meta', array(
		'default' => 'enable',
		'sanitize_callback' => 'personal_lite_select_callback'
	) );
	$wp_customize->add_control('postmeta-options', array(
		'label' => esc_html__('Show post meta info', 'personal-lite'),
		'section' => 'personal_lite_post', 
		'settings' => 'personal_lite_post_meta',
		'type' => 'select', 
		'choices' => array('enable' => esc_html__('Enable', 'personal-lite'), 'disable' => esc_html__('Disable', 'personal-lite'))
	) );
	#####---===  Navigation on Single post ===--- #####
	$wp_customize->add_setting( 'personal_lite_post_link', array(
		'default' => 'enable',
		'sanitize_callback' => 'personal_lite_select_callback'
	) );
	$wp_customize->add_control('postlink-options', array(
		'label' => esc_html__('Post navigation', 'personal-lite'),
		'section' => 'personal_lite_post', 
		'settings' => 'personal_lite_post_link',
		'type' => 'select', 
		'choices' => array('enable' => esc_html__('Enable', 'personal-lite'), 'disable' => esc_html__('Disable', 'personal-lite'))
	) );


}
add_action( 'customize_register', 'personal_lite_customize_register' );


function personal_lite_select_callback($input) {
    $valid = array(
        'enable' => esc_html__('Enable', 'personal-lite'),
        'disable' => esc_html__('Disable', 'personal-lite'),
    );
    if (array_key_exists($input, $valid)) {
        return $input;
    } else {
        return '';
    }
}

?>