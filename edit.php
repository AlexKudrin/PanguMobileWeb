<?php
/**
 * Created by PhpStorm.
 * User: Aleksejs
 * Date: 16/03/2016
 * Time: 03:05
 */

session_start();

$a = $_SESSION["address"];

include ("db.php");

$connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DBNAME);
if (mysqli_connect_errno())
    echo "Failed to connect to MySQL: " . mysqli_connect_error();

if ($_POST["model_name"]){
       mysqli_query($connect ,"UPDATE models SET model_name='".$_POST["model_name"]."', model_description='".$_POST["model_description"]."' WHERE id='".$_GET["edit"]."'");
    header('Location: dashboard.php');
    die();
}

$result = mysqli_query($connect ,"SELECT * FROM models WHERE id='".$_GET["edit"]."'");

$modal = $result->fetch_array(MYSQLI_ASSOC);

mysqli_close($connect);

?>

<div class="container">

    <form action="edit.php?edit=<?echo $_GET["edit"];?>" method="post" enctype="multipart/form-data">
        <fieldset class="form-group">
            <label for="model_name">Modal name</label>
            <input type="text" class="form-control" name="model_name" value="<?echo $modal["model_name"];?>">
            <label for="model_description">Modal description</label>
            <textarea class="form-control"  name="model_description" rows="3"><?echo $modal["model_description"];?></textarea>
        </fieldset>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>
