<?php snippet('header') ?>

  <!-- Main jumbotron for a primary marketing message or call to action -->
    <div id="carousel-home" class="carousel slide jumbotron-slider" data-ride="carousel">

        <!-- Indicators -->
        <ol class="carousel-indicators">

          <?php $index = 0; ?>
          <?php foreach($page->index()->filterBy('intendedTemplate', 'homeslider')->visible()->sortBy('sort', 'desc') as $slider): ?>

            <li data-target="#carousel-home" data-slide-to="<?php echo $index ?>" class="<?php if($index == 0){ echo 'active'; } ?>"></li>

            <?php $index++ ?>

          <?php endforeach ?>

        </ol>

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
                        <button type="button" class="btn btn-secondary btn-more btn-slider" style="<?php if($slider->textcolor() == ""){} else { echo "border-color: " . $slider->textcolor() . ";" . " color: " . $slider->textcolor() . ";"; } ?>;" onclick="location.href='/posts?scrollto=posts-<?php echo $slider->tag() ?>'">Mehr anzeigen</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <?php $index++ ?>

          <?php endforeach ?>

        <a class="left carousel-control" href="#carousel-home" role="button" data-slide="prev">
          <span class="arrow-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-home" role="button" data-slide="next">
          <span class="arrow-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
          
        </div>

        <!-- Left and right controls -->
        
      </div>

    <!-- Begin page content -->

    <div class="container container-teaser">

      <div class="row">
        <div class="col-md-12" style="text-align: center;">
          <?php echo $page->intro()->kirbytext() ?>
          <br />
        </div>
      </div>

      <div class="row teaser">

        <?php foreach($page->parent()->index()->filterBy('template', 'post')->filterBy('picsonly', '!=', '1')->sortBy('date', 'desc')->limit(6) as $post): ?>
          <div class="col-sm-4">
            <div class="teaser-image-container">
              <p>
                <img src="<?php echo $post->contentURL() ?>/<?php echo $post->imageteaser() ?>" class="teaser-image" />
                <a class="" href="<?php echo $post->url() ?>">
                  <span class="darkener"></span>
                  <span class="helper"></span>
                  <img src="/Frontend/img/icon_<?php echo $post->parent()->teasericon() ?>.svg" onerror="this.src='/Frontend/img/placeholder.png'" />
                  <span class="teaser-text"><?php echo $post->title()->html() ?></span>
                </a>
              </p>
            </div>
          </div>
        <?php endforeach ?>

        
      </div>

      <div class="row">
        <div class="col-sm-12" style="text-align: center;">
          <button type="button" class="btn btn-secondary btn-more" onclick="location.href='/posts'">Mehr anzeigen</button>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12" style="text-align: center;">
          <h2><?php echo $page->introbuttons()->text() ?></h2>
        </div>
      </div>

      <div class="row teaser">
        <div class="col-sm-3 col-xs-6 menu-teaser">
          <h4>Journey</h4>
          <a href="/journey">
            <img src="/Frontend/img/menu-teaser-journey.png" />
          </a>
        </div>
        <div class="col-sm-3 col-xs-6 menu-teaser">
          <h4>Gallery</h4>
          <a href="/gallery">
            <img src="/Frontend/img/menu-teaser-gallery.png" />
          </a>
        </div>
        <div class="col-sm-3 col-xs-6 menu-teaser">
          <h4>Map</h4>
          <a href="/map">
            <img src="/Frontend/img/menu-teaser-map.png" />
          </a>
        </div>
        <div class="col-sm-3 col-xs-6 menu-teaser">
          <h4>About</h4>
          <a href="/about">
            <img src="/Frontend/img/menu-teaser-about.png" />
          </a>
        </div>
      </div>
    </div>

<?php snippet('footer') ?>