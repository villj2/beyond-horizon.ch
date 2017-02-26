<?php

kirbytext::$tags['polaroid'] = array(
  'attr' => array(
    'type'
  ),
  'html' => function($tag) {

    $url     = $tag->attr('polaroid');
    $type    = $tag->attr('type');
    $file    = $tag->file($url);

    //return '<a href="' . $url . '/' . $article . '">' . $text . '</a>';

    $url = $file ? $file->url() : url($url);

    $alignment = '';
    $bgimage = '/Frontend/img/polaroid_1.png';

    switch ($type) {
	    case 2:
	    	$alignment = 'middle';
	      $bgimage = '/Frontend/img/polaroid_2.png';
	      break;
	    case 3:
	    	$alignment = 'right';
	      $bgimage = '/Frontend/img/polaroid_3.png';
	      break;
	}

    return '<div class="col-sm-4">
              <div class="polaroid-container">
                <div class="polaroid-background-container">
                  <img class="polaroid-background" src="' . $bgimage . '" />
                  <img class="polaroid-image ' . $alignment . '" src="' . $url . '" />
                </div>
              </div>
            </div>';

  }
);

kirbytext::$tags['polaroidstart'] = array(
  'html' => function($tag) {
    return '<div class="row polaroid-section">';
  }
);

kirbytext::$tags['polaroidend'] = array(
  'html' => function($tag) {
    return '</div>';
  }
);

kirbytext::$tags['polaroidabout'] = array(
  'html' => function($tag) {

    $url     = $tag->attr('polaroidabout');
    $file    = $tag->file($url);

    $url = $file ? $file->url() : url($url);

    return '<img src="' . $url . '" class="polaroid" alt="Julien &amp; Karin" title="Julien &amp; Karin" />';
  }
);