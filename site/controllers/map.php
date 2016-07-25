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

	foreach($page->parent()->index()->filterBy('template', 'post') as $post) {

		$pin = new PinStruct();
		$pin->title = $post->title()->value();
		$pin->img = $post->contentURL() . '/' . $post->imageteaser();
		$pin->lat = $post->lat()->value();
		$pin->lng = $post->lng()->value();
		$pin->url = $post->url();
		$pin->date = $post->date('F d, Y');

		array_push($pinArray, $pin);
	}

	$pinJson = json_encode($pinArray);

	return compact('pinJson');
};