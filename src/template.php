<html>
  <head>
    <meta charset="utf-8"/>
    <title>FooBar Restaurant</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
  </head>

  <body>
    <div class="header">
      <h1>FooBar Restaurant</h1>
      <div class="navbar">
	  <?php echo $view_navbar; ?>
      </div>
    </div>
    <div class="container">
	<?php echo $view_content; ?>
    </div>
  </body>
</html>
