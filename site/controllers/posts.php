<?php

return function($site, $pages, $page) {

	$continents = $page->children()->visible();
	$mapsvg = $page->map()->text();

	return compact('continents', 'mapsvg');
};