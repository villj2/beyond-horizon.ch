<?php

return function($site, $pages, $page) {

	/* Last gallery entries in order to set URL on map to /gallery */

  $filterDict = array();
  $continents = array();
  $countries = array();

  foreach ($page->parent()->index()->posts(true)->sortBy('date', 'desc')->limit(2) as $post)
  {
    $continent = $post->parent()->parent()->uid();
    $country = strtolower($post->parent()->countrycode());

    if(!in_array($continent, $continents))
    {
      // Adding continent if not already in dict
      array_push($continents, $continent);
    }

    if(!in_array($country, $countries))
    {
      // Adding country if not already in dict
      array_push($countries, $country);
    }
  }

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

  function addToStructure($p, $field, $data = array())
  {
    $fieldData = $p->$field()->yaml();
    $fieldData[] = $data;
    $fieldData = yaml::encode($fieldData);
    $p->update(array(
      $field => $fieldData
    ));
  }

  $alert = null;

  if(r::is('post') && get('register'))
  {
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
    //$data['email'] = '';

    // some of the data is invalid
    if($invalid = invalid($data, $rules, $messages)) {
      $alert = $invalid;
    } else {

      // everything is ok, let's try to create a new registration
      try {

        addToStructure($page->parent()->find('newsletter'), 'registrations', $data);

        $success = $page->textnewslettersuccess();
        $data = array();

      } catch(Exception $e) {
        echo 'Anmeldung fehlgeschlagen: ' . $e->getMessage();
      }
    }
  }

	return compact('filterString', 'lastLocations', 'galleryTeasers', 'alert', 'data', 'success', 'continents', 'countries');
};