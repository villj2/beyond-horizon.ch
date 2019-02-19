<?php

kirbytext::$tags['twocolumnpics'] = array(
  'attr' => array(
    'pic1', 'pic2'
  ),
  'html' => function($tag) {

    $layout     = $tag->attr('twocolumnpics');

    $url1       = $tag->attr('pic1');
    $file1      = $tag->file($url1);
    $url1       = $file1 ? $file1->url() : url($url1);
    $dimensions1 = getimagesize($url1);
    $classes1   = $layout == 'left' ? 'col-sm-4' : 'col-sm-8';

    $url2       = $tag->attr('pic2');
    $file2      = $tag->file($url2);
    $url2       = $file2 ? $file2->url() : url($url2);
    $dimensions2 = getimagesize($url2);
    $classes2   = $layout == 'left' ? 'col-sm-8' : 'col-sm-4';

    return 
    '<div class="row styleelement-twocolumnpics">' .

      '<div class="' . $classes1 . ' left" style="flex: ' . round($dimensions1[0] / $dimensions1[1], 4) . ';"><img src="' . $url1 . '" /></div>' .
      '<div class="' . $classes2 . ' right" style="flex: ' . round($dimensions2[0] / $dimensions2[1], 4) . ';"><img src="' . $url2 . '" /></div>' .

    '</div>';

  }
);

?>