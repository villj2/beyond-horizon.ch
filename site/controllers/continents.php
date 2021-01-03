<?php

return function($site, $pages, $page) {

	$debug = "<br />";

	// Get all CMS continent entries
	$continents = page('posts')->children()->visible()->sortBy('sort', 'desc');

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
		$continentDict[$continentUID."-url"] = createContinentURL($continentUID, $qsContinents, $qsCountries); // Method declared in /plugins/pages-methods.php

		$continentTitleWritten = false;

		// Check if looped continent exists in selected continents (from map)
		if(in_array($continentUID, $qsContinents))
		{
			$showInstructions = false;

			$continentDict[$continentUID."-isActive"] = "active";

			// Get all COUNTRIES from selected continent
			foreach($continent->children()->visible()->sortBy('sort', 'desc') as $country)
			{
				// Check if at least one child has not picsonly flag
				$posts = array();
				$picsonly = true;
				foreach($country->children()->visible()->sortBy('sort', 'desc') as $post)
				{
					if(!$post->picsonly()->bool())
					{
						array_push($posts, $post);
					}

					$picsonly &= $post->picsonly()->bool();
				}

				if($picsonly)
				{
					continue;
				}

				$countryCode = strtolower($country->countrycode());
				$countrySelected = in_array($countryCode, $qsCountries);
				$countryDict = array();
				$countryDict["title"] = $country->title();
				$countryDict["url"] = createCountryURL($countryCode, $qsCountries, $qsContinents); // Method declared in /plugins/pages-methods.php
				$countryDict["active"] = $countrySelected ? "active" : "";

				array_push($countries, $countryDict);

				// Get galleries from selected country
				if($countrySelected)
				{
					if(!$continentTitleWritten)
					{
						$continentTitleWritten = true;
						$galleryEntriesHtml .= '<div class="row">
													<div class="col-md-12">
														<h1>' . $continent->titlefrontend() . '</h1>
													</div>
												</div>';
					}

					$galleryEntriesHtml .= '<div class="row">
												<div class="col-md-12">
													<h2>' . $country->title() . '</h2>
												</div>
											</div>';

					$galleryEntriesHtml .= '<div class="row teaser">';

					foreach($posts as $post)
					{
						$galleryEntriesHtml .= '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 col-xxs-12">
									          		<div class="teaser-image-container">
														<p class="posts-entry">
												      		<img src="' . $post->contentURL() . '/' . $post->imageteaser() . '" class="teaser-image" alt="' . $post->title() . '" title="' . $post->title() . '">
											              	<a href="' . $post->url() . '">
												                <span class="darkener"></span>
												                <span class="helper"></span>
												                <span class="teaser-text">' . $post->title() . '</span>
											              	</a>
														</p>
									          		</div>
									          	</div>';
					}

					$galleryEntriesHtml .= '</div>';
				}
			}
		}
		else
		{
			$continentDict[$continentUID."-isActive"] = "";
		}
	}

	return compact('continentDict', 'countries', 'galleryEntriesHtml', 'showInstructions', 'debug');
};