<?php
/**
 * Created by PhpStorm.
 * User: Aleksejs
 * Date: 05/03/2016
 * Time: 19:12
 */

session_start();

$a = $_SESSION["address"];

?>
<head>
    <link rel="stylesheet" type="text/css" href="login.css">

</head>

<div class="container">
    <form action="dashboard.php" method="post" enctype="multipart/form-data" style="margin-top: 20px;">
        <fieldset class="form-group">
            <div class="account-wall">
                <div style="margin-left: 10px; margin-right: 10px;">
            <h2>Modal parameters</h2>
            <label for="model_name">Modal name</label>
            <input type="text" class="form-control" name="model_name" placeholder="">
            <label for="model_description">Modal description</label>
            <textarea class="form-control"  name="model_description" placeholder="" rows="3"> </textarea>
            <label for="model_image">Modal image</label>
            <input type="file" name="model_image" placeholder="">
            <br>
            <h2>Pangu parameters</h2>
            <label for="pangu_id">Modal pangu id</label>
            <input type="text" class="form-control" name="pangu_id" placeholder="">
            <label for="model_distance">Modal distance</label>
            <input type="text" class="form-control" name="model_distance" placeholder="">
            <label for="model_speed">Modal speed</label>
            <input type="text" class="form-control" name="model_speed" placeholder="">
                </div>
            </div>
        </fieldset>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
