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

	$countries = array();
	$continentDict = array();
	$showInstructions = true;
	$galleryEntriesHtml = "";

	// Loop over CONTINENTS
	foreach($continents as $continent)
	{
		$continentUID = strtolower($continent->uid());
		$continentDict[$continentUID."-hasEntries"] = $continent->children()->visible()->count() > 0 ? 'has-entries' : '';
		$continentDict[$continentUID."-url"] = createContinentURL($continentUID, $qsContinents);

		$continentTitleWritten = false;

		// Check if looped continent exists in selected continents (from map)
		if(in_array($continentUID, $qsContinents))
		{
			$showInstructions = false;

			$continentDict[$continentUID."-isActive"] = "active";

			// Get all COUNTRIES from selected continent
			foreach($continent->children()->visible() as $country)
			{
				$countryCode = strtolower($country->countrycode());
				$countrySelected = in_array($countryCode, $qsCountries);
				$countryDict = array();
				$countryDict["title"] = $country->title();
				$countryDict["url"] = createCountryURL($countryCode, $qsCountries, $qsContinents);
				$countryDict["active"] = $countrySelected ? "active" : "";

				array_push($countries, $countryDict);

				// Get galleries from selected country
				if($countrySelected)
				{
					if(!$continentTitleWritten)
					{
						$continentTitleWritten = true;
						$galleryEntriesHtml .= '<div class="row"><div class="col-md-12"><h1>' . $continent->title() . '</h1>';
					}

					foreach($country->children()->visible() as $post)
					{
						$galleryEntriesHtml .= '<div class="gallery-title-container">
													<h2>' . $post->title() . '</h2>
													<h4>' . $country->title() . '</h4>';

						if(!$post->picsonly()->bool())
						{
							$galleryEntriesHtml .= '<a href="'. $post->url() . '" target="_self" title="Zum Beitrag">
														<img src="/assets/images/link.png">
													</a>';
						}

						$galleryEntriesHtml .= '</div>
												<div class="grid">
													<div class="grid-sizer"></div>
													<div class="gutter-sizer"></div>';

						$gallery = $post->children()->filterBy('intendedTemplate', 'postgallery');

						foreach($gallery->images()->sortBy('sort', 'asc') as $image)
						{
                            if(!strpos($image->filename(), 'preview'))
                            {
                            	$imgUrl = $image->url();
                            	$imgUrlPreview = str_replace(".jpg", "_preview.jpg", $imgUrl);

								$galleryEntriesHtml .= '
									<div class="grid-item">
					                  <a href="' . $imgUrl . '" data-fancybox="images" data-caption="' . $image->description() . '">
					                  	<img src="' . $imgUrlPreview . '" alt="" />
					                  </a>
					                </div>';
                            }
						}

						// Close grid div
						$galleryEntriesHtml .= "</div>";
					}
				}
			}

			if($continentTitleWritten)
			{
				$galleryEntriesHtml .= "</div></div>";
			}
		}
		else
		{
			$continentDict[$continentUID."-isActive"] = "";
		}

	}


	return compact('continentDict', 'countries', 'galleryEntriesHtml', 'showInstructions', 'debug');
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