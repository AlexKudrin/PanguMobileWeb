<?php
/**
 * Created by PhpStorm.
 * User: Aleksejs
 * Date: 16/03/2016
 * Time: 03:05
 */

session_start();

$a = $_SESSION["address"];
$port = $_SESSION["port"];

include ("db.php");

$connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DBNAME);
if (mysqli_connect_errno())
    echo "Failed to connect to MySQL: " . mysqli_connect_error();

$check_access = mysqli_query($connect ,"SELECT * FROM models WHERE id='".$_GET["edit"]."'");
$check = $check_access->fetch_array(MYSQLI_ASSOC);

if (($check['server_name'] != $a) or ($check['server_port'] != $port)){
    header('Location: dashboard.php');
    die();
}

if ($_POST["model_name"] or $_POST["model_description"]){
       mysqli_query($connect ,"UPDATE models SET model_name='".$_POST["model_name"]."', model_description='".addslashes($_POST["model_description"])."' WHERE id='".$_GET["edit"]."'");
    header('Location: dashboard.php');
    die();
}

$result = mysqli_query($connect ,"SELECT * FROM models WHERE id='".$_GET["edit"]."'");

$modal = $result->fetch_array(MYSQLI_ASSOC);

mysqli_close($connect);

?>

<head>

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="login.css">

</head>

<div class="container">
<div style="margin-top: 15px;">
    <form action="edit.php?edit=<?echo $_GET["edit"];?>" method="post" enctype="multipart/form-data">
        <div class="account-wall" style="margin-bottom: 10px;">
            <div style="margin-left: 10px; margin-right: 10px;">
        <fieldset class="form-group">
            <label for="model_name">Modal name</label>
            <input type="text" class="form-control" name="model_name" value="<?echo $modal["model_name"];?>">
            <label for="model_description">Modal description</label>
            <textarea class="form-control"  name="model_description" rows="3"><?echo $modal["model_description"];?></textarea>
        </fieldset>
        </div>
    </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

</div>
