
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
    {{ stylesheet_link('css/bootstrap.min.css') }}
    {{ stylesheet_link('css/jquery-ui.css') }}
    {{ stylesheet_link('css/custom.css') }}
    {{ javascript_include('js/jquery.min.js') }}

  </head>

  <body>

    {{content()}}
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    {{ javascript_include('js/bootstrap.min.js') }}
    {{ javascript_include('js/jquery-ui.js') }}
    {{ javascript_include('js/main.js') }}


  </body>
</html>
