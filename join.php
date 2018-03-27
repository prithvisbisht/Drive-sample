<?php
  require 'db.php';
  session_start();
  function rcopy($src, $dst) {
    if (file_exists($dst)) rmdir($dst);
    if (is_dir($src)) {
      mkdir($dst);
      $files = scandir($src);
      foreach ($files as $file)
      if ($file != "." && $file != "..") rcopy("$src/$file", "$dst/$file");
    }
    else if (file_exists($src)) copy($src, $dst);
  }
  if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['login'])){
      // echo "login";
      $email = $mysqli->escape_string($_POST['email']);
      $result = $mysqli->query("SELECT * FROM user WHERE email='$email'");
      if ( $result->num_rows == 0 ){
        echo "User with that email doesn't exist!";
        die();
      }
      else{ // User exists
        $user = $result->fetch_assoc();
        if ( password_verify($_POST['password'], $user['password']) ){
          $_SESSION['email'] = $user['email'];
          $_SESSION['id'] = $user['user_id'];
          $_SESSION['username'] = $user['username'];
          $globals['username']=$user['username'];
          $_SESSION['logged_in'] = true;
          header("location: home.php");
        }
      }
    }
    elseif (isset($_POST['register'])) {
      // echo "register";
      $name = $mysqli->escape_string($_POST['name']);
      $email = $mysqli->escape_string($_POST['email']);;
      $password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
      $result = $mysqli->query("SELECT * FROM user WHERE email='$email'");
      $row=mysqli_fetch_assoc($result);
      if ( $result->num_rows > 0 ){
          echo "email in use by another user";
      }
      else{
        $username=$name.rand();
        $sql = "INSERT INTO user (name,username,email,password) ". "VALUES ('$name','$username','$email','$password')";
          if ($mysqli->query($sql)){
              echo "account created";
              mkdir('upload/'.$username, 0777, true);
              $src=getcwd();
              $src=$src."/lister";
              $dst='upload/'.$username;
              rcopy($src,$dst);
              header("location: index.html");
          }
          else {
            echo "error";
          }
      }
    }
    else{
      echo "ERROR PLEASE REFRESH";
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Drive</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
    <div id="particles-js">
        <div class="form">
          <ul class="row container-fluid tab-group">
            <li class="col tab tab-active"><a class="" id="showLogin">Login</a></li>
            <li class="col tab"><a class="" id="showRegister">Sign Up</a></li>
          </ul>
          <div class="" id="login">
          <form action="join.php" method="post">
            <div class="form-group">
              <label for="email">Email address</label>
              <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label for="pass">Password</label>
              <input name="password" type="password" class="form-control" id="pass" placeholder="Password">
            </div>
            <button name="login" type="submit" class="btn btn-success">Submit</button>
            <button class="btn btn-warning" style="float:right"><a href="index.html">&nbsp Home</a></button>
          </form>
        </div>
        <div id="register">
          <form class="" action="join.php" method="post">
            <div class="form-group">
              <label for="name">Name</label>
              <input name="name" type="name" class="form-control" placeholder="Enter your name">
            </div>
            <div class="form-group">
              <label for="email">Email address</label>
              <input name="email" type="email" class="form-control" placeholder="email">
            </div>
            <div class="form-group">
              <label for="pass">Password</label>
              <input name="password" type="password" class="form-control" placeholder="Password">
            </div>
            <div class="form-group">
              <label for="Cpass">Confirm Password</label>
              <input name="Cpassword" type="password" class="form-control" placeholder="Confirm Password">
            </div>
            <button name="register" type="submit" class="btn btn-success">Submit</button>
            <button class="btn btn-warning" style="float:right"><a href="index.html">&nbsp Home</a></button>
          </form>
        </div>
      </div>
    </div>

    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript" src="js/app.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script>
      particlesJS.load('particles-js',
    'particles.json',function () {
      console.log('particles.json loaded');
    });
    $(document).ready(function(){
      $('#register').hide();
      $(".tab-active").css("font-size","20px")
        $("#showRegister").click(function(){
            $("#login").hide();
            $("#register").show();
            $(".tab").css("font-size","20px")
            $(".tab-active").css("font-size","15px")
        });
        $("#showLogin").click(function(){
          $("#login").show();
          $("#register").hide();
          $(".tab").css("font-size","15px")
          $(".tab-active").css("font-size","20px")
        });
    });
    </script>
  </body>
</html>
