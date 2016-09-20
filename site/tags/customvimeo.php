<?php

kirbytext::$tags['customvimeo'] = array(
  'html' => function($tag) {

    //return 'https://player.vimeo.com/video/' . $tag->attr('customvimeo');

    return '<div class="col-sm-12" style="padding: 0; margin: 10px 0;">
              <div class="embed-responsive embed-responsive-16by9">
                  <iframe src="https://player.vimeo.com/video/' . $tag->attr('customvimeo') . '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
              </div>
            </div>';
  }
);