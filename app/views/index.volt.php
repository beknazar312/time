
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
    <title>Pricing example for Bootstrap</title>

    <!-- CSS -->
    <?= $this->tag->stylesheetLink('css/bootstrap.min.css') ?>
    <?= $this->tag->stylesheetLink('css/jquery-ui.css') ?>
    <?= $this->tag->stylesheetLink('css/custom.css') ?>
    <?= $this->tag->javascriptInclude('js/jquery.min.js') ?>

  </head>

  <body>

    <?= $this->getContent() ?>
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <?= $this->tag->javascriptInclude('js/bootstrap.min.js') ?>
    <?= $this->tag->javascriptInclude('js/jquery-ui.js') ?>
    <?= $this->tag->javascriptInclude('js/main.js') ?>


  </body>
</html>
