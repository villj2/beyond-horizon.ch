<?php snippet('header') ?>

    <div class="container container-teaser no-jumbotron">

        <?php /* echo $pages->index()->filterBy('intendedTemplate', 'postcategory') */ ?>

        <?php

          $postcategories = $pages->index()->visible()->filterBy('intendedTemplate', 'postcategory')->sortBy('sort', 'desc');


          if($postcategories->count() == 0){
            echo '<div class="row">
                    <div class="col-md-12 text-center">
                      Noch keine Bilder vorhanden. Schau doch später wieder vorbei.
                    </div>
                  </div>';
          }

          foreach($postcategories as $postcategory):

            $posts = $postcategory->children()->filterBy('intendedTemplate', 'post');

            if($posts == "" || !$postcategory->showingallery()->value()) {

              echo '<div class="row">
                    <div class="col-md-12 text-center">
                      Noch keine Bilder vorhanden. Schau doch später wieder vorbei.
                    </div>
                  </div>';
              
              continue;
            }

            echo '<div class="row">
              <div class="col-md-12">
                <h2>' . $postcategory->title() . '</h2>
              </div>
            </div>';

            foreach($posts->sortBy('date', 'desc') as $post):

              $gallery = $post->children()->visible()->filterBy('intendedTemplate', 'postgallery');

              if($gallery == "") continue;

              echo
              '<div class="row">
                <div class="col-md-12">
                  <h4>' . $post->title() . '</h4>
                </div>
              </div>
              <div class="grid wrapper-parent">
                <div class="grid-sizer"></div>';

              $picIndex = 0;

              foreach($gallery->images()->sortBy('sort', 'asc') as $image):

                if(strpos($image->filename(), 'preview') == false){

                  echo '<div class="grid-item">
                          <div class="grid-content-container">
                            <a href="' . $image->url() . '" data-toggle="lightbox" data-gallery="' . $post->date() . '" data-parent=".grid">
                              <img src="' . str_replace(".jpg", "_preview.jpg", $image->url()) . '" alt="' . $post->title() . ' Bild ' . ++$picIndex . '" title="' . $post->title() . ' Bild ' . $picIndex . '" />
                            </a>
                          </div>
                        </div>';
                }

              endforeach;

              echo '</div>';

            endforeach;
              
          endforeach;

        ?>

    </div>

<?php snippet('footer') ?>