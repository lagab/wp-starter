<?php
/**
 * wp-starter Theme Customizer
 *
 * @package wp-starter
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function theme_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'theme_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'theme_customize_partial_blogdescription',
			)
		);
	}

	// Add General Section
	$wp_customize->add_section(
		'general',
		array(
			'title' => __( 'General', '_s' ),
			'priority' => 30,
			'description' => __( 'General Settings of this theme', '_s' )
		)
	);
	$wp_customize->add_setting('display_sidebar', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
    ));

    $wp_customize->add_control('display_sidebar', array(
        'settings' => 'display_sidebar',
        'label'    => __('Display SideBar'),
        'section'  => 'general',
        'type'     => 'checkbox',
    ));

	// Add Social Media Section
	$wp_customize->add_section(
		'social-media',
		array(
			'title' => __( 'Social Media', '_s' ),
			'priority' => 30,
			'description' => __( 'Enter the URL to your account for each service for the icon to appear in the header.', '_s' )
		)
	);
	
	$medias = array(
		array(
			'slug' => 'facebook',
			'title' => __( 'Facebook', '_s'),
			'default' => ''
		),
		array(
			'slug' => 'instagram',
			'title' => __( 'Instagram', '_s'),
			'default' => ''
		),
		array(
			'slug' => 'twitter',
			'title' => __( 'Twitter', '_s'),
			'default' => ''
		)
	);
	foreach ($medias as $media) {
		add_setting($wp_customize, 'social-media',$media['slug'], $media['title'], $media['default']);
	}

}
add_action( 'customize_register', 'theme_customize_register' );

function add_setting($wp_customize, $section, $slug, $title, $value) {
	$wp_customize->add_setting( $slug, array( 'default' => $value ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $slug, array( 'label' => $title, 'section' => $section, 'settings' => $slug, ) ) );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function theme_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function theme_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function theme_customize_preview_js() {
	wp_enqueue_script( 'theme-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'theme_customize_preview_js' );
