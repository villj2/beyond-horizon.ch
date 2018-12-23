<?php snippet('header') ?>

	<!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron" style="background-image: url(<?php echo $page->contentURL() ?>/<?php echo $page->imagejumbotron() ?>);">
      <div class="page-header">
        <div class="container">
          <div class="label">
            <h1 style="color: <?php if($page->textcolor() == ""){echo "white";} else { echo $page->textcolor(); } ?>;"><?php if(!$page->hidetitle()->value()) echo $page->title() ?></h1>
          </div>
        </div>
      </div>
    </div>

    <!-- Begin page content -->
    <div class="container blog-entry">

      <div class="row">
        <div class="col-md-1">

          <time datetime="<?php echo $page->date('Y-m-d') ?>" class="icon">
            <em><?php echo $page->date('l') ?></em>
            <strong><?php echo $page->date('F') ?></strong>
            <span><?php echo $page->date('d') ?></span>
          </time>
        </div>
        <div class="col-md-8">

        	<?php echo $page->text()->kirbytext() ?>
          
          <div id="horizon-gallery" style="display:none;">

            <?php foreach($page->children() as $subpage): ?>

              <?php $picNumber = 0; ?>

            	<?php foreach($subpage->images()->sortBy('sort', 'asc')->limit($subpage->postlimit()->value() * 2) as $image): ?>

                <?php if (strpos($image->filename(), 'preview') == false): ?>

                  <?php
                    $dummyPicture = kirby()->urls()->index() . "/assets/images/" . ($image->isLandscape() ? "landscape" : "portrait") . "_dummy_unite.jpg";
                    $picNumber++;
                  ?>

                  <a href="http://unitegallery.net">
                    <img alt="<?php echo $page->title() ?> Bild <?php echo $picNumber ?>"
                     src="<?php echo $dummyPicture ?>"
                     data-src="<?php echo str_replace(".jpg", "_preview.jpg", $image->url()) ?>"
                     data-image="<?php echo $image->url() ?>"
                     data-description=""
                     style="display:none;">
                  </a>

                <?php endif ?>

		      	  <?php endforeach ?>

			      <?php endforeach ?>

          </div>
          <br />
       </div>
        <div class="col-md-3">
          <img class="blog-map hidden-sm hidden-xs" alt="Karte" title="Karte" src="<?php echo $page->contentURL() ?>/<?php echo $page->imagemap() ?>" />
        </div>
      </div>

      <div class="row">

        <div class="col-md-1"></div>
        <div class="col-md-8">
          <div class="row">
            <div class="col-xs-6 post-button-navigate" style="text-align: left;">
              <?php if($page->hasPrevVisible('date', 'desc')): ?>
                <button type="button" class="btn btn-secondary btn-more btn-post-sibling" onclick="location.href='<?php echo $page->prevVisible('date', 'desc')->url() ?>'">neuerer Beitrag</button>
                <!-- <a href="<?php echo $page->prevVisible('date', 'desc')->url() ?>"><img src="/Frontend/img/left-arrow-posts.png"/> letzter Beitrag</a> -->
              <?php endif ?>
            </div>
            <div class="col-xs-6 post-button-navigate" style="text-align: right;">
              <?php if($page->hasNextVisible('date', 'desc')): ?>
                <button type="button" class="btn btn-secondary btn-more btn-post-sibling" onclick="location.href='<?php echo $page->nextVisible('date', 'desc')->url() ?>'">älterer Beitrag</button>
                <!-- <a href="<?php echo $page->nextVisible('date', 'desc')->url() ?>">nächster Beitrag <img src="/Frontend/img/right-arrow-posts.png"/></a> -->
              <?php endif ?>
            </div>
          </div>
        </div>
        <div class="col-md-3"></div>
      </div>

    </div>

<?php snippet('footer') ?>