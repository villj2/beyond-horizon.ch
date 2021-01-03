<?php

return function($site, $pages, $page) {

	class PinStruct {
	    public $title;
	    public $img;
	    public $lat;
	    public $lng;
	    public $url;
	    public $date;
	}

	$pinArray = array();

	foreach($page->parent()->index()->posts(true)->sortBy('date', 'asc') as $post) {

		$pin = new PinStruct();
		$pin->title = $post->title()->value();
		$pin->img = $post->contentURL() . '/' . $post->googlemapsimage();
		$pin->lat = $post->lat()->value();
		$pin->lng = $post->lng()->value();
		$pin->date = $post->date('F d, Y');
		$pin->twolines = $post->googlemapstwolines()->value();

		if($post->picsonly() == "1")
		{
			if(!empty($post->lat()->value()))
			{
				$countrycode = $post->parent()->countrycode();
				$continent = $post->parent()->parent()->uid();
				$pin->url = "/gallery?continents=" . $continent . "&countries=" . $countrycode;
			}
		}
		else
		{
			$pin->url = $post->url();
		}

		array_push($pinArray, $pin);
	}

	$pinJson = json_encode($pinArray);

	return compact('pinJson');
};