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
    else if(isset($_POST['submit'])){
      $description=$_POST['description'];
      $username=$_SESSION['username'];
      $user_id=$_SESSION['id'];
      foreach ($_FILES['files']['name'] as $i => $name) {
        if (strlen($_FILES['files']['name'][$i]) >= 1) {
          $sql="INSERT INTO uploads(user_id,username,file,description) values ('$user_id','$username','$name','$description')";
          if (mysqli_query($mysqli,$sql)) {
            if (move_uploaded_file($_FILES['files']['tmp_name'][$i],'upload/'.$username.'/'.$name)) {
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
    <title>Upload</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
    <div class="secon">
    </div>
    <div class="container">
        <!--Grid row-->
        <div class="row justify-content-around">
            <!--Grid column-->
            <div class="col-md-5 col-sm-12 text-center mb-5 block">
              <img class="ico-image" src="img/file.jpg" alt=""><hr>
              <div class="container">
                <button class="btn btn-warning btn-block" type="button" data-toggle="modal" data-target="#folder">upload folder</button><br>
                <!-- <button class="btn btn-outline-warning" type="button" data-toggle="modal" data-target="#file">upload files</button> -->
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
                          <input type="text" name="folder_name" placeholder="Enter Folder Name" required>
                          <input class="form-control-file" type="file" name="files[]" id="files" multiple="" directory="" webkitdirectory="" mozdirectory="">description <input type="textarea" name="description" rows="8" cols="80">
                          <input type="submit" name="upload_folder" class="btn btn-secondary">
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-5 offset-md-2 col-sm-12 text-center mb-5 block">
              <img class="ico-image" src="img/folder.jpg" alt=""><hr>
              <div class="container">
                <button class="btn btn-warning btn-block" type="button" data-toggle="modal" data-target="#filesuplod">upload Files</button><br>
                <!-- <button class="btn btn-outline-warning" type="button" data-toggle="modal" data-target="#file">upload files</button> -->
                <div class="modal fade" id="filesuplod" tabindex="-1" role="dialog" aria-labelledby="Title" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="Title">Choose Files to upload</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form class="form-group" method="POST" enctype="multipart/form-data">
                          <input class="form-control-file" type="file" name="files[]" id="file" multiple="multiple">description <input type="textarea" name="description" rows="8" cols="80">
                          <input type="submit" name="submit" class="btn btn-secondary">
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--Grid column-->
        </div>
        <!--Grid row-->
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
  </body>
</html>
