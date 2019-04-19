<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Genesis\Templates
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/genesis/
 */

// This file handles pages, but only exists for the sake of child theme forward compatibility.

if(is_page("Folklore")){
    require_once "components/folklore/folklore_display.php";
  	remove_action( 'genesis_loop', 'genesis_do_loop' );
    add_action("genesis_loop", 'wi_display_folklore');
}
//
// function do_folklore_page_loop(){
//   echo "This did somehting atleast \n";
//   // $args_meta = array(
//   //
//   // );
//   $args = array(
//     "post_type" => "folklore_entries"
//
//   );
//   //$folklore = get_posts($args);
//   $folklore = testing();
//
//   foreach($folklore as $post){
//     $read_more_url = $post->post_url;
//     $read_more_link = " <a href='". $read_more_url . "' alt='read more'>...</a>";
//     echo "<h1>" . $post->post_title . "</h1>";
//     echo "<img src='" . $post->thumbnail_url . "' alt='this should be a link to the image' />";
//     echo "<p>" . shorten_string($post->post_content , 30). $read_more_link . "</p>";
//     echo "</hr>";
//   }
//
//   // $name = $folklore[0]->post_title;
//   // $text = $folklore[0]->post_content;
//   //$thumbnail = $folklore[0]->post_title;
//   // echo "<h1>" . $name . "</h1>";
//   // echo "<p>" . $text . "</p>";
// }
//
// function testing(){
//   global $wpdb;
//   $q = $wpdb->get_results("select p.post_title, p.post_content,p.post_name,  p.guid AS post_url, sp.guid AS thumbnail_url
// from wp_posts p
// inner join wp_postmeta pm on p.id = pm.post_id
// inner join wp_posts sp on sp.id = CAST( pm.meta_value AS unsigned)
// where p.post_type = 'folklore_entries' and meta_key = '_thumbnail_id'; ;");
//   return $q;
// }
//
// function shorten_string($string, $wordsreturned)
// {
//     $retval = $string;  //  Just in case of a problem
//     $array = explode(" ", $string);
//     /*  Already short enough, return the whole thing*/
//     if (count($array)<=$wordsreturned)
//     {
//         $retval = $string;
//     }
//     /*  Need to chop of some words*/
//     else
//     {
//         array_splice($array, $wordsreturned);
//         $retval = implode(" ", $array);
//     }
//     return $retval;
// }


genesis();
