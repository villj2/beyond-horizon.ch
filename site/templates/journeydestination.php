<?php snippet('header') ?>

	<div class="container container-teaser no-jumbotron">

		<div class="row">
			<div class="col-sm-12">
				<h1><?= $page->title() ?></h1>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<img class="journey-image" src="<?= $page->contentURL() . "/" . $page->pic() ?>" style="width: 100%;"  alt="Reise" title="Reise" />
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<button type="button" class="btn btn-secondary btn-more" style="margin: 20px 0 30px;" onclick="location.href='/journey'">zurück</button>
			</div>
		</div>

	</div>

<?php snippet('footer') ?>