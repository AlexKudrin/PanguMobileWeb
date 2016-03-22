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

$result = mysqli_query($connect ,"SELECT name FROM servers WHERE address='".$a."' and port='".$port."' ");

$name = $result->fetch_array(MYSQLI_ASSOC);

$result2 = mysqli_query($connect ,"SELECT COUNT(*) FROM models WHERE server_name='".$a."' and server_port='".$port."' ");

$amount = $result2->fetch_array(MYSQLI_ASSOC);;

mysqli_close($connect);

?>
<head>
    <link rel="stylesheet" type="text/css" href="login.css">

</head>

<div class="container">
    <center>
        <div class="account-wall" style="margin-top: 15px;">

            <h1>Pangu server address : <?echo $a;?> </h1>

            <h1>Server port : <?echo $port;?> </h1>

            <h1>Models collection name : <?echo $name['name']; ?> </h1>

            <h1>Amount of models : <?echo $amount['COUNT(*)'];?> </h1>

        </div>

    </center>

</div>