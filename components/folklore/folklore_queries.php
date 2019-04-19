<?php

/**
 * Genesis Sample.
 *
 * This file stores the queries that are needed to pull the folklore content for folklore display.
 *
 *
 * @package Genesis Sample
 * @author  Travis Dumont
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */



$FOLKLORE_QUERY = "select p.post_title, p.post_content,p.post_name,  p.guid AS post_url, sp.guid AS thumbnail_url
from wp_posts p
inner join wp_postmeta pm on p.id = pm.post_id
inner join wp_posts sp on sp.id = CAST( pm.meta_value AS unsigned)
where p.post_type = 'folklore_entries' and meta_key = '_thumbnail_id';";
