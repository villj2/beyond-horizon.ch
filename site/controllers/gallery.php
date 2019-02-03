<?php

return function($site, $pages, $page) {

	$continents = $pages->index()->visible()->filterBy('intendedTemplate', 'continent')->sortBy('sort', 'desc');
	$hasEntriesDict = array();
	$galleryIndex = 0;

	foreach($continents as $continent) {

		$hasEntriesDict[strtolower($continent->title())] = $continent->children()->count() > 0 ? 'has-entries' : '';
	}

	return compact('continents', 'hasEntriesDict', 'galleryIndex');
};