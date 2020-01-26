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

	function createContinentURL($currentContinentUID, $qsContinents, $qsCountries) {

		$url = "";
		$key = array_search($currentContinentUID, $qsContinents);
		$urlCountries = "";

		// If current continent exists in query-string continents, remove it from array. Because when clicking on already active continent, the own continent should disappear.
		// Otherwise add to array.
		if(is_int($key))
		{
	    	unset($qsContinents[$key]);
		}
		else
		{
			array_push($qsContinents, $currentContinentUID);
		}

		// If no countries are given, call probably comes from "createCountryURL" and therefore doesn't need countries querystrings.
		if(count($qsCountries) > 0)
    	{
			// Create country query string without countries belonging to just removed continent
	    	$countriesBelongingToContinent = page('posts')->find($currentContinentUID)->children();

	    	foreach($countriesBelongingToContinent as $c)
	    	{
	    		$keyCountry = array_search($c->countrycode() , $qsCountries);
	    		if(is_int($keyCountry))
				{
			    	unset($qsCountries[$keyCountry]);
				}
	    	}

	    	$urlCountries = '&countries=' . implode(',', $qsCountries);
    	}
		
		$url = "?continents=" . trim(implode(',', $qsContinents), ',') . $urlCountries;

		return $url;
	}

	function createCountryURL($countryCode, $qsCountries, $qsContinents) {

		$urlContinentPrefix = createContinentURL("", $qsContinents, []);

		$url = "";
		$key = array_search($countryCode, $qsCountries);

		if(is_int($key))
		{
	    	unset($qsCountries[$key]);
		}
		else
		{
			array_push($qsCountries, $countryCode);
		}

		$url = $urlContinentPrefix . "&countries=" . trim(implode(',', $qsCountries), ',');

		return $url;
	}

?>