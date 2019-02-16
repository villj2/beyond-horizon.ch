<?php snippet('header') ?>

<div id="home">

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

  <div id="posts-teaser" class="container container-teaser">

    <!-- <div class="row">
      <div class="col-md-12" style="text-align: center;">
        <h1 style="margin-top: 40px;">Beyond Horizon Travel Blog</h1>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12" style="text-align: center; margin-bottom: 60px; margin-top: 30px;">
          <p style="font-family: black_jackregular; font-size: 1.6em;">Reise jenseits des Horizonts. Erlebnisberichte und Fotos aus der reichen Kultur Japans, der schillernden Tierwelt Australiens, der imposanten Natur Neuseelands und dem hektischen Treiben Hong Kongs.</p>
      </div>
    </div> -->

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

      <?php $index = 0; ?>

      <?php foreach($page->parent()->index()->visible()->filterBy('template', 'post')->filterBy('picsonly', '!=', '1')->sortBy('date', 'desc')->limit(4) as $post): ?>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 <?= $index >= 3 ? 'hidden-sm hidden-md hidden-lg' : '' ?> home">
          <div class="teaser-image-container">
            <p>
              <img src="<?php echo $post->contentURL() ?>/<?php echo $post->imageteaser() ?>" class="teaser-image" alt="<?php echo $post->title() ?>" title="<?php echo $post->title() ?>" />
              <a class="" href="<?php echo $post->url() ?>">
                <span class="darkener"></span>
                <span class="helper"></span>
                <span class="teaser-text"><?php echo $post->title()->html() ?></span>
              </a>
            </p>
          </div>
        </div>

        <?php $index++ ?>

      <?php endforeach ?>
      <?php } ?>

    </div>

    <div class="row">
      <div class="col-sm-12" style="text-align: center;">
        <button type="button" class="btn btn-secondary btn-more" onclick="location.href='/posts'"><?php echo $page->textbuttonposts() ?></button>
      </div>
    </div>

  </div>





  <!-- Gallery Teaser >= screen-sm -->
  <div id="home-gallery-teaser-big" class="container home-gallery-teaser hidden-xs">

    <div class="row clearfix">

      <div class="col-sm-12">
        <div class="text-box">
          <h1>Galerie</h1>
          <p><?php echo $page->introgallery() ?></p>
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
        <div id="button-container">
          <button type="button" class="btn btn-secondary btn-more" onclick="location.href='/gallery?filter=<?php echo urlencode($filterString) ?>'"><?php echo $page->textbuttongallery() ?></button>
          <div id="arrow">
            <img src="/Frontend/img/arrow_gallery_teaser.png" />
            <div id="click-teaser">
              <?php echo sprintf($page->teasertextbuttongallery(), '<strong>' . $lastLocations[0] . '</strong>', '<strong>' . $lastLocations[1] . '</strong>') ?>
            </div>
          </div>

        </div>
      </div>
      <div class="col-xs-3 gallery-col-4">
        <img src="<?php echo $galleryTeasers[5] ?>" />
      </div>

    </div>
  </div>




  <div class="container">
    <div class="row">
      <div class="col-sm-12 hidden-sm hidden-md hidden-lg" style="margin-bottom: 40px;">
        <h1>Galerie</h2>
        <p><?php echo $page->introgallery() ?></p>
      </div>
    </div>
  </div>
  

  <!-- Gallery Teaser < screen-sm -->
  <div id="home-gallery-teaser-small" class="home-gallery-teaser hidden-sm hidden-md hidden-lg">

    </style>

    <div id="centered-container">

      <div id="centered-content">

        <div class="col-xs-3 gallery-col gallery-col-1">
          <img src="<?php echo $galleryTeasers[0] ?>" />
        </div>
        <div class="col-xs-3 gallery-col gallery-col-2">
          <img src="<?php echo $galleryTeasers[1] ?>" />
          <img src="<?php echo $galleryTeasers[2] ?>" class="second-entry" />
        </div>
        <div class="col-xs-3 gallery-col">
          <img src="<?php echo $galleryTeasers[3] ?>" />
          <img src="<?php echo $galleryTeasers[4] ?>" class="second-entry" />
        </div>
        <div class="col-xs-3 gallery-col gallery-col-4">
          <img src="<?php echo $galleryTeasers[5] ?>" />
        </div>

      </div>
    </div>

    <div class="col-sm-12" style="text-align: center;">
      <div id="button-container">
        <button type="button" class="btn btn-secondary btn-more" onclick="location.href='/gallery?filter=<?php echo urlencode($filterString) ?>'"><?php echo $page->textbuttongallery() ?></button>
        <div id="arrow">
          <img src="/Frontend/img/arrow_gallery_teaser.png" />
          <div id="click-teaser">
            <?php echo sprintf($page->teasertextbuttongallery(), '<strong>' . $lastLocations[0] . '</strong>', '<strong>' . $lastLocations[1] . '</strong>') ?>
          </div>
        </div>
      </div>
    </div>

  </div>


  <!-- ABOUT US -->
  <div id="home-about-us" class="container container-teaser">

    <div class="row">
      <div class="col-sm-12">
        <h1>Über Beyond Horizon</h1>
      </div>
    </div>

    <div class="row desktop">
      <div class="col-sm-12 container">
        <span class="part part-left">
          <span>
            <?= $page->aboutustext() ?>
          </span>
          <button type="button" class="btn btn-secondary btn-more" onclick="location.href='/about'"><?= $page->aboutusbutton() ?></button>
        </span>
        <span class="part part-right" >
          <div class="content" style="background-image: url(<?= $page->contentURL() . '/' . $page->aboutuspic() ?>);">
          </div>
        </span>
      </div>
    </div>

    <div class="row mobile">
      <div class="col-sm-12 part-text-mobile">
          <?= $page->aboutustext() ?>
      </div>
      <div class="col-sm-12 part-picture-mobile">
        <div class="content" style="background-image: url(<?= $page->contentURL() . '/' . $page->aboutuspic() ?>);">
        </div>
      </div>
      <div class="col-sm-12 part-button-mobile">
        <button type="button" class="btn btn-secondary btn-more" onclick="location.href='/about'"><?= $page->aboutusbutton() ?></button>
      </div>
    </div>

  </div>



  <!-- FORM -->
  <div class="container container-teaser">
    <div class="row">
      <div class="col-sm-12">
        <h1>Newsletter</h1>
      </div>
    </div>

    <?php if(!isset($success)): ?>
    <div class="row">
      <div class="col-sm-12">
        <span><?= $page->textnewsletter() ?></span>
      </div>
    </div>
    <?php endif ?>

    <div class="row">
      <div class="col-sm-12">
        <?php
        // if the form was successfully submitted and the page created, show the success message
        if(isset($success)): ?>
          <div class="message">
            <?= $success; ?>
          </div>
        <?php else: ?>

          <?php snippet('newsletter-form', ['alert' => $alert]) ?>

        <?php endif ?>

        <?php
        // if the form input does not validate, show a list of alerts
        // added 'false' in order not to show any error messages
        if($alert && false): ?>
          <div class="alert">
            <ul>
              <?php foreach($alert as $message): ?>
                <li><?= html($message) ?></li>
              <?php endforeach ?>
            </ul>
          </div>
        <?php endif ?>
      </div>
    </div>
  </div>





</div>

<?php snippet('footer') ?>