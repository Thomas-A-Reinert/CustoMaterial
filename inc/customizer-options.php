<?php

$primary_color = "#8bc34a";
//$accent_color = "#607D8B";
$accent_color = "#2c6a8c";
$text_light = "#ffffff";
$text_dark = "#000000";

require get_template_directory() . '/inc/fontawesome_json.php';

if ( class_exists( 'Kirki' ) ) {

	Kirki::add_section( 'typography', array(
	    'title'          => __( 'Font Settings', 'lathom' ),
	    'description'    => __( 'Configure Font Settings. You can also type the desired Font into the Select Box if you are looking for a special one.', 'lathom' ),
	    'panel'          => '',
	    'priority'       => 190,
	    'capability'     => 'edit_theme_options',
	) );

	Kirki::add_panel( 'topbar', array(
	    'priority'    => 200,
	    'title'       => __( 'Topbar', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	) );

	Kirki::add_section( 'topbar_features', array(
	    'title'          => __( 'Topbar Features', 'lathom' ),
	    'description'    => __( 'Configure Settings for the Topbar', 'lathom' ),
	    'panel'          => 'topbar',
	    'priority'       => 10,
	    'capability'     => 'edit_theme_options',
	) );

	Kirki::add_section( 'topbar_color_settings', array(
	    'title'          => __( 'Topbar Colors', 'lathom' ),
	    'description'    => __( 'Configure Color Settings for the Topbar', 'lathom' ),
	    'panel'          => 'topbar',
	    'priority'       => 20,
	    'capability'     => 'edit_theme_options',
	) );

	// Kirki::add_panel( 'menue', array(
	//     'priority'    => 210,
	//     'title'       => __( 'Offcanvas Menu Configuration', 'lathom' ),
	//     'description' => __( '', 'lathom' ),
	// ) );

	Kirki::add_section( 'menu_settings', array(
	    'title'          => __( 'Offcanvas Menu Settings', 'lathom' ),
	    'description'    => __( '', 'lathom' ),
	    'panel'          => '',
	    'priority'       => 220,
	    'capability'     => 'edit_theme_options',
	) );

	Kirki::add_panel( 'content', array(
	    'priority'    => 230,
	    'title'       => __( 'Content Settings', 'lathom' ),
	    'description' => __( 'My Description', 'lathom' ),
	) );

	Kirki::add_section( 'content_features', array(
	    'title'          => __( 'Content Features', 'lathom' ),
	    'description'    => __( '', 'lathom' ),
	    'panel'          => 'content',
	    'priority'       => 10,
	    'capability'     => 'edit_theme_options',
	) );

	Kirki::add_section( 'article_features', array(
	    'title'          => __( 'Article Features', 'lathom' ),
	    'description'    => __( '', 'lathom' ),
	    'panel'          => 'content',
	    'priority'       => 15,
	    'capability'     => 'edit_theme_options',
	) );

	Kirki::add_section( 'article_colors', array(
	    'title'          => __( 'Article Colors', 'lathom' ),
	    'description'    => __( '', 'lathom' ),
	    'panel'          => 'content',
	    'priority'       => 20,
	    'capability'     => 'edit_theme_options',
	) );

	Kirki::add_section( 'comment_section_colors', array(
	    'title'          => __( 'Comment Section', 'lathom' ),
	    'description'    => __( '', 'lathom' ),
	    'panel'          => 'content',
	    'priority'       => 22,
	    'capability'     => 'edit_theme_options',
	) );

	Kirki::add_section( 'article_sticky_config', array(
	    'title'          => __( 'Sticky Article Settings', 'lathom' ),
	    'description'    => __( '', 'lathom' ),
	    'panel'          => 'content',
	    'priority'       => 25,
	    'capability'     => 'edit_theme_options',
	) );

	Kirki::add_section( 'sidebar_config', array(
	    'title'          => __( 'Sidebar Settings', 'lathom' ),
	    'description'    => __( 'Configure Sidebar Settings', 'lathom' ),
	    'panel'          => 'content',
	    'priority'       => 30,
	    'capability'     => 'edit_theme_options',
	) );

	Kirki::add_panel( 'footer', array(
	    'priority'    => 260,
	    'title'       => __( 'Footer Configuration', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	) );

	Kirki::add_section( 'footerwidgets_settings', array(
	    'title'          => __( 'Footer Widgets Settings', 'lathom' ),
	    'description'    => __( 'Configure Settings for the Footer Widgets Area', 'lathom' ),
	    'panel'          => 'footer',
	    'priority'       => 10,
	    'capability'     => 'edit_theme_options',
	) );

	Kirki::add_section( 'footer_settings', array(
	    'title'          => __( 'Footer Settings', 'lathom' ),
	    'description'    => __( 'Configure Settings for the Footer', 'lathom' ),
	    'panel'          => 'footer',
	    'priority'       => 10,
	    'capability'     => 'edit_theme_options',
	) );

	Kirki::add_section( 'custom_code', array(
	    'title'          => __( 'Custom Code', 'lathom' ),
	    'description'    => __( 'You can inject your own CSS and Javascript without modifying any of the theme files or having the need to create a Child-Theme to ensure that this Theme still remains updatable.', 'lathom' ),
	    'panel'          => '',
	    'priority'       => 270,
	    'capability'     => 'edit_theme_options',
	) );


	/**
	 * Add the configuration.
	 * This way all the fields using the 'lathom' ID
	 * will inherit these options
	 */

	Kirki::add_config( 'lathom', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'theme_mod',
	) );

	/**
	 * Font Settings
	 */

	Kirki::add_field( 'lathom', array(
		'type'        => 'typography',
		'settings'    => 'base_typography_config',
		'label'       => esc_attr__( 'Base Typography', 'lathom' ),
		'description' => esc_attr__( 'Configures the overall Font for the whole Site.', 'lathom' ),
		'help'        => esc_attr__( '', 'lathom' ),
		'section'     => 'typography',
		'default'     => array(
			'font-style'     => array( 'bold', 'italic' ),
			'font-family'    => 'Open Sans',
			'font-size'      => '16',
			'font-weight'    => '400',
			'line-height'    => '1.5',
			'letter-spacing' => '-0.004',
			// 'word-spacing'   => '0.125',
		),
		'priority'    => 10,
		'choices'     => array(
			'font-style'     => true,
			'font-family'    => true,
			'font-size'      => true,
			'font-weight'    => true,
			'line-height'    => true,
			'letter-spacing' => true,
			// 'word-spacing'   => true,
			'units'          => array( 'px', 'rem' ),
		),
		'output' => array(
			array(
				'element' => 'body',
			),
		),
	) );

	Kirki::add_field( 'lathom', array(
		'type'        => 'typography',
		'settings'    => 'headline_typography_config',
		'label'       => esc_attr__( 'Headline Typography', 'lathom' ),
		'description' => esc_attr__( 'Configures Headline Fonts for the Site.', 'lathom' ),
		'help'        => esc_attr__( '', 'lathom' ),
		'section'     => 'typography',
		'default'     => array(
			'font-style'     => array( 'bold' ),
			'font-family'    => 'Titillium Web',
			'font-weight'    => '800',
			'letter-spacing' => '0.125',
			//'word-spacing'   => '0.125',
		),
		'priority'    => 10,
		'choices'     => array(
			'font-style'     => true,
			'font-family'    => true,
			'font-weight'    => true,
			'letter-spacing' => true,
			//'word-spacing'   => true,
			'units'          => array( 'px', 'rem' ),
		),
		'output' => array(
			array(
				'element' => 'h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6',
			),
		),
	) );



	/**
	 * Topbar text settings
	 */
	Kirki::add_field( 'lathom', array(
	    'type'        => 'switch',
	    'settings'    => 'display_brand_image',
	    'label'       => __( 'Display Brand Image?', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'section'     => 'topbar_features',
	    'default'     => '1',
	    'priority'    => 10,
	) );

	Kirki::add_field( 'lathom', array(
	    'settings' => 'brand_image',
	    'label'    => __( 'Choose or upload your brand image', 'lathom' ),
	    'description' => __( 'Notice: Please use an Image with 50px maximum height to avoid overhead. Image will get scaled down proportionally to 50px height anyway.', 'lathom' ),
	    'section'  => 'topbar_features',
	    'type'     => 'upload',
	    'mime_type'=> 'image',
	    'priority' => 20,
	    'default'  => '',
	    'required'  => array(
	        array(
	            'setting'  => 'display_brand_image',
	            'operator' => '==',
	            'value'    => 1,
	        ),
	    ),
	) );


	Kirki::add_field( 'lathom', array(
	    'type'        => 'slider',
	    'settings'    => 'blogtitle_size',
	    'label'       => __( 'Blog title size', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'topbar_features',
	    'default'     => 36,
	    'priority'    => 30,
	    'choices'     => array(
	        'min'  => 20,
	        'max'  => 50,
	        'step' => 1
	    ),
	    'output'      => array(
			array(
				'element'  => '.site-title a',
				'property' => 'font-size',
				'units' => 'px',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.site-title a',
				'function' => 'css',
				'property' => 'font-size',
				'units' => 'px',
			),
		),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'switch',
	    'settings'    => 'display_blog_slug',
	    'label'       => __( 'Display Blog Slug?', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'section'     => 'topbar_features',
	    'default'     => '1',
	    'priority'    => 40,
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'slider',
	    'settings'    => 'blog_slug_size',
	    'label'       => __( 'Blog slug size', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'topbar_features',
	    'default'     => 16,
	    'priority'    => 50,
	    'choices'     => array(
	        'min'  => 12,
	        'max'  => 40,
	        'step' => 1
	    ),
	    'required'  => array(
	        array(
	            'setting'  => 'display_blog_slug',
	            'operator' => '==',
	            'value'    => 1,
	        ),
	    ),
	    'output'      => array(
			array(
				'element'  => '.site-description',
				'property' => 'font-size',
				'units' => 'px',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.site-description',
				'function' => 'css',
				'property' => 'font-size',
				'units' => 'px',
			),
		),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'text',
	    'settings'    => 'topbar_menu_text',
	    'label'       => __( 'Menu Button Text', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'default'     => __( 'MENU', 'lathom' ),
	    'section'     => 'topbar_features',
	    'priority'    => 70,
	) );

	/**
	 * Topbar color settings
	 */
	$tb_text = __( 'Topbar color settings', 'lathom' );
	Kirki::add_field( 'lathom', array(
	    'type'        => 'custom',
	    'settings'    => 'custom0',
	    'label'       => '',
	    'section'     => 'topbar_color_settings',
	    'default'     => "<h2>$tb_text</h2>",
	    'priority'    => 1,
	) );
	Kirki::add_field( 'lathom', array(
		'type'        => 'color-alpha',
		'settings'    => 'topbar_background',
		'label'       => esc_attr__( 'Topbar Background Color', 'lathom' ),
		'description' => esc_attr__( 'Notice: Topbar transparency should be used carefully!', 'lathom' ),
		'help'        => esc_attr__( '', 'lathom' ),
		'section'     => 'topbar_color_settings',
		'default'     => $primary_color,
		'priority'    => 10,
		'output'      => array(
			array(
				'element'  => '.topbar',
				'property' => 'background-color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.topbar',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'switch',
	    'settings'    => 'toggle_topbar_shadow',
	    'label'       => __( 'Activate Dropshow?', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'section'     => 'topbar_color_settings',
	    'default'     => '0',
	    'priority'    => 20,
	) );


	Kirki::add_field( 'lathom', array(
		'type'        => 'color-alpha',
		'settings'    => 'topbar_dropshadow_color',
		'label'       => esc_attr__( 'Topbar Dropshadow Color', 'lathom' ),
		'description' => esc_attr__( '', 'lathom' ),
		'help'        => esc_attr__( '', 'lathom' ),
		'section'     => 'topbar_color_settings',
		'default'     => 'rgba(0,0,0,0.75)',
		'priority'    => 30,
		'required'    => array(
			array(
				'setting'  => 'toggle_topbar_shadow',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );


	Kirki::add_field( 'lathom', array(
	    'type'        => 'slider',
	    'settings'    => 'topbar_dropshadow_size',
	    'label'       => __( 'Dropshadow size', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'topbar_color_settings',
	    'default'     => 2,
	    'priority'    => 40,
	    'choices'     => array(
	        'min'  => 1,
	        'max'  => 10,
	        'step' => 1
	    ),
	    'required'    => array(
			array(
				'setting'  => 'toggle_topbar_shadow',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	$btc_text = __( 'Topbar text colors', 'lathom' );
	Kirki::add_field( 'lathom', array(
	    'type'        => 'custom',
	    'settings'    => 'custom1',
	    'label'       => '',
	    'section'     => 'topbar_color_settings',
	    'default'     => "<hr><h2>$btc_text</h2>",
	    'priority'    => 50,
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'blog_title_color',
	    'label'       => __( 'Blog title color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'section'     => 'topbar_color_settings',
	    'default'     => 'rgba(' . hex2rgb($accent_color) . ',1)',
	    'priority'    => 60,
	    'output'      => array(
			array(
				'element'  => '.navbar a',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.navbar a',
				'function' => 'css',
				'property' => 'color',
			),
		),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'blog_title_hover_color',
	    'label'       => __( 'Blog title hover color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'section'     => 'topbar_color_settings',
	    'default'     => 'rgba(' . hex2rgb(adjustBrightness($accent_color, -50)) . ',1)',
	    'priority'    => 70,
	    'output'      => array(
			array(
				'element'  => '.navbar a:hover',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.navbar a:hover',
				'function' => 'style',
				'property' => 'color',
			),
		),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'blog_slug_color',
	    'label'       => __( 'Blog slug color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'section'     => 'topbar_color_settings',
	    'default'     => '#ffffff',
	    'priority'    => 80,
	    'required'  => array(
	        array(
	            'setting'  => 'display_blog_slug',
	            'operator' => '==',
	            'value'    => 1,
	        ),
	    ),
	    'output'      => array(
			array(
				'element'  => '.site-description',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.site-description',
				'function' => 'css',
				'property' => 'color',
			),
		),
	) );

	$mb_text = __( 'Menubutton colors', 'lathom' );
	Kirki::add_field( 'lathom', array(
	    'type'        => 'custom',
	    'settings'    => 'custommenu',
	    'label'       => '',
	    'section'     => 'topbar_color_settings',
	    'default'     => "<hr><h2>$mb_text</h2>",
	    'priority'    => 90,
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'topbar_menu_color',
	    'label'       => __( 'Menubutton Text Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'section'     => 'topbar_color_settings',
	    'default'     => 'rgba(' . hex2rgb($text_light) . ',0.75)',
	    'priority'    => 100,
	    'output'      => array(
			array(
				'element'  => 'a.nav-expander',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => 'a.nav-expander',
				'function' => 'css',
				'property' => 'color',
			),
		),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'topbar_menu_hover_color',
	    'label'       => __( 'Menu Text Hover Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '<strong>Notice:</strong> This works - but is kinda buggy.<br>Needs reload of the Customizer or to be viewed on the frontpage..', 'lathom' ),
	    'section'     => 'topbar_color_settings',
	    'default'     => 'rgba(' . hex2rgb($text_light) . ',1)',
	    'priority'    => 110,
	    'output'      => array(
			array(
				'element'  => 'a.nav-expander:hover',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => 'a.nav-expander:hover',
				'function' => 'style',
				'property' => 'color',
			),
		),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'topbar_menu_button_background_color',
	    'label'       => __( 'Menu Button Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'topbar_color_settings',
	    'default'     => $primary_color,
	    'priority'    => 120,
	    'output'      => array(
			array(
				'element'  => 'a.nav-expander',
				'property' => 'background',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => 'a.nav-expander',
				'function' => 'css',
				'property' => 'background',
			),
		),
	) );

	/**
	 * Offcanvas Menu settings
	 */

	Kirki::add_field( 'lathom', array(
		'type'        => 'color-alpha',
		'settings'    => 'offcanvas_menu_background',
		'label'       => esc_attr__( 'Offcancas Menu Background Color', 'lathom' ),
		'description' => __( 'Notice: Topbar transparency should be used carefully!', 'lathom' ),
		'help'        => esc_attr__( '', 'lathom' ),
		'section'     => 'menu_settings',
		'default'     => '#2d2f33',
		'priority'    => 10,
		'output'      => array(
			array(
				'element'  => '#site-navigation',
				'property' => 'background-color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '#site-navigation',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'switch',
	    'settings'    => 'toggle_menu_shadow',
	    'label'       => __( 'Activate Menu Dropshow?', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'section'     => 'menu_settings',
	    'default'     => '0',
	    'priority'    => 20,
	) );


	Kirki::add_field( 'lathom', array(
		'type'        => 'color-alpha',
		'settings'    => 'menu_dropshadow_color',
		'label'       => esc_attr__( 'Menu Dropshadow Color', 'lathom' ),
		'description' => esc_attr__( '', 'lathom' ),
		'help'        => esc_attr__( '', 'lathom' ),
		'section'     => 'menu_settings',
		'default'     => '#000000',
		'priority'    => 30,
		'required'  => array(
	        array(
	            'setting'  => 'toggle_menu_shadow',
	            'operator' => '==',
	            'value'    => 1,
	        ),
	    ),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'slider',
	    'settings'    => 'menu_dropshadow_size',
	    'label'       => __( 'Dropshadow size', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'menu_settings',
	    'default'     => 1,
	    'priority'    => 40,
	    'choices'     => array(
	        'min'  => 1,
	        'max'  => 10,
	        'step' => 1
	    ),
	    'required'  => array(
	        array(
	            'setting'  => 'toggle_menu_shadow',
	            'operator' => '==',
	            'value'    => 1,
	        ),
	    ),
	) );

	// color



	$mic_text = __( 'Menu Item Colors', 'lathom' );
	Kirki::add_field( 'lathom', array(
	    'type'        => 'custom',
	    'settings'    => 'custommenuitems',
	    'label'       => '',
	    'section'     => 'menu_settings',
	    'default'     => "<hr><h2>$mic_text</h2>",
	    'priority'    => 50,
	) );

	Kirki::add_field( 'lathom', array(
		'type'        => 'color-alpha',
		'settings'    => 'close_button_color',
		'label'       => esc_attr__( 'Close Button Color', 'lathom' ),
		'description' => __( '', 'lathom' ),
		'help'        => esc_attr__( '', 'lathom' ),
		'section'     => 'menu_settings',
		'default'     => $primary_color,
		'priority'    => 55,
		'output'      => array(
			array(
				'element'  => '#site-navigation #nav-close',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '#site-navigation #nav-close',
				'function' => 'css',
				'property' => 'color',
			),
		),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'color',
	    'settings'    => 'menu_text_color',
	    'label'       => __( 'Menu Linktext Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'menu_settings',
	    'default'     => '#aaaaaa',
	    'priority'    => 60,
	    'output'      => array(
			array(
				'element'  => '#site-navigation, #site-navigation a',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '#site-navigation, #site-navigation a',
				'function' => 'css',
				'property' => 'color',
			),
		),
	) );
	// hover color
	Kirki::add_field( 'lathom', array(
	    'type'        => 'color',
	    'settings'    => 'menu_text_hover_color',
	    'label'       => __( 'Menu Linktext Hover Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'menu_settings',
	    'default'     => '#ffffff',
	    'priority'    => 70,
	    'output'      => array(
			array(
				'element'  => '#site-navigation a:hover',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '#site-navigation a:hover',
				'function' => 'style',
				'property' => 'color',
			),
		),
	) );
	// button hover
	Kirki::add_field( 'lathom', array(
	    'type'        => 'color',
	    'settings'    => 'menu_button_hover_color',
	    'label'       => __( 'Menu Item Background Hover Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'menu_settings',
	    'default'     => '#222222',
	    'priority'    => 80,
	    'output'      => array(
			array(
				'element'  => '#site-navigation a:hover, #site-navigation li.current-page-item a, #site-navigation li.current-menu-item a',
				'property' => 'background',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '#site-navigation a:hover',
				'function' => 'style',
				'property' => 'background',
			),
		),
	) );
	// search color
	$sbcolors = __( 'Searchbox Colors', 'lathom' );
	Kirki::add_field( 'lathom', array(
	    'type'        => 'custom',
	    'settings'    => 'custommenuitems',
	    'label'       => '',
	    'section'     => 'menu_settings',
	    'default'     => "<hr><h2>$sbcolors</h2>",
	    'priority'    => 90,
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'color',
	    'settings'    => 'menu_searchbox_text_color',
	    'label'       => __( 'Searchbox Text Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'menu_settings',
	    'default'     => '#555555',
	    'priority'    => 100,
	    'output'      => array(
			array(
				'element'  => '.form-wrapper input',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.form-wrapper input',
				'function' => 'css',
				'property' => 'color',
			),
		),
	) );

	// BUG!
	Kirki::add_field( 'lathom', array(
	    'type'        => 'color',
	    'settings'    => 'menu_searchbox_placeholder_text_color',
	    'label'       => __( 'Searchbox Placeholder Text Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'menu_settings',
	    'default'     => '#999999',
	    'priority'    => 110,
	    'output'      => array(
			array(
				'element'  => 'input[type="search"]::-webkit-input-placeholder, input[type="search"]:-moz-placeholder, input[type="search"]:-ms-input-placeholder',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => 'input[type="search"]::-webkit-input-placeholder, input[type="search"]:-moz-placeholder, input[type="search"]:-ms-input-placeholder',
				'function' => 'css',
				'property' => 'color',
			),
		),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'color',
	    'settings'    => 'menu_searchbox_color',
	    'label'       => __( 'Searchbox Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'menu_settings',
	    'default'     => '#444444',
	    'priority'    => 120,
	    'output'      => array(
			array(
				'element'  => '.form-wrapper input',
				'property' => 'background',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.form-wrapper input',
				'function' => 'css',
				'property' => 'background',
			),
		),
	) );

	// search color
	Kirki::add_field( 'lathom', array(
	    'type'        => 'color',
	    'settings'    => 'menu_searchbox_active_text_color',
	    'label'       => __( 'Focused Searchbox Text Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'menu_settings',
	    'default'     => '#111111',
	    'priority'    => 130,
	    'output'      => array(
			array(
				'element'  => '.form-wrapper input:active, .form-wrapper input:focus',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.form-wrapper input:active, .form-wrapper input:focus',
				'function' => 'css',
				'property' => 'color',
			),
		),
	) );

	// search color:focus
	Kirki::add_field( 'lathom', array(
	    'type'        => 'color',
	    'settings'    => 'menu_searchbox_active_color',
	    'label'       => __( 'Focused Searchbox Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'menu_settings',
	    'default'     => '#ffffff',
	    'priority'    => 140,
	    'output'      => array(
			array(
				'element'  => '.form-wrapper input:active, .form-wrapper input:focus',
				'property' => 'background',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.form-wrapper input:active, .form-wrapper input:focus',
				'function' => 'css',
				'property' => 'background',
			),
		),
	) );



	Kirki::add_field( 'lathom', array(
	    'type'        => 'switch',
	    'settings'    => 'toggle_searchbox_pointer',
	    'label'       => __( 'Activate Searchbox Pointer?', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'section'     => 'menu_settings',
	    'default'     => 'true',
	    'priority'    => 150,
	) );

	// search button
	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'menu_searchbutton_color',
	    'label'       => __( 'Searchbutton Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'menu_settings',
	    'default'     => 'rgba(' . hex2rgb($accent_color) . ',0.85)',
	    'priority'    => 160,
	    'output'      => array(
			array(
				'element'  => '.form-wrapper button',
				'property' => 'background',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.form-wrapper button',
				'function' => 'css',
				'property' => 'background',
			),
		),
	) );


	// search button:hover
	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'menu_searchbutton_hover_color',
	    'label'       => __( 'Searchbutton Hover Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '<strong>Notice:</strong> This works - but is kinda buggy.<br>Needs reload of the Customizer or to be viewed on the frontpage..', 'lathom' ),
	    'section'     => 'menu_settings',
	    'default'     => 'rgba(' . hex2rgb($accent_color) . ',1)',
	    'priority'    => 170,
	    'output'      => array(
			array(
				'element'  => '.form-wrapper button:hover',
				'property' => 'background',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.form-wrapper button:hover',
				'function' => 'style',
				'property' => 'background',
			),
		),
	) );

	// search button textcolor
	Kirki::add_field( 'lathom', array(
	    'type'        => 'color',
	    'settings'    => 'menu_searchbutton_text_color',
	    'label'       => __( 'Searchbutton Text Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'menu_settings',
	    'default'     => '#dddddd',
	    'priority'    => 180,
	    'output'      => array(
			array(
				'element'  => '.form-wrapper button',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.form-wrapper button',
				'function' => 'css',
				'property' => 'color',
			),
		),
	) );
	// search button textcolor
	Kirki::add_field( 'lathom', array(
	    'type'        => 'color',
	    'settings'    => 'menu_searchbutton_text_hover_color',
	    'label'       => __( 'Searchbutton Text Hover Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '<strong>Notice:</strong> This works - but is kinda buggy.<br>Needs reload of the Customizer or to be viewed on the frontpage..', 'lathom' ),
	    'section'     => 'menu_settings',
	    'default'     => '#ffffff',
	    'priority'    => 190,
	    'output'      => array(
			array(
				'element'  => '.form-wrapper button:hover',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.form-wrapper button:hover',
				'function' => 'style',
				'property' => 'color',
			),
		),
	) );

	/**
	 * Content features
	 */

	Kirki::add_field( 'lathom', array(
		'type'        => 'radio-image',
		'settings'    => 'content_width',
		'label'       => esc_attr__( 'Content Width Configuration', 'lathom' ),
		'description' => esc_attr__( 'Choose if you want your Website Content shown in a Fullwidth or a Boxed Layout.', 'lathom' ),
		'help'        => esc_attr__( '', 'lathom' ),
		'section'     => 'content_features',
		'default'     => 'fullwidth',
		'priority'    => 10,
		'choices'     => array(
			'fullwidth'   => get_stylesheet_directory_uri() . '/imgs/fullwidth_layout.png',
			'boxed' 	  => get_stylesheet_directory_uri() . '/imgs/boxed_layout.png',
		),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'switch',
	    'settings'    => 'display_background_image',
	    'label'       => __( 'Use Background Image?', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'section'     => 'content_features',
	    'default'     => '0',
	    'priority'    => 30,
	) );

	Kirki::add_field( 'lathom', array(
	    'settings' => 'bg_image',
	    'label'    => __( 'Choose or upload your Background Image', 'lathom' ),
	    'description' => esc_attr__( 'Your Background Image should be at least 1600 Pixels wide and 900 Pixel high if you want it to cover the whole Screen.', 'lathom' ),
	    'section'  => 'content_features',
	    'type'     => 'upload',
	    'mime_type'=> 'image',
	    'priority' => 40,
	    'default'  => '',
	    'required'  => array(
	        array(
	            'setting'  => 'display_background_image',
	            'operator' => '==',
	            'value'    => 1,
	        ),
	    ),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'color',
	    'settings'    => 'background_color',
	    'label'       => __( 'Background Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'content_features',
	    'default'     => '#eeeeee',
	    'priority'    => 50,
	    'output'      => array(
			array(
				'element'  => 'body',
				'property' => 'background-color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => 'body',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'switch',
	    'settings'    => 'display_to_top_button',
	    'label'       => __( 'Display a "To Top" Button?', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'section'     => 'content_features',
	    'default'     => '1',
	    'priority'    => 60,
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'top_button_color',
	    'label'       => __( '"To Top" Button Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'content_features',
	    'default'     => 'rgba( '.hex2rgb(get_theme_mod( 'topbar_background' )) .',0.75)',
	    'priority'    => 70,
	    'output'      => array(
			array(
				'element'  => '#topbutton',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '#topbutton',
				'function' => 'css',
				'property' => 'color',
			),
		),
		'required'  => array(
	        array(
	            'setting'  => 'display_to_top_button',
	            'operator' => '==',
	            'value'    => 1,
	        ),
	    ),
	) );

	/**
	 * Article Features
	 */

	Kirki::add_field( 'lathom', array(
	    'type'        => 'switch',
	    'settings'    => 'show_content_attachment_image',
	    'label'       => __( 'Show featured image above single article view?', 'lathom' ),
	    'description' => __( '<strong>Notice:</strong> This may lead to super-huge Images when you switch the Sidebar off <b>and</b> activate Fullwidth Layout according to your Monitors Resolution. Anyway, Images will be resized to 1140x641 Pixels and then scaled up to match the Articles Width.', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'section'     => 'article_features',
	    'default'     => 'true',
	    'priority'    => 15,
	) );

	// figure background
	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'attachment_text_background_color',
	    'label'       => __( 'Caption Text Background Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'section'     => 'article_features',
	    'default'     => 'rgba(255,255,255,0.5)',
	    'priority'    => 20,
	    'output'      => array(
			array(
				'element'  => '.attachment-header-image-caption',
				'property' => 'background',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.attachment-header-image-caption',
				'function' => 'css',
				'property' => 'background',
			),
		),
		'required'  => array(
	        array(
	            'setting'  => 'show_content_attachment_image',
	            'operator' => '==',
	            'value'    => 1,
	        ),
	    ),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'attachment_text_color',
	    'label'       => __( 'Caption Text Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'section'     => 'article_features',
	    'default'     => 'rgba(' . hex2rgb(adjustBrightness($accent_color, -50)) . ',1)',
	    'priority'    => 30,
	    'output'      => array(
			array(
				'element'  => '.attachment-header-image-caption',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.attachment-header-image-caption',
				'function' => 'css',
				'property' => 'color',
			),
		),
		'required'  => array(
	        array(
	            'setting'  => 'show_content_attachment_image',
	            'operator' => '==',
	            'value'    => 1,
	        ),
	    ),
	) );

	/**
	 * Article Colors
	 */
	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'article_background_color',
	    'label'       => __( 'Article Background Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'section'     => 'article_colors',
	    'default'     => 'rgba(255,255,255,0.250)',
	    'priority'    => 10,
	    'output'      => array(
			array(
				'element'  => 'article, .author-description',
				'property' => 'background',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => 'article, .author-description',
				'function' => 'css',
				'property' => 'background',
			),
		),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'switch',
	    'settings'    => 'toggle_article_shadow',
	    'label'       => __( 'Activate Article Dropshow?', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'section'     => 'article_colors',
	    'default'     => 'false',
	    'priority'    => 20,
	) );


	Kirki::add_field( 'lathom', array(
		'type'        => 'color-alpha',
		'settings'    => 'article_dropshadow_color',
		'label'       => esc_attr__( 'Article Dropshadow Color', 'lathom' ),
		'description' => esc_attr__( '', 'lathom' ),
		'help'        => esc_attr__( '', 'lathom' ),
		'section'     => 'article_colors',
		'default'     => 'rgba(0,0,0,0.5)',
		'priority'    => 30,
		'required'  => array(
	        array(
	            'setting'  => 'toggle_article_shadow',
	            'operator' => '==',
	            'value'    => 1,
	        ),
	    ),
	) );


	Kirki::add_field( 'lathom', array(
	    'type'        => 'slider',
	    'settings'    => 'article_dropshadow_size',
	    'label'       => __( 'Article Dropshadow size', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'article_colors',
	    'default'     => 1,
	    'priority'    => 40,
	    'choices'     => array(
	        'min'  => 1,
	        'max'  => 10,
	        'step' => 1
	    ),
	    'required'  => array(
	        array(
	            'setting'  => 'toggle_article_shadow',
	            'operator' => '==',
	            'value'    => 1,
	        ),
	    ),
	) );

	$ahc_text = __( 'Article Header Colors', 'lathom' );
	Kirki::add_field( 'lathom', array(
	    'type'        => 'custom',
	    'settings'    => 'articleheadercolors_config',
	    'label'       => '',
	    'section'     => 'article_colors',
	    'default'     => "<hr><h2>$ahc_text</h2>",
	    'priority'    => 50,
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'article_header_background_color',
	    'label'       => __( 'Articleheader Background Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'section'     => 'article_colors',
	    'default'     => 'rgba(0,0,0,0)',
	    'priority'    => 60,
	    'output'      => array(
			array(
				'element'  => '.entry-header, .author-title, .author-contact',
				'property' => 'background',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.entry-header, .author-title, .author-contact',
				'function' => 'css',
				'property' => 'background',
			),
		),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'article_header_text_color',
	    'label'       => __( 'Articleheader Text Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'section'     => 'article_colors',
	    'default'     => 'rgba(' . hex2rgb(adjustBrightness($accent_color, -50)) . ',1)',
	    'priority'    => 70,
	    'output'      => array(
			array(
				'element'  => 'article .entry-header *, .author-title *, .author-contact *',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => 'article .entry-header *, .author-title *, .author-contact *',
				'function' => 'css',
				'property' => 'color',
			),
		),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'article_header_link_text_color',
	    'label'       => __( 'Articleheader Linktext Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'section'     => 'article_colors',
	    'default'     => 'rgba(' . hex2rgb(adjustBrightness($accent_color, -50)) . ',1)',
	    'priority'    => 80,
	    'output'      => array(
			array(
				'element'  => 'article .entry-header a, article .entry-header a *',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => 'article .entry-header a, article .entry-header a *',
				'function' => 'css',
				'property' => 'color',
			),
		),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'article_header_link_text_hover_color',
	    'label'       => __( 'Articleheader Linktext Hover Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '<strong>Notice:</strong> This works - but is kinda buggy.<br>Needs reload of the Customizer or to be viewed on the frontpage..', 'lathom' ),
	    'section'     => 'article_colors',
	    'default'     => 'rgba(' . hex2rgb($accent_color) . ',1)',
	    'priority'    => 90,
	    'output'      => array(
			array(
				'element'  => '.entry-header a:hover, .entry-header a:hover *',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.entry-header a:hover, .entry-header a:hover *',
				'function' => 'css',
				'property' => 'color',
			),
		),
	) );

	$articlecontentcolors = __( 'Article Content Colors', 'lathom' );
	Kirki::add_field( 'lathom', array(
	    'type'        => 'custom',
	    'settings'    => 'articlecontent_config',
	    'label'       => '',
	    'section'     => 'article_colors',
	    'default'     => "<hr><h2>$articlecontentcolors</h2>",
	    'priority'    => 100,
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'article_content_background_color',
	    'label'       => __( 'Article Content Background Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'section'     => 'article_colors',
	    'default'     => 'rgba(255,255,255,0)',
	    'priority'    => 110,
	    'output'      => array(
			array(
				'element'  => '.entry-content',
				'property' => 'background',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.entry-content',
				'function' => 'css',
				'property' => 'background',
			),
		),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'article_content_headline_color',
	    'label'       => __( 'Article Headline Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'section'     => 'article_colors',
	    'default'     => 'rgba(' . hex2rgb(adjustBrightness($accent_color, -50)) . ',1)',
	    'priority'    => 115,
	    'output'      => array(
			array(
				'element'  => 'article h1, article .h1, article h2, article .h2, article h3, article .h3, article h4, article .h4, article h5, article .h5, article h6, article .h6',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => 'article h1, article .h1, article h2, article .h2, article h3, article .h3, article h4, article .h4, article h5, article .h5, article h6, article .h6',
				'function' => 'css',
				'property' => 'color',
			),
		),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'article_content_text_color',
	    'label'       => __( 'Article Text Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'section'     => 'article_colors',
	    'default'     => '#222222',
	    'priority'    => 120,
	    'output'      => array(
			array(
				'element'  => '.entry-content, .author-description',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.entry-content, .author-description',
				'function' => 'css',
				'property' => 'color',
			),
		),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'article_content_text_link_color',
	    'label'       => __( 'Article Linktext Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'section'     => 'article_colors',
	    'default'     => '#000000',
	    'priority'    => 130,
	    'output'      => array(
			array(
				'element'  => '.entry-content a, .entry-content a *',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.entry-content a, .entry-content a *',
				'function' => 'css',
				'property' => 'color',
			),
		),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'article_content_text_link_hover_color',
	    'label'       => __( 'Article Linktext Hover Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '<strong>Notice:</strong> This works - but is kinda buggy.<br>Needs reload of the Customizer or to be viewed on the frontpage..', 'lathom' ),
	    'section'     => 'article_colors',
	    'default'     => '#555555',
	    'priority'    => 140,
	    'output'      => array(
			array(
				'element'  => '.entry-content a:hover, .entry-content a:hover *',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.entry-content a:hover, .entry-content a:hover *',
				'function' => 'style',
				'property' => 'color',
			),
		),
	) );

	$articlefootercolors = __( 'Article Footer Colors', 'lathom' );
	Kirki::add_field( 'lathom', array(
	    'type'        => 'custom',
	    'settings'    => 'articlefooter_config',
	    'label'       => '',
	    'section'     => 'article_colors',
	    'default'     => "<hr><h2>$articlefootercolors</h2>",
	    'priority'    => 160,
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'article_footer_background_color',
	    'label'       => __( 'Articlefooter Background Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'section'     => 'article_colors',
	    'default'     => 'rgba(0,0,0,0.1)',
	    'priority'    => 170,
	    'output'      => array(
			array(
				'element'  => '.entry-footer',
				'property' => 'background',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.entry-footer',
				'function' => 'css',
				'property' => 'background',
			),
		),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'article_footer_text_color',
	    'label'       => __( 'Articlefooter Text Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'section'     => 'article_colors',
	    'default'     => 'rgba(' . hex2rgb(adjustBrightness($accent_color, -50)) . ',1)',
	    'priority'    => 190,
	    'output'      => array(
			array(
				'element'  => '.entry-footer',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.entry-footer',
				'function' => 'css',
				'property' => 'color',
			),
		),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'article_footer_text_link_color',
	    'label'       => __( 'Articlefooter Linktext Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '<strong>Notice:</strong> This works - but is kinda buggy.<br>Needs reload of the Customizer or to be viewed on the frontpage..', 'lathom' ),
	    'section'     => 'article_colors',
	    'default'     => 'rgba(' . hex2rgb(adjustBrightness($accent_color, -50)) . ',1)',
	    'priority'    => 190,
	    'output'      => array(
			array(
				'element'  => '.entry-footer a, .entry-footer a *',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.entry-footer a:hover, .entry-footer a *',
				'function' => 'style',
				'property' => 'color',
			),
		),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'article_footer_text_link_hover_color',
	    'label'       => __( 'Articlefooter Linktext Hover Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '<strong>Notice:</strong> This works - but is kinda buggy.<br>Needs reload of the Customizer or to be viewed on the frontpage..', 'lathom' ),
	    'section'     => 'article_colors',
	    'default'     => 'rgba(' . hex2rgb($accent_color) . ',1)',
	    'priority'    => 200,
	    'output'      => array(
			array(
				'element'  => '.entry-footer a:hover, .entry-footer a:hover *',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.entry-footer a:hover, .entry-footer a:hover *',
				'function' => 'style',
				'property' => 'color',
			),
		),
	) );

	/**
	 * Comment Section Settings
	 */
	Kirki::add_field( 'lathom', array(
	    'type'        => 'custom',
	    'settings'    => 'commentsheadlinecolors_config',
	    'label'       => '',
	    'section'     => 'comment_section_colors',
	    'default'     => __( '<hr><h2>Comments Section Headline</h2>', 'lathom'),
	    'priority'    => 5,
	) );

	// comments-title color default: accent
	Kirki::add_field( 'lathom', array(
		'type'        => 'color-alpha',
		'settings'    => 'comments_title_text_color',
		'label'       => esc_attr__( 'Comments Title Text', 'lathom' ),
		'description' => esc_attr__( '', 'lathom' ),
		'help'        => esc_attr__( '', 'lathom' ),
		'section'     => 'comment_section_colors',
		'default'     => 'rgba(' . hex2rgb($accent_color) . ',1)',
		'priority'    => 10,
		'output'      => array(
			array(
				'element'  => '#comments .comments-title',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '#comments .comments-title',
				'function' => 'css',
				'property' => 'color',
			),
		),
	) );

	// comments title background default: primary
	Kirki::add_field( 'lathom', array(
		'type'        => 'color-alpha',
		'settings'    => 'comments_title_background_color',
		'label'       => esc_attr__( 'Comments Title Background', 'lathom' ),
		'description' => esc_attr__( '', 'lathom' ),
		'help'        => esc_attr__( '', 'lathom' ),
		'section'     => 'comment_section_colors',
		'default'     => get_theme_mod( 'topbar_background' ),
		'priority'    => 20,
		'output'      => array(
			array(
				'element'  => '#comments .comments-title',
				'property' => 'background',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '#comments .comments-title',
				'function' => 'css',
				'property' => 'background',
			),
		),
	) );


	Kirki::add_field( 'lathom', array(
		'type'        => 'radio-image',
		'settings'    => 'comment_avater_config',
		'label'       => esc_attr__( 'Avatar Style', 'lathom' ),
		'description' => esc_attr__( 'You can choose if you want your Avatars displayed rounded, circle or standard.', 'lathom' ),
		'help'        => esc_attr__( '', 'lathom' ),
		'section'     => 'comment_section_colors',
		'default'     => 'img-circle',
		'priority'    => 22,
		'choices'     => array(
			'img-rounded'   => get_stylesheet_directory_uri() . '/imgs/avatar_rounded.png',
			'img-circle' 	=> get_stylesheet_directory_uri() . '/imgs/avatar_circle.png',
			'' => get_stylesheet_directory_uri() . '/imgs/avatar_thumbnail.png',
		),
	) );


	// comment content even top color
	Kirki::add_field( 'lathom', array(
	    'type'        => 'custom',
	    'settings'    => 'commentsevencolor_config',
	    'label'       => '',
	    'section'     => 'comment_section_colors',
	    'default'     => __( '<hr><h2>Comments Even</h2>', 'lathom'),
	    'priority'    => 25,
	) );

	Kirki::add_field( 'lathom', array(
		'type'        => 'color-alpha',
		'settings'    => 'comments_content_even_title_text_color',
		'label'       => esc_attr__( 'Comments Even Titletext', 'lathom' ),
		'description' => esc_attr__( '', 'lathom' ),
		'help'        => esc_attr__( '', 'lathom' ),
		'section'     => 'comment_section_colors',
		'default'     => '#ffffff',
		'priority'    => 30,
		'output'      => array(
			array(
				'element'  => '.even .comment-meta, .even .comment-meta a, .even .comment-meta a:hover, .even .reply a, .even .reply a:hover',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.even .comment-meta, .even .comment-meta a, .even .comment-meta a:hover, .even .reply a, .even .reply a:hover',
				'function' => 'style',
				'property' => 'color',
			),
		),
	) );

	// comment content even top background inverse article_background_color
	Kirki::add_field( 'lathom', array(
		'type'        => 'color-alpha',
		'settings'    => 'comments_content_even_title_background_color',
		'label'       => esc_attr__( 'Comments Even Title Background', 'lathom' ),
		'description' => esc_attr__( '', 'lathom' ),
		'help'        => esc_attr__( '', 'lathom' ),
		'section'     => 'comment_section_colors',
		'default'     => 'rgba( ' .invertRGBa(get_theme_mod( 'article_background_color' )) . ')',
		'priority'    => 40,
		'output'      => array(
			array(
				'element'  => '.even .comment-meta, .even .reply',
				'property' => 'background',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.even .comment-meta, .even .reply',
				'function' => 'css',
				'property' => 'background',
			),
		),
	) );

	// comment content even content color
	Kirki::add_field( 'lathom', array(
		'type'        => 'color-alpha',
		'settings'    => 'comments_content_even_content_text_color',
		'label'       => esc_attr__( 'Comments Even Text', 'lathom' ),
		'description' => esc_attr__( '', 'lathom' ),
		'help'        => esc_attr__( '', 'lathom' ),
		'section'     => 'comment_section_colors',
		'default'     => '#222222',
		'priority'    => 50,
		'output'      => array(
			array(
				'element'  => '.even .comment-content',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.even .comment-content',
				'function' => 'css',
				'property' => 'color',
			),
		),
	) );

	// comment content even content background article_background_color
	Kirki::add_field( 'lathom', array(
		'type'        => 'color-alpha',
		'settings'    => 'comments_content_even_content_background_color',
		'label'       => esc_attr__( 'Comments Even Background', 'lathom' ),
		'description' => esc_attr__( '', 'lathom' ),
		'help'        => esc_attr__( '', 'lathom' ),
		'section'     => 'comment_section_colors',
		'default'     => get_theme_mod( 'article_background_color' ),
		'priority'    => 60,
		'output'      => array(
			array(
				'element'  => '.even .comment-content',
				'property' => 'background',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.even .comment-content',
				'function' => 'css',
				'property' => 'background',
			),
		),
	) );


	// comment content odd top color
	Kirki::add_field( 'lathom', array(
	    'type'        => 'custom',
	    'settings'    => 'commentsodd_config',
	    'label'       => '',
	    'section'     => 'comment_section_colors',
	    'default'     => __( '<hr><h2>Comments Odd</h2>', 'lathom'),
	    'priority'    => 99,
	) );
	Kirki::add_field( 'lathom', array(
		'type'        => 'color-alpha',
		'settings'    => 'comments_content_odd_title_text_color',
		'label'       => esc_attr__( 'Comments Odd Titletext', 'lathom' ),
		'description' => esc_attr__( '', 'lathom' ),
		'help'        => esc_attr__( '', 'lathom' ),
		'section'     => 'comment_section_colors',
		'default'     => '#000000',
		'priority'    => 100,
		'output'      => array(
			array(
				'element'  => '.odd .comment-meta, .odd .comment-meta a, .odd .comment-meta a:hover, .odd reply a, .odd reply a:hover',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.odd .comment-meta, .odd .comment-meta a, .odd .comment-meta a:hover, .odd reply a, .odd reply a:hover',
				'function' => 'css',
				'property' => 'color',
			),
		),
	) );
	// comment content odd top background article_background_color
	Kirki::add_field( 'lathom', array(
		'type'        => 'color-alpha',
		'settings'    => 'comments_content_odd_title_background_color',
		'label'       => esc_attr__( 'Comments Odd Title Background', 'lathom' ),
		'description' => esc_attr__( '', 'lathom' ),
		'help'        => esc_attr__( '', 'lathom' ),
		'section'     => 'comment_section_colors',
		'default'     => get_theme_mod( 'article_background_color' ),
		'priority'    => 110,
		'output'      => array(
			array(
				'element'  => '.odd .comment-meta, .odd .reply',
				'property' => 'background',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.odd .comment-meta, .odd .reply',
				'function' => 'css',
				'property' => 'background',
			),
		),
	) );
	// comment content odd content color
	Kirki::add_field( 'lathom', array(
		'type'        => 'color-alpha',
		'settings'    => 'comments_content_odd_content_text_color',
		'label'       => esc_attr__( 'Comments Odd Text', 'lathom' ),
		'description' => esc_attr__( '', 'lathom' ),
		'help'        => esc_attr__( '', 'lathom' ),
		'section'     => 'comment_section_colors',
		'default'     => '#dddddd',
		'priority'    => 120,
		'output'      => array(
			array(
				'element'  => '.odd .comment-content',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.odd .comment-content',
				'function' => 'css',
				'property' => 'color',
			),
		),
	) );
	// comment content odd content background inverse article_background_color
	Kirki::add_field( 'lathom', array(
		'type'        => 'color-alpha',
		'settings'    => 'comments_content_odd_content_background_color',
		'label'       => esc_attr__( 'Comments Odd Background', 'lathom' ),
		'description' => esc_attr__( '', 'lathom' ),
		'help'        => esc_attr__( '', 'lathom' ),
		'section'     => 'comment_section_colors',
		'default'     => 'rgba( ' .invertRGBa(get_theme_mod( 'article_background_color' )) . ')',
		'priority'    => 130,
		'output'      => array(
			array(
				'element'  => '.odd .comment-content',
				'property' => 'background',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.odd .comment-content',
				'function' => 'css',
				'property' => 'background',
			),
		),
	) );
	// comment content bypostauthor color
	Kirki::add_field( 'lathom', array(
	    'type'        => 'custom',
	    'settings'    => 'commentsbypostauthor_config',
	    'label'       => '',
	    'section'     => 'comment_section_colors',
	    'default'     => __( '<hr><h2>Comments Postauthor</h2>', 'lathom'),
	    'priority'    => 150,
	) );
	Kirki::add_field( 'lathom', array(
		'type'        => 'color-alpha',
		'settings'    => 'comments_content_bypostauthor_content_text_color',
		'label'       => esc_attr__( 'Comments Postauthor Text', 'lathom' ),
		'description' => esc_attr__( '', 'lathom' ),
		'help'        => esc_attr__( '', 'lathom' ),
		'section'     => 'comment_section_colors',
		'default'     => '#dddddd',
		'priority'    => 160,
		'output'      => array(
			array(
				'element'  => '.bypostauthor .comment-content',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.bypostauthor .comment-content',
				'function' => 'css',
				'property' => 'color',
			),
		),
	) );
	// comment content bypostauthor background default: primary
	Kirki::add_field( 'lathom', array(
		'type'        => 'color-alpha',
		'settings'    => 'comments_content_bypostauthor_content_background_color',
		'label'       => esc_attr__( 'Comments Postauthor Background', 'lathom' ),
		'description' => esc_attr__( '', 'lathom' ),
		'help'        => esc_attr__( '', 'lathom' ),
		'section'     => 'comment_section_colors',
		// 'rgba(' . hex2rgb(adjustBrightness($accent_color, -50)) . ',1)',
		'default'     => 'rgba( '.hex2rgb(get_theme_mod( 'topbar_background' )) .',0.35)',
		'priority'    => 170,
		'output'      => array(
			array(
				'element'  => '.bypostauthor .comment-content',
				'property' => 'background',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.bypostauthor .comment-content',
				'function' => 'css',
				'property' => 'background',
			),
		),
	) );


	/**
	 * Sticky Article Settings
	 */

	//article_sticky_config

	Kirki::add_field( 'lathom', array(
		'type'        => 'color-alpha',
		'settings'    => 'sticky_headline_color',
		'label'       => esc_attr__( 'Header Background Color', 'lathom' ),
		'description' => esc_attr__( '', 'lathom' ),
		'help'        => esc_attr__( '', 'lathom' ),
		'section'     => 'article_sticky_config',
		'default'     => 'rgba(' . hex2rgb($primary_color) . ',0.75)',
		'priority'    => 10,
		'output'      => array(
			array(
				'element'  => 'article.sticky .entry-header',
				'property' => 'background',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => 'article.sticky .entry-header',
				'function' => 'css',
				'property' => 'background',
			),
		),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'switch',
	    'settings'    => 'sticky_use_prefix_icon',
	    'label'       => __( 'Use Prefix Icon for Headline?', 'lathom' ),
	    'description' => __( 'You can choose any of <a href="https://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">Fontawesomes 593 Icons</a> as a Prefix Icon for the Headline.', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'section'     => 'article_sticky_config',
	    'default'     => '1',
	    'priority'    => 20,
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'select',
	    'settings'    => 'sticky_prefix_icon',
	    'label'       => __( 'Fontawesome Icon', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'section'     => 'article_sticky_config',
	    'default'     => 'bullhorn',
	    'priority'    => 30,
	    'choices'     => smk_font_awesome(),
	    'required'    => array(
			array(
				'setting'  => 'sticky_use_prefix_icon',
				'operator' => '==',
				'value'    => "true",
			),
		),
	) );

	$sticky_prefix_icon_css = '\\' . get_theme_mod( 'sticky_prefix_icon') . '\00a0';
	Kirki::add_field( 'lathom', array(
	    'type'        => 'custom',
	    'settings'    => 'sticky_prefix_icon_css',
	    'label'       => '',
	    'section'     => 'article_sticky_config',
	    'default'     => '"'.$sticky_prefix_icon_css.'"',
	    'priority'    => 35,
	    'output'      => array(
			array(
				'element'  => '.sticky .entry-title a:before',
				'property' => 'content',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.sticky .entry-title a:before',
				'function' => 'style',
				'property' => 'content',
			),
		),
		'active_callback' => '__return_false',
	) );

	Kirki::add_field( 'lathom', array(
		'type'        => 'color-alpha',
		'settings'    => 'sticky_background_color',
		'label'       => esc_attr__( 'Background Color', 'lathom' ),
		'description' => esc_attr__( 'Background Color can be used if you dont want to use a Gradient and will be used by Browsers that do NOT support Background Gradients as a Fallback Solution.', 'lathom' ),
		'help'        => esc_attr__( '', 'lathom' ),
		'section'     => 'article_sticky_config',
		'default'     => 'rgba(255,255,255,0)',
		'priority'    => 40,
		'output'      => array(
			array(
				'element'  => '.sticky',
				'property' => 'background',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.sticky',
				'function' => 'style',
				'property' => 'background',
			),
		),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'switch',
	    'settings'    => 'display_sticky_gradient',
	    'label'       => __( 'Use Background Gradient?', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( 'If you want to use Background Gradients, you will have to set up two Colors below. Notice: Linear Gradients are not well supported by some older browser like IE8 & IE9.', 'lathom' ),
	    'section'     => 'article_sticky_config',
	    'default'     => '1',
	    'priority'    => 50,
	) );

	Kirki::add_field( 'lathom', array(
		'type'        => 'color-alpha',
		'settings'    => 'sticky_gradient_color_1',
		'label'       => esc_attr__( 'Gradient Color #1', 'lathom' ),
		'description' => esc_attr__( '', 'lathom' ),
		'help'        => esc_attr__( '', 'lathom' ),
		'section'     => 'article_sticky_config',
		'default'     => 'rgba(0,0,0,0.035)',
		'priority'    => 60,
		'required'    => array(
			array(
				'setting'  => 'display_sticky_gradient',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'lathom', array(
		'type'        => 'color-alpha',
		'settings'    => 'sticky_gradient_color_2',
		'label'       => esc_attr__( 'Gradient Color #2', 'lathom' ),
		'description' => esc_attr__( '', 'lathom' ),
		'help'        => esc_attr__( '', 'lathom' ),
		'section'     => 'article_sticky_config',
		'default'     => 'rgba(255,255,255,0)',
		'priority'    => 70,
		'required'    => array(
			array(
				'setting'  => 'display_sticky_gradient',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'slider',
	    'settings'    => 'sticky_gradient_rotation',
	    'label'       => __( 'Gradient Rotation', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'article_sticky_config',
	    'default'     => 135,
	    'priority'    => 80,
	    'choices'     => array(
	        'min'  => 0,
	        'max'  => 180,
	        'step' => 1
	    ),
	    'required'    => array(
			array(
				'setting'  => 'display_sticky_gradient',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	/**
	 * Sidebar Settings
	 */

	Kirki::add_field( 'lathom', array(
	    'type'        => 'switch',
	    'settings'    => 'show_sidebar',
	    'label'       => __( 'Show Sidebar?', 'lathom' ),
	    'description' => __( '<strong>Notice:</strong> You can still show the Sidebar via a per-Page Template even if the Sidebar is switched off here. But it will never show on Blog Posts then.', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'section'     => 'sidebar_config',
	    'default'     => '0',
	    'priority'    => 10,
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'sidebar_background_color',
	    'label'       => __( 'Sidebar Background Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'sidebar_config',
	    'default'     => 'rgba(255,255,255,0.2)',
	    'priority'    => 10,
	    'output'      => array(
			array(
				'element'  => '#secondary',
				'property' => 'background',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '#secondary',
				'function' => 'css',
				'property' => 'background',
			),
		),
	    'required'    => array(
			array(
				'setting'  => 'show_sidebar',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'sidebar_widget_background_color',
	    'label'       => __( 'Widget Background Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'sidebar_config',
	    'default'     => 'rgba(255,255,255,0.2)',
	    'priority'    => 20,
	    'output'      => array(
			array(
				'element'  => '#secondary .widget',
				'property' => 'background',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '#secondary .widget',
				'function' => 'css',
				'property' => 'background',
			),
		),
	    'required'    => array(
			array(
				'setting'  => 'show_sidebar',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'sidebar_widget_title_background_color',
	    'label'       => __( 'Sidebar Background Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'sidebar_config',
	    'default'     => 'rgba(' . hex2rgb($primary_color) . ',1)',
	    'priority'    => 30,
	    'output'      => array(
			array(
				'element'  => '.widget-title',
				'property' => 'background',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.widget-title',
				'function' => 'css',
				'property' => 'background',
			),
		),
	    'required'    => array(
			array(
				'setting'  => 'show_sidebar',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'sidebar_widget_text_color',
	    'label'       => __( 'Sidebar Background Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'sidebar_config',
	    'default'     => 'rgba(' . hex2rgb(adjustBrightness($accent_color, -50)) . ',1)',
	    'priority'    => 40,
	    'output'      => array(
			array(
				'element'  => '.widget',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.widget',
				'function' => 'css',
				'property' => 'color',
			),
		),
	    'required'    => array(
			array(
				'setting'  => 'show_sidebar',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	// widget link color
	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'sidebar_widget_text_link_color',
	    'label'       => __( 'Sidebar Background Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'sidebar_config',
	    'default'     => 'rgba(' . hex2rgb(adjustBrightness($accent_color, -50)) . ',1)',
	    'priority'    => 50,
	    'output'      => array(
			array(
				'element'  => '.widget a',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.widget a',
				'function' => 'css',
				'property' => 'color',
			),
		),
	    'required'    => array(
			array(
				'setting'  => 'show_sidebar',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	// widget link hover color
	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'sidebar_widget_text_link_hover_color',
	    'label'       => __( 'Widget Link Hover Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'sidebar_config',
	    'default'     => 'rgba(' . hex2rgb($primary_color) . ',1)',
	    'priority'    => 60,
	    'output'      => array(
			array(
				'element'  => '.widget a:hover',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.widget a:hover',
				'function' => 'style',
				'property' => 'color',
			),
		),
	    'required'    => array(
			array(
				'setting'  => 'show_sidebar',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	/**
	 * Footer Widget Settings
	 */

	Kirki::add_field( 'lathom', array(
	    'type'        => 'switch',
	    'settings'    => 'toggle_footer_widgets',
	    'label'       => __( 'Show Footer Widget Area?', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'section'     => 'footerwidgets_settings',
	    'default'     => 'true',
	    'priority'    => 5,
	) );

	// footer widget background
	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'footer_widget_background_color',
	    'label'       => __( 'Footer Widget Background Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'footerwidgets_settings',
	    'default'     => '#2d2f33',
	    'priority'    => 10,
	    'output'      => array(
			array(
				'element'  => '#footer-widgets',
				'property' => 'background',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '#footer-widgets',
				'function' => 'css',
				'property' => 'background',
			),
		),
	    'required'    => array(
			array(
				'setting'  => 'toggle_footer_widgets',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	// footer widget headline color
	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'footer_widget_headline_color',
	    'label'       => __( 'Footer Headline Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'footerwidgets_settings',
	    'default'     => 'rgba(' . hex2rgb(adjustBrightness($accent_color, -50)) . ',1)',
	    'priority'    => 20,
	    'output'      => array(
			array(
				'element'  => '#footer-widgets .widget-title',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '#footer-widgets .widget-title',
				'function' => 'css',
				'property' => 'color',
			),
		),
		'required'    => array(
			array(
				'setting'  => 'toggle_footer_widgets',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	// footer widget headline background color
	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'footer_widget_headline_background_color',
	    'label'       => __( 'Footer Widget Headline Background Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'footerwidgets_settings',
	    //'default'     => '#607D8B',
	    'default'     => 'rgba(' . hex2rgb($primary_color) . ',0.75)',
	    'priority'    => 30,
	    'output'      => array(
			array(
				'element'  => '#footer-widgets .widget-title',
				'property' => 'background',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '#footer-widgets .widget-title',
				'function' => 'css',
				'property' => 'background',
			),
		),
		'required'    => array(
			array(
				'setting'  => 'toggle_footer_widgets',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	// footer widget text color
	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'footer_widget_text_color',
	    'label'       => __( 'Footer Widget Text Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'footerwidgets_settings',
	    'default'     => '#aaaaaa',
	    'priority'    => 50,
	    'output'      => array(
			array(
				'element'  => '#footer-widgets',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '#footer-widgets',
				'function' => 'css',
				'property' => 'color',
			),
		),
		'required'    => array(
			array(
				'setting'  => 'toggle_footer_widgets',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	// footer widget link color
	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'footer_widget_link_color',
	    'label'       => __( 'Footer Widget Link Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'footerwidgets_settings',
	    'default'     => '#aaaaaa',
	    'priority'    => 60,
	    'output'      => array(
			array(
				'element'  => '#footer-widgets a',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '#footer-widgets a',
				'function' => 'css',
				'property' => 'color',
			),
		),
		'required'    => array(
			array(
				'setting'  => 'toggle_footer_widgets',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	// footer widget link color hover
	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'footer_widget_link_hover_color',
	    'label'       => __( 'Footer Widget Link Hover Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '<strong>Notice:</strong> This works - but is kinda buggy.<br>Needs reload of the Customizer or to be viewed on the frontpage..', 'lathom' ),
	    'section'     => 'footerwidgets_settings',
	    'default'     => '#ffffff',
	    'priority'    => 70,
	    'output'      => array(
			array(
				'element'  => '#footer-widgets a:hover',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '#footer-widgets a:hover',
				'function' => 'style',
				'property' => 'color',
			),
		),
		'required'    => array(
			array(
				'setting'  => 'toggle_footer_widgets',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );


	/**
	 * Footer Settings
	 */

	// footer background
	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'footer_background_color',
	    'label'       => __( 'Footer Background Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'footer_settings',
	    'default'     => '#000000',
	    'priority'    => 10,
	    'output'      => array(
			array(
				'element'  => '#colophon',
				'property' => 'background',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '#colophon',
				'function' => 'css',
				'property' => 'background',
			),
		),
	) );

	// footer text color
	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'footer_text_color',
	    'label'       => __( 'Footer Text Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'footer_settings',
	    'default'     => '#aaaaaa',
	    'priority'    => 20,
	    'output'      => array(
			array(
				'element'  => '#colophon',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '#colophon',
				'function' => 'css',
				'property' => 'color',
			),
		),
	) );

	// footer link color
	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'footer_link_color',
	    'label'       => __( 'Footer Link Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'section'     => 'footer_settings',
	    'default'     => '#aaaaaa',
	    'priority'    => 30,
	    'output'      => array(
			array(
				'element'  => '#colophon a',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '#colophon a',
				'function' => 'css',
				'property' => 'color',
			),
		),
	) );

	// footer link color hover
	Kirki::add_field( 'lathom', array(
	    'type'        => 'color-alpha',
	    'settings'    => 'footer_link_hover_color',
	    'label'       => __( 'Footer Link Hover Color', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '<strong>Notice:</strong> This works - but is kinda buggy.<br>Needs reload of the Customizer or to be viewed on the frontpage..', 'lathom' ),
	    'section'     => 'footer_settings',
	    'default'     => '#ffffff',
	    'priority'    => 40,
	    'output'      => array(
			array(
				'element'  => '#colophon a:hover',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '#colophon a:hover',
				'function' => 'style',
				'property' => 'color',
			),
		),
	) );

	// Display WP Credit
	Kirki::add_field( 'lathom', array(
	    'type'        => 'switch',
	    'settings'    => 'footer_show_wp_credits',
	    'label'       => __( 'Show some &#x2764; for Wordpress?', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'section'     => 'footer_settings',
	    'default'     => 'true',
	    'priority'    => 50,
	) );

	Kirki::add_field( 'lathom', array(
	    'type'        => 'switch',
	    'settings'    => 'footer_show_custom_footer_text',
	    'label'       => __( 'Display Custom Footer Text?', 'lathom' ),
	    'description' => __( '', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'section'     => 'footer_settings',
	    'default'     => 'true',
	    'priority'    => 55,
	) );
	// Display custom footer text
	Kirki::add_field( 'lathom', array(
	    'type'        => 'text',
	    'settings'    => 'footer_custom_footer_text',
	    'label'       => __( 'Custom Footer Text', 'lathom' ),
	    'description' => __( '<strong>Notice:</strong> The copyright and year will be included automatically', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'default'     => __( 'Theme by Thomas A. Reinert | TARThemes.com', 'lathom' ),
	    'section'     => 'footer_settings',
	    'priority'    => 60,
	    'required'    => array(
			array(
				'setting'  => 'footer_show_custom_footer_text',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	// Display custom footer text
	Kirki::add_field( 'lathom', array(
	    'type'        => 'text',
	    'settings'    => 'footer_custom_footer_text_link',
	    'label'       => __( 'Footer Text Link', 'lathom' ),
	    'description' => __( '<strong>Notice:</strong> Do not forget to include "<strong>http(s)://</strong>"" at the beginning. Leave blank if you dont want the Custom Footer Text linked.', 'lathom' ),
	    'help'        => __( '', 'lathom' ),
	    'default'     => __( 'http://www.tarthemes.com', 'lathom' ),
	    'section'     => 'footer_settings',
	    'priority'    => 70,
	    'required'    => array(
			array(
				'setting'  => 'footer_show_custom_footer_text',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'lathom', array(
		'type'        => 'code',
		'settings'    => 'css_code',
		'label'       => esc_attr__( 'Insert custom CSS', 'lathom' ),
		'help'        => esc_attr__( 'Pure CSS please. It will get wrapped in style-Tags automagically.', 'lathom' ),
		'description' => esc_attr__( 'This will override any other styles as it gets inserted last just before the closing head-Tag.', 'lathom' ),
		'section'     => 'custom_code',
		'default'     => ' ',
		'priority'    => 10,
		'choices'     => array(
			'language' => 'css',
			'theme'    => 'monokai',
			'height'   => 150,
		),
	) );

	Kirki::add_field( 'lathom', array(
		'type'        => 'code',
		'settings'    => 'javascript_header_code',
		'label'       => esc_attr__( 'Insert custom &lt;head&gt;-Javascript', 'lathom' ),
		'help'        => esc_attr__( 'Pure Javascript please. It will get wrapped in script-Tags automagically.', 'lathom' ),
		'description' => esc_attr__( 'Please notice that this Javascript will be embedded in the head of the Document. Do NOT insert any jQuery calls here. Do it in the Footer Script Area instead.', 'lathom' ),
		'section'     => 'custom_code',
		'default'     => ' ',
		'priority'    => 20,
		'choices'     => array(
			'language' => 'javascript',
			'theme'    => 'monokai',
			'height'   => 50,
		),
	) );

	Kirki::add_field( 'lathom', array(
		'type'        => 'code',
		'settings'    => 'javascript_footer_code',
		'label'       => esc_attr__( 'Insert custom &lt;footer&gt;-Javascript', 'lathom' ),
		'help'        => esc_attr__( 'Pure Javascript please. It will get wrapped in script-Tags automagically.', 'lathom' ),
		'description' => esc_attr__( 'Insert your Google-Adsense Snippet or whatever you want. Please notice that this Javascript will be embedded just before the closing body of the document, so jQuery calls should just be fine.', 'lathom' ),
		'section'     => 'custom_code',
		'default'     => ' ',
		'priority'    => 20,
		'choices'     => array(
			'language' => 'javascript',
			'theme'    => 'monokai',
			'height'   => 50,
		),
	) );
}
?>
