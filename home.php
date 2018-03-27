<?php
require('db.php');
session_start();
if ($_SESSION['logged_in']!=false) {
  if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['submit'])){
      $description=$_POST['description'];
      $username=$_SESSION['username'];
      $user_id=$_SESSION['id'];
      foreach ($_FILES['files']['name'] as $i => $name) {
        if (strlen($_FILES['files']['name'][$i]) >= 1) {
          $sql="INSERT INTO uploads(user_id,username,file,description) values ('$user_id','$username','$name','$description')";
          if (mysqli_query($mysqli,$sql)) {
            if (move_uploaded_file($_FILES['files']['tmp_name'][$i], 'upload/'.$username.'/'.$name)) {
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
    <div class="row">
      <div class="left col-md-2" style="height:700px">
        <div class="">
          <img  class="logo"  src="img/cloud.svg" alt="logo"><br>
          <ul >
            <li><h5><a class="menu" href="#">Home</a></h5></li>
            <li><h5><a  class="menu" href="">Files</a></h5></li>
            <li><h5><a class="menu" href="">My Account</a></h5></li>
          </ul>
        </div>
      </div>
      <div class="col-md-10" style="height:600px">
        <div class="row top" style="height:100px">
          <h1 class="main-text">Welcome <?php echo $_SESSION['username']?></h1>
          <form class="form-inline search">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
        <div class="row" style="height:600px">
          <div class="middle col-md-9" style="height:600px">
            <h1>HEllo World</h1>
            <?php
            $name=$_SESSION['username'];
            //echo $name;
            $dir = "./upload/".$name."";
            $target="./upload";

          // Open a directory, and read its contents
          if (is_dir($dir)){
            if ($dh = opendir($dir)){
              while (($file = readdir($dh)) !== false){
                //echo "filename:" . $file . "<br>";
                if($file!=".." && $file!=".")
                echo "<a href=".$target."/".$name."/".$file.">.".$file.".</a><br>";
              }
              closedir($dh);
            }
          }
            echo "<a href=./".$target."/".$name.">click to see files</a>";
            //session_destroy(); ?>
          </div>
          <div class="right col-md-3"style="height:600px">
            <button class="btn btn-outline-warning" type="button" data-toggle="modal" data-target="#folder">upload folder</button><br>
            <button class="btn btn-outline-warning" type="button" data-toggle="modal" data-target="#file">upload files</button>
            <div class="modal fade" id="folder" tabindex="-1" role="dialog" aria-labelledby="Title" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="Title">Choose folder to upload</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form class="form-group" method="POST" enctype="multipart/form-data" >
                      <input class="form-control-file" type="file" name="files[]" id="files" multiple="" directory="" webkitdirectory="" mozdirectory="">description <input type="textarea" name="description" rows="8" cols="80">
                      <input type="submit" name="submit" class="btn btn-secondary">
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- MDB core JavaScript -->
  </body>
</html>
