<?php snippet('header') ?>

	<div class="container container-teaser no-jumbotron about">

      <div class="row">
        <div class="col-md-4 center-max-md">

        	<?php echo $page->faces()->kirbytext() ?>

        </div>
        <div class="col-md-5 text"><!-- center-max-md -->

  			<?php 

          $d1 = new DateTime();
          $d2 = new DateTime('1986-10-14');
          $diff = $d2->diff($d1);
          $text = str_replace('%agejulien%', $diff->y, $page->text()->kirbytext());

          $d2 = new DateTime('1990-11-29');
          $diff = $d2->diff($d1);
          $text = str_replace('%agekarin%', $diff->y, $text);

          echo $text;

        ?>

         

        </div>
        <div class="col-md-3 quote">

         <div class="quote-text">
          <img class="quote-start" src="/Frontend/img/about/quote_start.png" />
          <span>The world is a book and those who do not travel read only one page.</span>
          <img class="quote-end" src="/Frontend/img/about/quote_end.png" />
        </div>
          <div class="quote-teller"><p>St. Augustine</p></div>

        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="btn-contact">
            <a type="button" class="btn btn-secondary btn-more" href="mailto:contact@beyond-horizon.ch?subject=Kontaktanfrage">Kontaktiere uns</a>
          </div>
        </div>
      </div>

    </div>

<?php snippet('footer') ?>