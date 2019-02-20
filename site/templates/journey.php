<?php snippet('header') ?>

	<div id="journey" class="container container-teaser no-jumbotron">

		<div class="row">
			<div class="col-sm-12">
				<h1><?= $page->title() ?></h1>
			</div>
		</div>

		<?php foreach($page->index()->visible()->filterBy('intendedtemplate', 'journeydestination') as $jd): ?>

			<div class="row">
		      	<div class="col-md-6 text-area">
		      		<div class="row">
		      			<div class="col-md-12">
		      				<h2><?= $jd->title() ?></h2>
		      			</div>
		      		</div>
			      	<div class="row">
			      		<div class="col-md-12">
				      		<?= $jd->description()->html() ?>
				      	</div>
			      	</div>
			      	<br />
	      			<div class="row">
	      				<div class="col-md-12">
			      			<button type="button" class="btn btn-secondary btn-more" style="<?= $jd->showlinkjourney() == '1' ? '' : 'display: none;' ?>" onclick="location.href='<?= $jd->url() ?>'"><?= $jd->textlinkjourney() ?>
			      			</button>
			      			<br />
			      			<button type="button" class="btn btn-secondary btn-more" style="<?= $jd->showlinkposts() == '1' ? '' : 'display: none;' ?>" onclick="location.href='/posts?filter=<?= urlencode($jd->filterlinkposts()) ?>'"><?= $jd->textlinkposts() ?>
			      			</button>
			      			<button type="button" class="btn btn-secondary btn-more" style="<?= $jd->showlinkgallery() == '1' ? '' : 'display: none;' ?>" onclick="location.href='/gallery?filter=<?= urlencode($jd->filterlinkgallery()) ?>'"><?= $jd->textlinkgallery() ?>
			      			</button>
			      		</div>
		      		</div>
		      	</div>
		      	<div class="col-md-6 pic-area">
		      		<img src="<?= $jd->contentURL() . "/" . $jd->picpreview() ?>" />
		      	</div>
	      	</div>

		<?php endforeach ?>

	</div>

<?php snippet('footer') ?>