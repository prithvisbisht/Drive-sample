<?php
require('db.php');
session_start();
$username=$_SESSION['username'];
if ($_SESSION['logged_in']!=false) {
  if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['upload_folder'])){
      $description=$_POST['description'];
      $username=$_SESSION['username'];
      $user_id=$_SESSION['id'];
      $foldername=$_POST['folder_name'];
      if ($_POST['folder_name']!=""){
        if (!is_dir($foldername))
            mkdir('upload/'.$username.'/'.$foldername, 0777, true);
      }
      else {
        echo "unable to create folder";
        die();
      }
      foreach ($_FILES['files']['name'] as $i => $name) {
        if (strlen($_FILES['files']['name'][$i]) >= 1) {
          $sql="INSERT INTO uploads(user_id,username,file,description) values ('$user_id','$username','$name','$description')";
          if (mysqli_query($mysqli,$sql)) {
            if (move_uploaded_file($_FILES['files']['tmp_name'][$i],'upload/'.$username.'/'.$foldername.'/'.$name)) {
              //echo 'upload/'.$username.'/'.$name;
              header("location: home.php");
            }
            else{
              echo "not moved";
            }
          }
          else {
            echo "query error";
          }
          //print_r($_FILES['files']['name');
          //echo $name;
        }
      }
    }
  }
}
else{
  header("location:index.html");
}
?>
<?php

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>
      DRIVE
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
    <?php
    $temp=getcwd();
    $temp=$temp.'/upload/'.$username.'/';
    echo $temp;
    chdir($temp);
    echo getcwd();
    include("temp.php"); ?>
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- MDB core JavaScript -->
  </body>
</html>
