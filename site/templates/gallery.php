<?php snippet('header') ?>

    <div class="container container-teaser no-jumbotron">

      <div class="row">
        <div class="col-md-12">
          <h2>Kyoto, Japan</h2>
        </div>
      </div>

        <?php echo $site->index()->filterBy('template', 'post') ?>

        <br /><br />

        <?php echo $pages->index()->filterBy('template', 'map') ?>

        <?php foreach($page->parent()->index()->filterBy('template', 'country')->sortBy('sort', 'desc') as $post): ?>

          <!--<h2>what: <?php echo $post->parent()->title() ?></h2>-->

          <div class="col-sm-4">
            <div class="teaser-image-container">
              <p>
                <img src="<?php echo $post->contentURL() ?>/<?php echo $post->imageteaser() ?>" class="teaser-image" />
                <a class="" href="<?php echo $post->url() ?>">
                  <span class="darkener"></span>
                  <span class="helper"></span>
                  <img src="/Frontend/img/icon_<?php echo $post->parent()->teasericon() ?>.svg" onerror="this.src='/Frontend/img/placeholder.png'" />
                  <span class="teaser-text"><?php echo $post->title()->html() ?></span>
                </a>
              </p>
            </div>
          </div>

        <?php endforeach ?>


      <div class="grid wrapper-parent">
            <!-- width of .grid-sizer used for columnWidth -->
        <div class="grid-sizer"></div>

        <div class="grid-item">
          <div class="grid-content-container">
            <a href="/Frontend/img/bay-of-fires.jpg" data-toggle="lightbox" data-gallery="multiimages" data-parent=".grid">
              <img src="/Frontend/img/cangs_margin_bottom_20px.jpg" />
            </a>
          </div>
        </div>
        <div class="grid-item">
          <div class="grid-content-container">
            <a href="/Frontend/img/some_greens_padding_bottom_20px.jpg" data-toggle="lightbox" data-gallery="multiimages" data-parent=".grid">
              <img src="/Frontend/img/some_greens_padding_bottom_20px.jpg" />
            </a>
          </div>
        </div>
        <div class="grid-item">
          <div class="grid-content-container">
            <a href="/Frontend/img/cangs_margin_bottom_20px.jpg" data-toggle="lightbox" data-gallery="multiimages" data-title="tche schatzi 3" data-parent=".grid">
              <img src="/Frontend/img/cangs_margin_bottom_20px.jpg" />
            </a>
          </div>
        </div>
        <div class="grid-item">
          <div class="grid-content-container">
            <a href="/Frontend/img/bay-of-fires.jpg" data-toggle="lightbox" data-gallery="multiimages" data-title="tche schatzi 4" data-parent=".grid">
              <img src="/Frontend/img/cangs_margin_bottom_20px.jpg" />
            </a>
          </div>
        </div>
        <div class="grid-item">
          <div class="grid-content-container">
            <a href="/Frontend/img/some_greens_padding_bottom_20px.jpg" data-toggle="lightbox" data-gallery="multiimages" data-title="tche schatzi 5 GCHO" data-parent=".grid">
              <img src="/Frontend/img/some_greens_padding_bottom_20px.jpg" />
            </a>
          </div>
        </div>
        <div class="grid-item">
          <div class="grid-content-container">
            <a href="/Frontend/img/cangs_margin_bottom_20px.jpg" data-toggle="lightbox" data-gallery="multiimages" data-title="tche schatzi 6" data-parent=".grid">
              <img src="/Frontend/img/cangs_margin_bottom_20px.jpg" />
            </a>
          </div>
        </div>
        <div class="grid-item">
          <div class="grid-content-container">
            <a href="/Frontend/img/cangs_margin_bottom_20px.jpg" data-toggle="lightbox" data-gallery="multiimages" data-title="tche schatzi 7" data-parent=".grid">
              <img src="/Frontend/img/cangs_margin_bottom_20px.jpg" />
            </a>
          </div>
        </div>
        <div class="grid-item">
          <div class="grid-content-container">
            <a href="/Frontend/img/cangs_margin_bottom_20px.jpg" data-toggle="lightbox" data-gallery="multiimages" data-title="tche schatzi 8" data-parent=".grid">
              <img src="/Frontend/img/cangs_margin_bottom_20px.jpg" />
            </a>
          </div>
        </div>
        <div class="grid-item">
          <div class="grid-content-container">
            <a href="/Frontend/img/cangs_margin_bottom_20px.jpg" data-toggle="lightbox" data-gallery="multiimages" data-title="tche schatzi 9" data-parent=".grid">
              <img src="/Frontend/img/cangs_margin_bottom_20px.jpg" />
            </a>
          </div>
        </div>
        <div class="grid-item">
          <div class="grid-content-container">
            <a href="/Frontend/img/cangs_margin_bottom_20px.jpg" data-toggle="lightbox" data-gallery="multiimages" data-title="tche schatzi 10" data-parent=".grid">
              <img src="/Frontend/img/cangs_margin_bottom_20px.jpg" />
            </a>
          </div>
        </div>

      </div>

      <div class="row">
        <div class="col-md-12">
          <h2>Vorbereitung, Schweiz</h2>
        </div>
      </div>

      <div class="grid wrapper-parent">
            <!-- width of .grid-sizer used for columnWidth -->
        <div class="grid-sizer"></div>

        <div class="grid-item">
          <div class="grid-content-container">
            <a href="/Frontend/img/bay-of-fires.jpg" data-toggle="lightbox" data-gallery="prep-ch" data-title="prep-ch-1" data-parent=".grid">
              <img src="/Frontend/img/cangs_margin_bottom_20px.jpg" />
            </a>
          </div>
        </div>
        <div class="grid-item">
          <div class="grid-content-container">
            <a href="/Frontend/img/some_greens_padding_bottom_20px.jpg" data-toggle="lightbox" data-gallery="prep-ch" data-title="prep-ch-2" data-parent=".grid">
              <img src="/Frontend/img/some_greens_padding_bottom_20px.jpg" />
            </a>
          </div>
        </div>
        <div class="grid-item">
          <div class="grid-content-container">
            <a href="/Frontend/img/cangs_margin_bottom_20px.jpg" data-toggle="lightbox" data-gallery="prep-ch" data-title="prep-ch-3" data-parent=".grid">
              <img src="/Frontend/img/cangs_margin_bottom_20px.jpg" />
            </a>
          </div>
        </div>
        <div class="grid-item">
          <div class="grid-content-container">
            <a href="/Frontend/img/bay-of-fires.jpg" data-toggle="lightbox" data-gallery="prep-ch" data-title="tche schatzi 4" data-parent=".grid">
              <img src="/Frontend/img/cangs_margin_bottom_20px.jpg" />
            </a>
          </div>
        </div>
        <div class="grid-item">
          <div class="grid-content-container">
            <a href="/Frontend/img/some_greens_padding_bottom_20px.jpg" data-toggle="lightbox" data-gallery="prep-ch" data-title="tche schatzi 5 GCHO" data-parent=".grid">
              <img src="/Frontend/img/some_greens_padding_bottom_20px.jpg" />
            </a>
          </div>
        </div>
        <div class="grid-item">
          <div class="grid-content-container">
            <a href="/Frontend/img/cangs_margin_bottom_20px.jpg" data-toggle="lightbox" data-gallery="prep-ch" data-title="tche schatzi 6" data-parent=".grid">
              <img src="/Frontend/img/cangs_margin_bottom_20px.jpg" />
            </a>
          </div>
        </div>
        <div class="grid-item">
          <div class="grid-content-container">
            <a href="/Frontend/img/cangs_margin_bottom_20px.jpg" data-toggle="lightbox" data-gallery="prep-ch" data-title="tche schatzi 7" data-parent=".grid">
              <img src="/Frontend/img/cangs_margin_bottom_20px.jpg" />
            </a>
          </div>
        </div>
        <div class="grid-item">
          <div class="grid-content-container">
            <a href="/Frontend/img/cangs_margin_bottom_20px.jpg" data-toggle="lightbox" data-gallery="prep-ch" data-title="tche schatzi 8" data-parent=".grid">
              <img src="/Frontend/img/cangs_margin_bottom_20px.jpg" />
            </a>
          </div>
        </div>
        <div class="grid-item">
          <div class="grid-content-container">
            <a href="/Frontend/img/cangs_margin_bottom_20px.jpg" data-toggle="lightbox" data-gallery="prep-ch" data-title="tche schatzi 9" data-parent=".grid">
              <img src="/Frontend/img/cangs_margin_bottom_20px.jpg" />
            </a>
          </div>
        </div>
        <div class="grid-item">
          <div class="grid-content-container">
            <a href="/Frontend/img/cangs_margin_bottom_20px.jpg" data-toggle="lightbox" data-gallery="prep-ch" data-title="tche schatzi 10" data-parent=".grid">
              <img src="/Frontend/img/cangs_margin_bottom_20px.jpg" />
            </a>
          </div>
        </div>

      </div>

    </div>

<?php snippet('footer') ?>