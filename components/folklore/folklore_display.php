<?php
/**
 * Genesis Sample.
 *
 * This file is used to hold the render function for the folk lore cards.
 * These cards have basicl navigation and functionality to display the images and
 * link to the shop pages as well as the more indepth lore pages
 *
 *
 * @package Genesis Sample
 * @author  Travis Dumont
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */

function wi_display_folklore(){
  require_once "folklore_queries.php";

 	$display = '<article class="wi-folklore">';
 	$display .= '<h1>Louisiana Folklore Collection</h1>';
  $display .= '<h3>Click the image below to discover more.</h3>';

  $folklore = query_database($FOLKLORE_QUERY); // this is coming from the folklore_queries.php file



    $display .= '<div class="wi-gallery"  data-featherlight-gallery data-featherlight-filter="a">';
   	$lightbox = "<section >";
   	$counter = 1;
    foreach($folklore as $post){
      $read_more_url = $post->post_url;
      $read_more_link = " <a href='". $read_more_url . "' alt='read more'>...</a>";
      //$discription = get_post($image)->post_content;
      $display .= "<section class='wi-gallery-img' data-featherlight='#fl".(string) $counter ."'>";
      $display .=  "<img src='" . $post->thumbnail_url . "' alt='this should be a link to the image' />";
      $display .= "</section>";

      $lightbox .= "<div id='fl".(string) $counter ."' class='lightbox'>";
      $lightbox .= "<img src='" . $post->thumbnail_url . "' class='lightbox-image' alt='this should be a link to the image' />";
      $lightbox .= "<p>" . shorten_string($post->post_content , 30). $read_more_link . "</p>";
      $lightbox .= " <div class='lightbox-btn-container'> ";
      $lightbox .= " <a href='" . $post->post_url . "' class='lightbox-btn'>View Lore</a> ";
      $lightbox .= " <a href='" . $post->thumbnail_url . "' class='lightbox-btn'>Buy Now</a> ";
      $lightbox .= " </div> ";
      $lightbox .= " </div> ";
      $counter++;
    }
   	 $display .= '</div></article>'; //closing div tags for class: wi-folklore and wi-gallery
     $lightbox .= '</section>';
      //* 5) render the gallery
   	 echo $display;
   	 echo $lightbox;
}



/**
*  This is a general purpose query method. You pass in a string query that you want
*  to run on the database and it returns an array of results.
*
* @param1:   $query:  The String query that you want to run.
*
* @returns:  The results of the query in an array form.
*/

 function query_database($query){
   global $wpdb;
   $results = $wpdb->get_results($query);
   return $results;
 }




/*
*  This function is used to grab just the firxt x words of a string.  It is being
*  used to make short discriptions of the folklore pages so that we can make ...
*  links to the rest of the blog page.
*
* @param1 String : The string that you want to shorten
* @param2 $wordsreturned:   number of words from the begining of String that you
*  want returend.
*
* @return:  The shortened string, x words in length.
*/
 function shorten_string($string, $wordsreturned)
 {
     $retval = $string;  //  Just in case of a problem
     $array = explode(" ", $string);
     /*  Already short enough, return the whole thing*/
     if (count($array)<=$wordsreturned)
     {
         $retval = $string;
     }
     /*  Need to chop of some words*/
     else
     {
         array_splice($array, $wordsreturned);
         $retval = implode(" ", $array);
     }
     return $retval;
 }







 // foreach($folklore as $post){
 //   $read_more_url = $post->post_url;
 //   $read_more_link = " <a href='". $read_more_url . "' alt='read more'>...</a>";
 //   //$discription = get_post($image)->post_content;
 //   $display .= "<section class='wi-gallery-img thumbnail gallery' data-featherlight='#fl".(string) $counter ."'>";
 //   $display .=  "<img src='" . $post->thumbnail_url . "' alt='this should be a link to the image' />";
 //   $display .= "</section>";
 //
 //   $lightbox .= "<div id='fl".(string) $counter ."' class='lightbox'>";
 //   $lightbox .= "<img src='" . $post->thumbnail_url . "' class='lightbox-image' alt='this should be a link to the image' />";
 //   $lightbox .= "<p>" . shorten_string($post->post_content , 30). $read_more_link . "</p>";
 //   $lightbox .= " <div class='lightbox-btn-container'> ";
 //   $lightbox .= " <a href='" . $post->post_url . "' class='lightbox-btn'>View Lore</a> ";
 //   $lightbox .= " <a href='" . $post->thumbnail_url . "' class='lightbox-btn'>Buy Now</a> ";
 //   $lightbox .= " </div> ";
 //   $lightbox .= " </div> ";
 //   $counter++;
 // }
