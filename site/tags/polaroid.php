<?php

kirbytext::$tags['polaroid'] = array(
  'html' => function($tag) {
    return '<h2>Yess.. Nun kommt der Wert: ' . $tag->attr('polaroid') . '</h2>';
  }
);