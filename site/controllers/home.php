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
    



    /* Newsletter registration */

    function addToStructure($p, $field, $data = array()) {
    $fieldData = $p->$field()->yaml();
    $fieldData[] = $data;
    $fieldData = yaml::encode($fieldData);
    $p->update(array(
      $field => $fieldData
    ));
  }

  $alert = null;

  if(r::is('post') && get('register')) {

    if(!empty(get('website'))) {
      // lets tell the bot that everything is ok
      go($page->url());
      exit;
    }

    $date = new DateTime();
    $date->setTimezone(new DateTimeZone('Europe/Zurich'));

    $data = array(
      'firstname' => get('firstname'),
      'lastname'  => get('lastname'),
      'email'     => get('email'),
      'date'      => $date->format('Y-m-d H:i:s')
    );

    $rules = array(
      'firstname' => array('required'),
      'lastname'  => array('required'),
      'email'     => array('required', 'email'),
      'date'      => array('required')
    );

    $messages = array(
      'firstname' => 'Bitte Vorname angeben',
      'lastname'  => 'Bitte Nachname angeben',
      'email'     => 'Bitte eine gültige Email Adresse angeben',
      'date'      => 'Date is missing'
    );

    //$data['firstname'] = '';
    $data['email'] = '';

    // some of the data is invalid
    if($invalid = invalid($data, $rules, $messages)) {
      $alert = $invalid;
    } else {

      // everything is ok, let's try to create a new registration
      try {

        addToStructure($page->parent()->find('newsletter'), 'registrations', $data);

        $success = 'Vielen Dank für die Anmeldung. Schon bald kriegst du spannende News!';
        $data = array();

      } catch(Exception $e) {
        echo 'Anmeldung fehlgeschlagen: ' . $e->getMessage();
      }
    }
  }

	return compact('filterString', 'lastLocations', 'galleryTeasers', 'alert', 'data', 'success');
};