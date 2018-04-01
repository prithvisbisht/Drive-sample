<?php
session_start();
$username=$_SESSION['username'];
$temp=getcwd();
$temp=$temp.'/upload/'.$username.'/';
chdir($temp);
$path=$temp;
// echo getcwd();

include './index.php';
// function ListFolder($path)
// {
//     //using the opendir function
//     $dir_handle = @opendir($path) or die("Unable to open $path");
//
//     //Leave only the lastest folder name
//     $list=explode("/",$path);
//     $dirname = end($list);
//
//     //display the target folder.
//     echo ("<li>$dirname\n");
//     echo "<ul>\n";
//     while (false !== ($file = readdir($dir_handle)))
//     {
//         if($file!="." && $file!="..")
//         {
//             if (is_dir($path."/".$file))
//             {
//                 //Display a list of sub folders.
//                 ListFolder($path."/".$file);
//             }
//             else
//             {
//                 //Display a list of files.
//                 echo "<li>$file</li>";
//             }
//         }
//     }
//     echo "</ul>\n";
//     echo "</li>\n";
//
//     //closing the directory
//     closedir($dir_handle);
// }
//
// ListFolder($path);
// ?>
