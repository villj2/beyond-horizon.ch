<?php

return function($site, $pages, $page) {

	$debug = "";

	// Get all continent entries
	$continents = page('posts')->children()->sortBy('sort', 'desc');

	// Get query strings
	$qsContinents = array();
	$qsContinentsString = "";
	if(isset($_GET["continents"])) {
		$qsContinents = explode(',', $_GET["continents"]);
		$qsContinentsString = $_GET["continents"];
	}
	
	$qsCountries = array();
	if(isset($_GET["countries"])) {
		$qsCountries = explode(',', $_GET["countries"]);
	}

	$countries = array(); //[[ma, Marokko, <url>], [us, USA, <url>], [cr, Costa Rica, <url>]]

	$continentDict = array();

	// Loop over CONTINENTS
	foreach($continents as $continent) {

		$continentUID = strtolower($continent->uid());
		$continentDict[$continentUID."-hasEntries"] = $continent->children()->visible()->count() > 0 ? 'has-entries' : '';
		$continentDict[$continentUID."-url"] = createContinentURL($continentUID, $qsContinents);
		
		// Check if looped continent exists in selected continents (from map)
		if(in_array($continentUID, $qsContinents)) {

			$continentDict[$continentUID."-isActive"] = "active";

			// Get all COUNTRIES from selected continent
			foreach($continent->children()->visible() as $country) {

				array_push($countries, [$country->countrycode(), $country->title(), "/goat"]); //[countrycode, title, url]
			}
		}
		else
		{
			$continentDict[$continentUID."-isActive"] = "";
		}
	}

	return compact('continents',
		'qsContinents',
		'continentDict',
		'countries',
		'debug');
};

function createContinentURL($currentContinentUID, $qsContinents) {

	$url = "";
	$key = array_search($currentContinentUID, $qsContinents);

	// If current continent exists in query-string continents, remove it from array. Because when clicking on already active continent, the own continent should disappear.
	// Otherwise add to array.
	if(is_int($key))
	{
    	unset($qsContinents[$key]);
    	// TODO re-index array?
	}
	else
	{
		array_push($qsContinents, $currentContinentUID);
	}
	
	$url = "?continents=" . ltrim(implode(',', $qsContinents), ',');

	return $url;
}