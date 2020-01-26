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