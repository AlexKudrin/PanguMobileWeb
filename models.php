<?php
/**
 * Created by PhpStorm.
 * User: Aleksejs
 * Date: 05/03/2016
 * Time: 17:31
 */

session_start();

$a = $_SESSION["address"];
$port = $_SESSION["port"];

include ("db.php");

$connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DBNAME);
if (mysqli_connect_errno())
    echo "Failed to connect to MySQL: " . mysqli_connect_error();


$models = mysqli_query($connect ,"SELECT * FROM models WHERE server_name='".$a."' and server_port='".$port."' ORDER BY id ASC");

mysqli_close($connect);

?>

<head>

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="login.css">

</head>

<div class="container">

    <div class="account-wall" style="margin-top: 15px;">
<table class="table" style="margin-top: 10px; width: 100%">
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
        echo "<td width=\"10%\">" . $row["model_name"]. "</td>";
        echo "<td><img width='225' height='225' src='i" . $row["model_image"]. "' /></td>";
        echo "<td>" . $row["model_description"]. "</td>";
        echo "<td width=\"13%\">  <a href=\"dashboard.php?delete=" . $row["id"]. "\" class=\"btn btn-danger\" role=\"button\">Delete</a>
                    <a href=\"dashboard.php?edit=" . $row["id"]. "\" class=\"btn btn-primary\" role=\"button\">Edit</a>
                     </td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
</div>
    <br/>

