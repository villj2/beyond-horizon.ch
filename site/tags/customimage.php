<?php

kirbytext::$tags['customimage'] = array(
  'html' => function($tag) {

    $url     = $tag->attr('customimage');
    $file    = $tag->file($url);

    $url = $file ? $file->url() : url($url);

    return '<img src="' . $url . '" style="width: 100%; margin-bottom: 20px;" />';
  }
);