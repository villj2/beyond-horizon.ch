<?php

return function($site, $pages, $page) {

	// Get all CMS posts
	$posts = array();
	foreach(page('posts')->children()->sortBy('sort', 'desc') as $continent)
	{
		foreach($continent->children()->visible()->sortBy('sort', 'desc') as $country)
		{
			foreach($country->children()->visible()->filterBy('picsonly', '!=', '1')->sortBy('sort', 'desc') as $post)
			{
				array_push($posts, $post);
			}
		}
	}






	// TODO Sort posts by date
	foreach($posts as $post)
	{
		//echo(date("d-m-Y", $post->date())) . " - ";
	}

	echo("---------------------- after sort ----------------------");

	usort($posts, "compare_function");

	foreach($posts as $post)
	{
		//echo(date("d-m-Y", $post->date())) . " - ";
	}






	$currentUID = page()->uid();
	$found = false;
	$older;
	$newer;
	foreach($posts as $p)
	{
		if($found)
		{
			$older = $p;
			break;
		}

		if($p->uid() == $currentUID)
		{
			$found = true;
		}
		else
		{
			$newer = $p;
		}
	}

	return compact('older', 'newer');
};

function compare_function($a,$b) {

	echo($a->date());
	echo("/");
	echo($b->date());
	echo("<br />");
 
    $a_timestamp = strtotime($a->date()); // convert a (string) date/time to a (int) timestamp
    $b_timestamp = strtotime($b->date());

    // new feature in php 7
    return $a_timestamp <=> $b_timestamp;
};

function compareByTimeStamp($time1, $time2) 
{ 
    if (strtotime($time1->date()) < strtotime($time2->date())) 
        return 1; 
    else if (strtotime($time1->date()) > strtotime($time2->date()))  
        return -1; 
    else
        return 0; 
} 