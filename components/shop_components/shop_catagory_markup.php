<?php


function shop_catagory($category){
  $display = "<section class='wi-shop-category'>";
  $display .= "<h2>". $category->name ."</h2>";
  echo $display;
  woocommerce_subcategory_thumbnail( $category );
  //$display .= woocommerce_subcategory_thumbnail( $category );
  $display = "<a class='wi-cat-shop-btn' href='".get_term_link((int) $category->term_taxonomy_id, "product_cat")."' alt = 'testing'>". get_theme_mod("wi_homepage_category_btn") ."</a>";
  $display .= "</section>";
  echo $display;
}
