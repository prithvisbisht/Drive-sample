<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Logout</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>
  <body>
    <div class="logout container">
      <div class="alert alert-info" role="alert">
        <h4 class="alert-heading">Logout</h4>
        <p><?php echo $_SESSION['message']; ?></p>
        <hr>
        <p class="alert alert-success"><strong><a href="join.php">Click here</a></strong> to login</p>
      </div>
    </div>
  </body>
</html>
