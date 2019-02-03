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
        <div class="col-md-12">
          <?php echo $page->intro()->kirbytext() ?>
          <br />
        </div>
      </div>

      <div class="row teaser ">

        <?php if($page->parent()->index()->visible()->filterBy('template', 'post')->filterBy('picsonly', '!=', '1')->count() == 0){ ?>

          <div class="col-sm-12 home">
            <div class="teaser-image-container">
              Noch keine Beiträge vorhanden. Schau doch später wieder vorbei.
            </div>
          </div>

        <?php } else { ?>

        <?php foreach($page->parent()->index()->visible()->filterBy('template', 'post')->filterBy('picsonly', '!=', '1')->sortBy('date', 'desc')->limit(3) as $post): ?>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 col-xxs-12 home">
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

    </div>

    <div id="home-gallery-teaser" class="container">

      <div class="row">
        <div class="col-sm-12 hidden-sm hidden-md hidden-lg" style="margin-bottom: 40px;">
          <h1>Galerie</h2>
          <p>Entdecke unsere Galerie und lass dich von unseren Reisefotos inspirieren!</p>
        </div>
      </div>

      <div class="row clearfix">

        <div class="col-sm-12">
          <div class="text-box hidden-xs">
            <h1>Galerie</h1>
            <p>Entdecke unsere Galerie und lass dich von unseren Reisefotos inspirieren!</p>
          </div>
        </div>
        <div class="col-xs-3 gallery-col-1">
          <img src="<?php echo $galleryTeasers[0] ?>" />
        </div>
        <div class="col-xs-3 gallery-col-2">
          <img src="<?php echo $galleryTeasers[1] ?>" />
          <img src="<?php echo $galleryTeasers[2] ?>" class="second-entry" />
        </div>
        <div class="col-xs-3">
          <img src="<?php echo $galleryTeasers[3] ?>" />
          <img src="<?php echo $galleryTeasers[4] ?>" class="second-entry" />
          <div id="button-container" class="hidden-xs">
            <button type="button" class="btn btn-secondary btn-more" onclick="location.href='/gallery?filter=<?php echo urlencode($filterString) ?>'">Tolle Bilder goat</button>
            <div id="arrow">
              <img src="/Frontend/img/arrow_gallery_teaser.png" />
              <div id="click-teaser">
                Hier klicken um mehr von <strong><?php echo $lastLocations[0] ?></strong> und <strong><?php echo $lastLocations[1] ?></strong> zu sehen!
              </div>
            </div>

          </div>
        </div>
        <div class="col-xs-3 gallery-col-4">
          <img src="<?php echo $galleryTeasers[5] ?>" />
        </div>

      </div>

      <div class="row">
        <div class="col-sm-12" style="text-align: center;">
          <div id="button-container" class="hidden-sm hidden-md hidden-lg">
            <button type="button" class="btn btn-secondary btn-more" onclick="location.href='/gallery?filter=<?php echo urlencode($filterString) ?>'">Tolle Bilder goat</button>
            <div id="arrow">
              <img src="/Frontend/img/arrow_gallery_teaser.png" />
              <div id="click-teaser">
                Hier klicken um mehr von <strong><?php echo $lastLocations[0] ?></strong> und <strong><?php echo $lastLocations[1] ?></strong> zu sehen!
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>




    

<?php snippet('footer') ?>