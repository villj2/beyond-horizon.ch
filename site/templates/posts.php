<?php snippet('header') ?>

	<div class="container container-teaser no-jumbotron">

		<div class="row">
			<div class="col-md-12">
				<div id="continent-map">
					<?php echo $mapsvg ?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<!-- List with countries -->
				<div id="list-countries">

					<?php foreach($continents->sortBy('sort', 'desc') as $continent): ?>

						<?php foreach($continent->children()->sortBy('sort', 'desc') as $country): ?>

							<div id="<?php echo strtolower($continent->title()) ?>-<?php echo strtolower($country->countrycode()) ?>" class="list-country hide"><a href="#" data-continent="<?php echo strtolower($continent->title()) ?>" data-country="<?php echo strtolower($country->countrycode()) ?>"><?php echo $country->title()->html() ?></a></div>

						<?php endforeach ?>

					<?php endforeach ?>
					
				</div>
			</div>
		</div>

      	<div id="posts">

      		<!-- Loop over CONTINENTS -->
      		<?php foreach($continents->sortBy('sort', 'asc') as $continent): ?>

      			<div id="posts-<?php echo strtolower($continent->title()->text()) ?>" class="hide">
      				
      				<div class="row">
				        <div class="col-md-12">
				          <h1><?php echo $continent->titlefrontend()->html() ?></h1>
				          <br />
				        </div>
				      </div>


		      		<!-- Loop over COUNTRIES -->
		      		<?php foreach($continent->children()->sortby('sort', 'desc') as $country): ?>

		      			<div id="posts-<?php echo $country->countrycode()->text() ?>" data-continent="<?php echo strtolower($continent->title()->text()) ?>" data-country="<?php echo $country->countrycode()->text() ?>" class="posts-country hide">

		      				<div class="row">
		      					<div class="col-md-12">
						          <h2><?php echo $country->title()->text() ?></h2>
						          <br />
						        </div>
		      				</div>

					      <div class="row teaser">

			          			<!-- Loop over POSTS -->
			      				<?php foreach($country->children()->visible()->filterBy('picsonly', '!=', '1')->sortby('sort', 'desc') as $post): ?>

							      	<div class="col-sm-4">
						          		<div class="teaser-image-container">

											<p class="posts-entry">
									      		<img src="#" data-src="<?php echo $post->contentURL() ?>/<?php echo $post->imageteaser() ?>" class="teaser-image" alt="<?php echo $post->title() ?>" title="<?php echo $post->title() ?>" />
								              	<a class="" href="<?php echo $post->url() ?>" style="">
									                <span class="darkener"></span>
									                <span class="helper"></span>
									                <img src="/Frontend/img/icon_<?php echo $country->teasericon() ?>.svg" onerror="this.src='/Frontend/img/placeholder.png'" alt="<?php echo $post->title() ?>" title="<?php echo $post->title() ?>" />
									                <span class="teaser-text"><?php echo $post->title()->html() ?></span>
								              	</a>
											</p>
						          		</div>
						          	</div>

			      				<?php endforeach ?>
					      </div>

		      			</div>

		      		<?php endforeach ?>

		      </div>

			<?php endforeach ?>

      	</div>

    </div>

<?php snippet('footer') ?>