<?php

return function($site, $pages, $page) {

	$continents = $page->children()->visible();
	$mapsvg = $page->map()->text();

	// TODO loop through children, check if has entries, create dictionary with page-name as key and pass to page
	// $page->children()

	return compact('continents', 'mapsvg');
};