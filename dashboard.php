<?php
/**
 * Created by PhpStorm.
 * User: Aleksejs
 * Date: 03/03/2016
 * Time: 02:50
 */
session_start();

$a = $_SESSION['address'];
$p = $_SESSION['password'];
$port = $_SESSION['port'];

include ("db.php");

$connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DBNAME);
if (mysqli_connect_errno())
    echo "Failed to connect to MySQL: " . mysqli_connect_error();

if ($_POST["model_name"])
{
    $model_name = $_POST["model_name"];
    $model_description = $_POST["model_description"];
    $pangu_id = $_POST["pangu_id"];
    $model_distance = $_POST["model_distance"];
    $model_speed = $_POST["model_speed"];

    $file_name = "images/".$_FILES['model_image']['name'];
    $file_tmp =$_FILES['model_image']['tmp_name'];

    $allowed =  array('gif','png' ,'jpg', 'pdf');
    $ext = substr($file_name, strrpos($file_name, '.') + 1);
    if(!in_array($ext,$allowed) ) {
        echo 'file is not an image.... ';

        header('Location: dashboard.php');
        die();
    }
    else {
        move_uploaded_file($file_tmp, $file_name);
    }

    mysqli_query($connect ,"INSERT INTO models (model_name, server_name, model_image, model_description, pangu_id, distance, speed, server_port) VALUES ('".$model_name."','".$a."','".$file_name."','".$model_description."','".$pangu_id."','".$model_distance."','".$model_speed."','".$port."')");

}

if ($_GET["delete"]){

    $check_access = mysqli_query($connect ,"SELECT * FROM models WHERE id='".$_GET["delete"]."'");
    $check = $check_access->fetch_array(MYSQLI_ASSOC);

    if (($check['server_name'] != $a) or ($check['server_port'] != $port)){
        header('Location: dashboard.php');
        die();
    }
    mysqli_query($connect ,"delete from models where id =".$_GET["delete"]."");
}

mysqli_close($connect);

?>

<head>
    <title>Pangu dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>

    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<div class="container">
    <div class="top">
        <h1 class="text-center" style="color: #337ab7"><a href="http://s613660186.websitehome.co.uk/dashboard.php">Pangu mobile dashboard</a></h1>
    </div>
    <div class="left">
        <a class="link" id="models" href="#">Models</a>
        <a class="link" id="servers" href="#">Server</a><br>
        <a class="link" id="add_model" href="#">Add model</a>
        <a class="link" href="index.php">Logout</a>
        <p style="margin-left: 10%; margin-top: 20%"> Logged as <?echo $a?>
            <br> port : <?echo $port?></p>
    </div>
    <div class="main">
      <?php
      if ($_GET["edit"]) {
          include 'edit.php';
      }
      else {
          include 'models.php';
      }?>
    </div>

</div>

<script>
    $(document).ready(function(){
        $("#models").click(function(){
            $(".main").load('models.php');
        });

        $("#servers").click(function(){
            $(".main").load('servers.php');
        });

        $("#add_model").click(function(){
            $(".main").load('add_model.php');
        });
    });
</script>
