<?php snippet('header') ?>

	<div class="container container-teaser no-jumbotron">

		<div class="row">
	      	<div class="col-md-12">
	          <?php echo $page->imageMapIntro()->text()->kirbytext() ?>
	          <br />
	        </div>
	    </div>
	    <div class="row">
	        <div class="col-sm-8 col-xs-12" style="position: relative;">
	          <?php echo $page->imageMap()->html() ?>
	        </div>
	        <div class="col-sm-4 col-xs-0"></div>
	    </div>

	    


	</div>

<?php snippet('footer') ?>