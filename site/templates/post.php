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
            <em><?php echo $page->date('F') ?></em>
            <strong><?php echo $page->date('Y') ?></strong>
            <span><?php echo $page->date('d') ?></span>
          </time>
        </div>
        <div class="col-md-8">

        	<?php 
            echo $page->text()->kirbytext();
            $subpage = $page->children()->find('gallery');
          ?>

          <div class="grid" style="position: relative; height: 1758.13px;">
            <div class="grid-sizer"></div>
            <div class="gutter-sizer"></div>

            <?php foreach($subpage->images()->sortBy('sort', 'asc') as $image): ?>

              <?php if (!strpos($image->filename(), 'preview')): ?>

                <?php
                  $imgUrl = $image->url();
                  $imgUrlPreview = str_replace(".jpg", "_preview.jpg", $imgUrl);
                  $imgDescription = $image->description();
                ?>

                <div class="grid-item">
                  <a href="<?= $imgUrl ?>" data-fancybox="images" data-caption="<?= $imgDescription ?>">
                    <img src="<?= $imgUrlPreview ?>" alt="<?= $imgDescription ?>" />
                  </a>
                </div>;

              <?php endif ?>

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
              <?php if(isset($newer)): ?>
                <button type="button" class="btn btn-secondary btn-more btn-post-sibling" onclick="location.href='<?= $newer->url() ?>'">Neuerer Beitrag</button>
              <?php endif ?>
            </div>
            <div class="col-xs-6 post-button-navigate" style="text-align: right;">
              <?php if(isset($older)): ?>
                <button type="button" class="btn btn-secondary btn-more btn-post-sibling" onclick="location.href='<?= $older->url() ?>'">Älterer Beitrag</button>
              <?php endif ?>
            </div>
          </div>
        </div>
        <div class="col-md-3"></div>
      </div>

    </div>

<?php snippet('footer') ?>