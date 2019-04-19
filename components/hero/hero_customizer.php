<?php
/**
 * Wrought Ink Custom Theme
 *
 * @author  Travis Dumont
 * @license GPL-2.0-or-later
 *
 * Enable Customizer edits for the hero section
*/
//echo print_r(wi_list_pages());
add_action("customize_register", "wi_hero_customizer_controles");
function wi_hero_customizer_controles($wp_customize){

  //@param1: tag for the section,
  //@param2:  settings
  $wp_customize->add_section('wi_hero_section', array(
    'title' => esc_html__("Hero Section", 'genesis-sample' ),
    'priority' => 150
  ));

  // Hero Title Section
  //@param1:  tag that is entered into the database.  This is what we reference to edit
  //@param2:  settins array
  $wp_customize->add_setting('wi_hero_title', array(
    'default' => "Dredging up Nola's Darkside",
    'sanitize_callback' => 'wp_filter_nohtml_kses'
  ));

  $wp_customize->add_control(new WP_Customize_Control(
    $wp_customize,
    'wi_hero_title',
    array(
      'label' => esc_html__("Headline", "genesis-sample"),
      'section' => "wi_hero_section",
      'settings' => "wi_hero_title",
      'type' => "text"
    )
  ));

  // Hero Smaller Print
  $wp_customize->add_setting('wi_hero_text', array(
    'default' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.",
    'sanitize_callback' => 'wp_filter_nohtml_kses'
  ));

  $wp_customize->add_control(new WP_Customize_Control(
    $wp_customize,
    'wi_hero_text',
    array(
      'label' => esc_html__("Small Text", "genesis-sample"),
      'section' => "wi_hero_section",
      'settings' => "wi_hero_text",
      'type' => "text"
    )
  ));


  // Hero CTA ButtonText
  $wp_customize->add_setting('wi_hero_btn', array(
    'default' => "Shop Now",
    'sanitize_callback' => 'wp_filter_nohtml_kses'
  ));

  $wp_customize->add_control(new WP_Customize_Control(
    $wp_customize,
    'wi_hero_btn',
    array(
      'label' => esc_html__("Button Text", "genesis-sample"),
      'section' => "wi_hero_section",
      'settings' => "wi_hero_btn",
      'type' => "text"
    )
  ));

  // Hero CTA Button page selector.
  $wp_customize->add_setting('wi_hero_btn_link', array(
    'default' => "Call to Action Page Link",
    'sanitize_callback' => 'wp_filter_nohtml_kses'
  ));

  $wp_customize->add_control(new WP_Customize_Control(
    $wp_customize,
    'wi_hero_btn_link',
    array(
      'label' => esc_html__("Call to Action Button Page Link", "genesis-sample"),
      'section' => "wi_hero_section",
      'settings' => "wi_hero_btn_link",
      'type' => "dropdown-pages"
    )
  ));

  // Hero Background image selector
  $wp_customize->add_setting('wi_hero_background_image', array(
    'sanitize_callback' => 'wp_filter_nohtml_kses'
  ));

  $wp_customize->add_control(new WP_Customize_Image_Control(
    $wp_customize,
    'wi_hero_background_image',
    array(
      'label' => esc_html__("Hero Background Image Selector", "genesis-sample"),
      'section' => "wi_hero_section",
      'settings' => "wi_hero_background_image"
    )
  ));

}
