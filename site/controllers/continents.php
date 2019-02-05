<?php

return function($site, $pages, $page) {

	$continents = $page->children()->visible()->filterBy('intendedTemplate', 'continent')->filterBy('hideonmap', '<', '1'); /**/
	$hasEntriesDict = array();

	foreach($continents as $continent) {

		$hasEntriesDict[strtolower($continent->title())] = $continent->children()->visible()->count() > 0 ? 'has-entries' : '';
	}

	return compact('continents', 'hasEntriesDict');
};