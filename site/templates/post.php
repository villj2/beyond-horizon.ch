<?php snippet('header') ?>

	<!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron" style="background-image: url(<?php echo $page->contentURL() ?>/<?php echo $page->imagejumbotron() ?>);">
      <div class="page-header">
        <div class="container">
          <div class="label">
            <h1><?php echo $page->title() ?></h1>
          </div>
        </div>
      </div>
    </div>

    <!-- Begin page content -->
    <div class="container blog-entry">

      <div class="row">
        <div class="col-md-1">
          <!--<img src="../img/Apple_Calendar_Icon.png" class="blog-cal" />-->
          <time datetime="2014-09-20" class="icon">
            <em>Samstag</em>
            <strong>Juli</strong>
            <span>2</span>
          </time>
        </div>
        <div class="col-md-8">

        	<?php echo $page->text()->kirbytext() ?>

          
          <div class="row polaroid-section">
            <div class="col-sm-4">
              <div class="polaroid-container">
                <div class="polaroid-background-container">
                  <img class="polaroid-background" src="../img/polaroid_1.png" />
                  <img class="polaroid-image" src="../img/whitsunday_polaroid.jpg" />
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="polaroid-container">
                <div class="polaroid-background-container">
                  <img class="polaroid-background" src="../img/polaroid_2.png" />
                  <img class="polaroid-image middle" src="../img/whitsunday_polaroid.jpg" />
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="polaroid-container">
                <div class="polaroid-background-container">
                  <img class="polaroid-background" src="../img/polaroid_3.png" />
                  <img class="polaroid-image right" src="../img/whitsunday_polaroid.jpg" />
                </div>
              </div>
            </div>
          </div>
          
          <div class="grid wrapper-parent">
            
            <div class="grid-sizer"></div>

            <?php foreach($page->children() as $subpage): ?>

            	<?php foreach($subpage->images()->sortBy('sort', 'asc')->limit(10) as $image): ?>

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
        <div class="col-md-12">
          
        </div>
      </div>

    </div>

<?php snippet('footer') ?>