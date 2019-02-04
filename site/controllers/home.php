<?php

return function($site, $pages, $page) {

	/* JSON of last gallery entries in order to set filters on map at /gallery */
	//example of $filterString: [{"id":"oceania", "countries":["nz", "au"]}, {"id":"asia", "countries":["hk", "jp"]}]

    $filterDict = array();

    /*foreach ($page->parent()->index()->visible()->filterBy('template', 'post')->sortBy('date', 'desc')->limit(2) as $post) {*/
    foreach ($page->parent()->index()->posts(true)->sortBy('date', 'desc')->limit(2) as $post) {

      $continent = strtolower($post->parent()->parent()->title());
      $country = strtolower($post->parent()->countrycode());

      if(!array_key_exists($continent, $filterDict)) {

        // Adding continent if not already in dict
        $filterDict[$continent] = $country;
      }
      else {

        if(\strpos($filterDict[$continent], $country) !== false) {
          // country already added
        }
        else {

          // Add new country to already existing continent with at least 1 country-entry
          $filterDict[$continent] = $filterDict[$continent] . "|" . $country;
        }
      }

    }

    $indexContinent = 0;
    $filterString = '[';

    foreach ($filterDict as $key=>$value) {

      //echo $key . " - " . $value . "<br />";

      if($indexContinent > 0) {
        $filterString .= ', ';
      }

      $filterString .= '{"id":"' . $key . '", "countries":[';

      // split countries
      $indexCountry = 0;
      $explodedCountries = explode('|', $value);
      foreach ($explodedCountries as $country) {

        if($indexCountry > 0) {
          $filterString .= ', ';
        }

        $filterString .= '"' . $country . '"';

        $indexCountry++;
      }

      $filterString .= ']}';
      $indexContinent++;
    }

    $filterString .= ']';







    /* Get last two locations of posts */
    $lastLocations = array();
    foreach ($page->parent()->index()->posts(true)->sortBy('date', 'desc') as $post) {

    	// replace regular spaces with non breakable spaces
    	$location = str_replace(' ', "\xc2\xa0", $post->title()->html());

    	if(in_array($location, $lastLocations)) {
    		continue;
    	}

    	array_push($lastLocations, $location);

    	if(sizeof($lastLocations) >= 2) {
    		break;
    	}
    }





    /* Get gallery teaser pictures */
    $galleryTeasers = array();
    array_push($galleryTeasers, $page->contentURL() . '/' . $page->galleryteaser1());
    array_push($galleryTeasers, $page->contentURL() . '/' . $page->galleryteaser2());
    array_push($galleryTeasers, $page->contentURL() . '/' . $page->galleryteaser3());
    array_push($galleryTeasers, $page->contentURL() . '/' . $page->galleryteaser4());
    array_push($galleryTeasers, $page->contentURL() . '/' . $page->galleryteaser5());
    array_push($galleryTeasers, $page->contentURL() . '/' . $page->galleryteaser6());
    



	return compact('filterString', 'lastLocations', 'galleryTeasers');
};