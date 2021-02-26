<?php

return function($site, $pages, $page) {

	// Get all CMS posts
	$posts = array();
	foreach(page('posts')->children() as $continent)
	{
		foreach($continent->children()->visible() as $country)
		{
			foreach($country->children()->visible()->filterBy('picsonly', '!=', '1') as $post)
			{
				array_push($posts, $post);
			}
		}
	}
	
	// Sort by date
	usort($posts, "compare_function");

	$currentUID = page()->uid();
	$found = false;
	$older;
	$newer;
	foreach($posts as $p)
	{
		if($found)
		{
			$newer = $p;
			break;
		}

		if($p->uid() == $currentUID)
		{
			$found = true;
		}
		else
		{
			$older = $p;
		}
	}

	return compact('older', 'newer');
};

function compare_function($a,$b) {

    // new feature in php 7
    return $a->date() <=> $b->date();
};