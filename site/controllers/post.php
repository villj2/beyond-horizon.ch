<?php

return function($site, $pages, $page) {

	$siblings = $page->siblings(true)->filterBy('picsonly', '!=', '1')->sortby('sort', 'desc');
	$next = '';
	$prev = '';

	$found = false;
	foreach ($siblings as $key => $value) {

		if($value == $page) {
			$found = true;
			continue;
		}

		if($found) {
			$next = $value->url();
			break;
		}

		$prev = $value->url();
	}

	return compact('siblings', 'prev', 'next');
};