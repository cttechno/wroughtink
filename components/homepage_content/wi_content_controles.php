<?php

//echo print_r(wi_list_pages());
add_action("customize_register", "wi_homepage_categories_customizer_controles");
function wi_homepage_categories_customizer_controles($wp_customize){

  //@param1: tag for the section,
  //@param2:  settings
  $wp_customize->add_section('wi_homepage_categories', array(
    'title' => esc_html__("Home Page Category", 'wroughtink' ),
    'priority' => 150
  ));

  // Hero Title Section
  //@param1:  tag that is entered into the database.  This is what we reference to edit
  //@param2:  settins array
  $wp_customize->add_setting('wi_homepage_category_btn', array(
    'default' => "Shop Now",
    'sanitize_callback' => 'wp_filter_nohtml_kses'
  ));

  $wp_customize->add_control(new WP_Customize_Control(
    $wp_customize,
    'wi_homepage_category_btn',
    array(
      'label' => esc_html__("Homepage Category Button", "wroughtink"),
      'section' => "wi_homepage_categories",
      'settings' => "wi_homepage_category_btn",
      'type' => "text"
    )
  ));
}
