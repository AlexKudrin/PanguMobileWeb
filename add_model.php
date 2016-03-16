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

<div class="container">

    <form action="dashboard.php" method="post" enctype="multipart/form-data">
        <fieldset class="form-group">
            <label for="model_name">Modal name</label>
            <input type="text" class="form-control" name="model_name" placeholder="">
            <label for="model_description">Modal description</label>
            <textarea class="form-control"  name="model_description" placeholder="" rows="3"> </textarea>
            <label for="model_image">Modal image</label>
            <input type="file" name="model_image" placeholder="">
        </fieldset>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>
