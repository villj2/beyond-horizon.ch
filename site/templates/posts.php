<?php snippet('header') ?>

	<div class="container container-teaser no-jumbotron">

		<?php

		if($categories->sortBy('date', 'asc')->count() == 0){
        echo '<div class="row">
                <div class="col-md-12 text-center">
                  Noch keine Beiträge vorhanden. Schau doch später wieder vorbei.
                </div>
              </div>';
      	}

      	?>

		<?php foreach($categories->sortBy('sort', 'desc') as $category): ?>

	      <div class="row">
	        <div class="col-md-12">
	          <h2 id="posts-<?php echo strtolower($category->title()->text()) ?>"><?php echo $category->title()->html() ?></h2>
	          <br />
	        </div>
	      </div>

	      <div class="row teaser">

	      	<?php foreach($category->children()->visible()->filterBy('picsonly', '!=', '1')->sortBy('date', 'desc') as $post): ?>

	      		<div class="col-sm-4">
	          		<div class="teaser-image-container">
	            		<p>
				      		<img src="<?php echo $post->contentURL() ?>/<?php echo $post->imageteaser() ?>" class="teaser-image" alt="<?php echo $post->title() ?>" title="<?php echo $post->title() ?>" />
			              	<a class="" href="<?php echo $post->url() ?>" style="">
				                <span class="darkener"></span>
				                <span class="helper"></span>
				                <img src="/Frontend/img/icon_<?php echo $category->teasericon() ?>.svg" onerror="this.src='/Frontend/img/placeholder.png'" alt="<?php echo $post->title() ?>" title="<?php echo $post->title() ?>" />
				                <span class="teaser-text"><?php echo $post->title()->html() ?></span>
			              	</a>
			            </p>
	        		</div>
	        	</div>

	      	<?php endforeach ?>

	      </div>

		<?php endforeach ?>

    </div>

<?php snippet('footer') ?>