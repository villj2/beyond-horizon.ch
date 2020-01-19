<?php

return function($site, $pages, $page) {

	$debug = "";

	// Get all CMS continent entries
	$continents = page('posts')->children()->sortBy('sort', 'desc');

	// Get query string continents
	$qsContinents = array();
	if(isset($_GET["continents"])) {
		$qsContinents = explode(',', $_GET["continents"]);
	}
	
	// Get query string countries
	$qsCountries = array();
	if(isset($_GET["countries"])) {
		$qsCountries = explode(',', $_GET["countries"]);
	}

	$countries = array(); //[[<countrycode>, <title>, <continent>, <url>, "active"|""], [...]]

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

				$countryCode = strtolower($country->countrycode());
				$countryDict = array();
				$countryDict["countrycode"] = $countryCode;
				$countryDict["title"] = $country->title();
				$countryDict["continent"] = $continentUID;
				$countryDict["url"] = createCountryURL($countryCode, $qsCountries, $qsContinents);
				$countryDict["active"] = in_array($countryCode, $qsCountries) ? "active" : "";

				array_push($countries, $countryDict);
			}
		}
		else
		{
			$continentDict[$continentUID."-isActive"] = "";
		}
	}

	// Grab galleries


	return compact('continentDict', 'countries', 'debug');
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

    	// TODO create country query string without countries belonging to just removed continent
	}
	else
	{
		array_push($qsContinents, $currentContinentUID);
	}
	
	$url = "?continents=" . trim(implode(',', $qsContinents), ',');

	return $url;
}

function createCountryURL($countryCode, $qsCountries, $qsContinents) {

	$urlContinentPrefix = createContinentURL("", $qsContinents);

	$url = "";
	$key = array_search($countryCode, $qsCountries);

	if(is_int($key))
	{
    	unset($qsCountries[$key]);
    	// TODO re-index array?
	}
	else
	{
		array_push($qsCountries, $countryCode);
	}

	$url = $urlContinentPrefix . "&countries=" . trim(implode(',', $qsCountries), ',');

	return $url;
}