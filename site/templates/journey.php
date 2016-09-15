<?php snippet('header') ?>

	<div class="container container-teaser no-jumbotron">

		<div class="row">
	      	<div class="col-md-12">

	      		<?php echo $page->imageMapIntro()->text()->kirbytext() ?>
	          	<br />

	      		<img src="/Frontend/img/journey/journey_complete.png" style="width: 100%;" />

	          	
	        </div>
	    </div>
	    <!-- <div class="row">
	        <div class="col-sm-8 col-xs-12" style="position: relative;">
	          <?php echo $page->imageMap()->html() ?>
	        </div>
	        <div class="col-sm-4 col-xs-0"></div>
	    </div>

	    <?php foreach($page->index() as $journeydestination): ?>

	    	<?php echo $journeydestination->description()->html() ?>

		<?php endforeach ?> -->


	</div>

<?php snippet('footer') ?>