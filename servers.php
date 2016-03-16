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

$result = mysqli_query($connect ,"SELECT name FROM servers WHERE address='".$a."' ");

$name = $result->fetch_array(MYSQLI_ASSOC);

$result2 = mysqli_query($connect ,"SELECT COUNT(*) FROM models WHERE server_name='".$a."' ");

$amount = $result2->fetch_array(MYSQLI_ASSOC);;

mysqli_close($connect);

?>

<div class="container">

    <h1>Pangu server address : <font color="blue"> <?echo $a;?> </font></h1>

    <h1>Models collection name : <font color="blue"> <?echo $name['name']; ?> </font></h1>

    <h1>Amount of models : <font color="blue"> <?echo $amount['COUNT(*)'];?> </font></h1>

</div>