<?php

	pages::$methods['posts'] = function($pages, $includePicsOnly = false) {

		if($includePicsOnly)
		{
			return $pages->visible()->filterBy('template', 'post');
		}
		else
		{
			return $pages->visible()->filterBy('template', 'post')->filterBy('picsonly', '!=', '1');
		}

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

?>