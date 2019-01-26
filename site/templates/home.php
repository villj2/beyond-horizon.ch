<?php snippet('header') ?>

  <!-- Main jumbotron for a primary marketing message or call to action -->
    <div id="carousel-home" class="carousel slide jumbotron-slider" data-ride="carousel">

        <!-- Indicators -->
        <?php if($page->index()->filterBy('intendedTemplate', 'homeslider')->visible()->count() > 1){ ?>
          <ol class="carousel-indicators">

            <?php $index = 0; ?>
            <?php foreach($page->index()->filterBy('intendedTemplate', 'homeslider')->visible()->sortBy('sort', 'desc') as $slider): ?>

              <li data-target="#carousel-home" data-slide-to="<?php echo $index ?>" class="<?php if($index == 0){ echo 'active'; } ?>"></li>

              <?php $index++ ?>

            <?php endforeach ?>

          </ol>
        <?php } ?>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">

          <?php $index = 0; ?>
          <?php foreach($page->index()->filterBy('intendedTemplate', 'homeslider')->visible()->sortBy('sort', 'desc') as $slider): ?>

            <div class="item <?php if($index == 0){ echo 'active'; } ?>">
              <div class="jumbotron" style="background-image: url(<?php echo $slider->image()->url(); ?>);">
                <div class="page-header">
                  <div class="container">
                    <div class="label" style="text-align: center;">
                      <h1 style="color: <?php if($slider->textcolor() == ""){echo "white";} else { echo $slider->textcolor(); } ?>;"><?php echo $slider->title() ?></h1>
                      <div>
                        <button type="button" class="btn btn-secondary btn-more btn-slider" style="<?php if($slider->textcolor() == ""){} else { echo "border-color: " . $slider->textcolor() . ";" . " color: " . $slider->textcolor() . ";"; } ?>;" onclick="<?php if($slider->link() == ""){ echo "location.href='/posts?scrollto=posts-" . $slider->tag() . "'"; } else { echo "location.href='" . $slider->link() . "'"; } ?>">Mehr anzeigen</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <?php $index++ ?>

          <?php endforeach ?>

        <?php if($page->index()->filterBy('intendedTemplate', 'homeslider')->visible()->count() > 1){ ?>
          <a class="left carousel-control" href="#carousel-home" role="button" data-slide="prev">
            <span class="arrow-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#carousel-home" role="button" data-slide="next">
            <span class="arrow-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        <?php } ?>
          
        </div>

        <!-- Left and right controls -->
        
      </div>

    <!-- Begin page content -->

    <div class="container container-teaser">

      <div class="row">
        <div class="col-md-12" style="text-align: center;">
          <h1 style="margin-top: 40px;">Beyond Horizon Travel Blog</h1>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12" style="text-align: center; margin-bottom: 60px; margin-top: 30px;">
            <p style="font-family: black_jackregular; font-size: 1.6em;">Reise jenseits des Horizonts. Erlebnisberichte und Fotos aus der reichen Kultur Japans, der schillernden Tierwelt Australiens, der imposanten Natur Neuseelands und dem hektischen Treiben Hong Kongs.</p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12" style="text-align: center;">
          <?php echo $page->intro()->kirbytext() ?>
          <br />
        </div>
      </div>

      <div class="row teaser">

        <?php if($page->parent()->index()->visible()->filterBy('template', 'post')->filterBy('picsonly', '!=', '1')->count() == 0){ ?>

          <div class="col-sm-12">
            <div class="teaser-image-container">
              Noch keine Beiträge vorhanden. Schau doch später wieder vorbei.
            </div>
          </div>

        <?php } else { ?>

        <?php foreach($page->parent()->index()->visible()->filterBy('template', 'post')->filterBy('picsonly', '!=', '1')->sortBy('date', 'desc')->limit(3) as $post): ?>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 col-xxs-12">
            <div class="teaser-image-container">
              <p>
                <img src="<?php echo $post->contentURL() ?>/<?php echo $post->imageteaser() ?>" class="teaser-image" alt="<?php echo $post->title() ?>" title="<?php echo $post->title() ?>" />
                <a class="" href="<?php echo $post->url() ?>">
                  <span class="darkener"></span>
                  <span class="helper"></span>
                  <!-- <img src="/Frontend/img/icon_<?php echo $post->parent()->teasericon() ?>.svg" onerror="this.src='/Frontend/img/placeholder.png'" alt="<?php echo $post->title() ?>" title="<?php echo $post->title() ?>" /> -->
                  <span class="teaser-text"><?php echo $post->title()->html() ?></span>
                </a>
              </p>
            </div>
          </div>
        <?php endforeach ?>
        <?php } ?>

      </div>

      <div class="row">
        <div class="col-sm-12" style="text-align: center;">
          <button type="button" class="btn btn-secondary btn-more" onclick="location.href='/posts'">Mehr anzeigen</button>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12" style="text-align: center;">
          <h2>Galerie</h2>
        </div>
      </div>

       <div class="row">
        <div class="col-sm-12" style="">

          <?php

            //[{"id":"oceania", "countries":["nz", "au"]}, {"id":"asia", "countries":["hk", "jp"]}]

            $filterDict = array();

            foreach ($page->parent()->index()->visible()->filterBy('template', 'post')->sortBy('date', 'desc')->limit(2) as $post) {

              $continent = strtolower($post->parent()->parent()->title());
              $country = strtolower($post->parent()->countrycode());

              if(!array_key_exists($continent, $filterDict)) {

                // Adding continent if not already in dict
                $filterDict[$continent] = $country;
              }
              else {

                if(\strpos($filterDict[$continent], $country) !== false) {
                  // country already added
                }
                else {

                  // Add new country to already existing continent with at least 1 country-entry
                  $filterDict[$continent] = $filterDict[$continent] . "|" . $country;
                }
              }

            }

            echo "<br/>";

            $indexContinent = 0;
            $filterString = '[';

            foreach ($filterDict as $key=>$value) {

              //echo $key . " - " . $value . "<br />";

              if($indexContinent > 0) {
                $filterString .= ', ';
              }

              $filterString .= '{"id":"' . $key . '", "countries":[';

              // TODO split countries
              $indexCountry = 0;
              $explodedCountries = explode('|', $value);
              foreach ($explodedCountries as $country) {

                if($indexCountry > 0) {
                  $filterString .= ', ';
                }

                $filterString .= '"' . $country . '"';

                $indexCountry++;
              }

              $filterString .= ']}';
              $indexContinent++;
            }

            $filterString .= ']';

            //echo $filterString;

          ?>

          <button type="button" class="btn btn-secondary btn-more" onclick="location.href='/gallery?filter=<?php echo urlencode($filterString) ?>'">Mehr anzeigen</button>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12" style="text-align: center;">
          <h2 style="margin-bottom: 20px;"><?php echo $page->introbuttons()->text() ?></h2>
        </div>
      </div>

      <div class="row teaser">
        <div class="col-sm-3 col-xs-6 menu-teaser">
          <!-- <h4>Reise</h4> -->
          <a href="/journey">
            <img src="/Frontend/img/menu-teaser-journey.png" alt="Reise" title="Reise" />
          </a>
        </div>
        <div class="col-sm-3 col-xs-6 menu-teaser">
          <!-- <h4>Galerie</h4> -->
          <a href="/gallery">
            <img src="/Frontend/img/menu-teaser-gallery.png" alt="Galerie" title="Galerie" />
          </a>
        </div>
        <div class="col-sm-3 col-xs-6 menu-teaser">
          <!-- <h4>Karte</h4> -->
          <a href="/map">
            <img src="/Frontend/img/menu-teaser-map.png" alt="Karte" title="Karte" />
          </a>
        </div>
        <div class="col-sm-3 col-xs-6 menu-teaser">
          <!-- <h4>Über uns</h4> -->
          <a href="/about">
            <img src="/Frontend/img/menu-teaser-about.png" alt="Über uns" title="Über uns" />
          </a>
        </div>
      </div>
    </div>

<?php snippet('footer') ?>