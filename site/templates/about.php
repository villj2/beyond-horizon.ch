<?php snippet('header') ?>

	<div class="container container-teaser no-jumbotron about">

      <div class="row">
        <div class="col-md-8">

        	<?php echo $page->text()->kirbytext() ?>

        </div>
        <div class="col-md-4 center-max-md">

  			<?php echo $page->faces()->kirbytext() ?>

        </div>
      </div>

    </div>

<?php snippet('footer') ?>