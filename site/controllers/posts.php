<?php

return function($site, $pages, $page) {

	$categories = $page->children()->visible();

	return compact('categories');
};