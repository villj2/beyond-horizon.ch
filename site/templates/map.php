<?php snippet('header') ?>

	<!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron empty">
    </div>

    <div class="container map" id="container-map-posts" data-pins='<?php echo $pinJson ?>'>
      <div class="row">
        <div class="col-md-12" style="text-align: center;">
          <div id="map-overview"></div>
        </div>
      </div>
    </div>

<?php snippet('footer') ?>