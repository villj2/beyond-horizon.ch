<?php snippet('header') ?>

	<!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron" style="background-image: url(<?php echo $page->contentURL() ?>/<?php echo $page->imagejumbotron() ?>);">
      <div class="page-header">
        <div class="container">
          <div class="label">
            <h1><?php if(!$page->hidetitle()->value()) echo $page->title() ?></h1>
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
          
          <div class="grid wrapper-parent">
            
            <div class="grid-sizer"></div>

            <?php foreach($page->children() as $subpage): ?>

            	<?php foreach($subpage->images()->sortBy('sort', 'asc')->limit($subpage->postlimit()->value() * 2) as $image): ?>

            		<!-- make sure not showing double images -->
            		<?php if (strpos($image->filename(), 'preview') == false): ?>
            			<div class="grid-item">
			              <div class="grid-content-container">
			                <a href="<?php echo $image->url() ?>" data-toggle="lightbox" data-gallery="multiimages" data-parent=".grid">
			                  <img src="<?php echo str_replace(".jpg", "_preview.jpg", $image->url()) ?>" />
			                </a>
			              </div>
			            </div>
            		<?php endif ?>

		      	  <?php endforeach ?>

			      <?php endforeach ?>

          </div>
          <br />
       </div>
        <div class="col-md-3">
          <img class="blog-map hidden-sm hidden-xs" src="<?php echo $page->contentURL() ?>/<?php echo $page->imagemap() ?>" />
        </div>
      </div>

      <div class="row">

        <div class="col-md-1"></div>
        <div class="col-md-8">
          <div class="row">
            <div class="col-xs-6 post-button-navigate" style="text-align: left;">
              <?php if($page->hasPrevVisible('date', 'desc')): ?>
                <a href="<?php echo $page->prevVisible('date', 'desc')->url() ?>"><img src="/Frontend/img/left-arrow-posts.png"/> letzter Beitrag</a>
              <?php endif ?>
            </div>
            <div class="col-xs-6 post-button-navigate" style="text-align: right;">
              <?php if($page->hasNextVisible('date', 'desc')): ?>
                <a href="<?php echo $page->nextVisible('date', 'desc')->url() ?>">nächster Beitrag <img src="/Frontend/img/right-arrow-posts.png"/></a>
              <?php endif ?>
            </div>
          </div>
        </div>
        <div class="col-md-3"></div>
      </div>

    </div>

<?php snippet('footer') ?>