<?php
/**
 * Created by PhpStorm.
 * User: Aleksejs
 * Date: 05/03/2016
 * Time: 17:31
 */

session_start();

$a = $_SESSION["address"];

include ("db.php");

$connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DBNAME);
if (mysqli_connect_errno())
    echo "Failed to connect to MySQL: " . mysqli_connect_error();


$models = mysqli_query($connect ,"SELECT * FROM models WHERE server_name='".$a."' ORDER BY id ASC");

mysqli_close($connect);

?>

<head>


</head>

<div class="container">
<table class="table table-striped">
    <thead>
    <tr>
        <th>ID</th>
        <th>Model name</th>
        <th>Model image</th>
        <th>Model description</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    while($row = $models->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"]. "</td>";
        echo "<td>" . $row["model_name"]. "</td>";
        echo "<td><img src='i" . $row["model_image"]. "' /></td>";
        echo "<td>" . $row["model_description"]. "</td>";
        echo "<td>  <a href=\"dashboard.php?delete=" . $row["id"]. "\" class=\"btn btn-danger\" role=\"button\">Delete</a>
                    <a href=\"dashboard.php?edit=" . $row["id"]. "\" class=\"btn btn-primary\" role=\"button\">Edit</a>
                     </td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
