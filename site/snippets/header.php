<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Reise jenseits des Horizonts. Erlebnisberichte und Fotos aus der reichen Kultur Japans, der schillernden Tierwelt Australiens und der imposanten Natur Neuseelands.">
    <meta name="keywords" content="Beyond, Horizon, Jenseits, Horizont, Travel, Reisen, Blog, Photos, Fotos, Japan, Australia, Tasmania, New Zealand, Hong Kong">
    <meta name="author" content="Julien Villiger und Karin Lüthi">

    <link rel="apple-touch-icon" sizes="57x57" href="/Frontend/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/Frontend/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/Frontend/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/Frontend/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/Frontend/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/Frontend/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/Frontend/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/Frontend/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/Frontend/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/Frontend/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/Frontend/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/Frontend/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/Frontend/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <link rel="icon" href="/favicon.ico">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/Frontend/img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <title><?php echo $site->title()->html() ?> | Reise jenseits des Horizonts | <?php echo $page->title()->html() ?></title>

    <link href="/Frontend/dist/css/ekko-lightbox.min.css" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="/Frontend/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="/Frontend/dist/css/bootstrap.css" rel="stylesheet"> -->

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="/Frontend/dist/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/Frontend/dist/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-84203042-1', 'auto');
      ga('send', 'pageview');

    </script>

    <!-- Pinterest -->
    <!--<script async defer src="//assets.pinterest.com/js/pinit.js"></script>-->

    <!-- Facebook -->
    <!--<div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>-->

  </head>

  <body ontouchstart="">

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">
            <img src="/Frontend/img/logo.png" alt="Logo" title="Logo" />
          </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <?php foreach($pages->visible() as $p): ?>
              <li <?php e($p->isOpen(), ' class="active"') ?> >
                <a href="<?php echo $p->url() ?>" title="<?php echo $p->titlemenu() ?>"><?php echo $p->titlemenu() == "" ? $p->title()->html() : $p->titlemenu() ?></a>
              </li>
            <?php endforeach ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>