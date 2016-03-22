<?php

/**
 * Created by PhpStorm.
 * User: Aleksejs
 * Date: 03/03/2016
 * Time: 02:50
 */

session_start();

$a = $_POST["address"];
$p = $_POST["password"];
$port = $_POST["port"];

if ($a && $p){

    include ("db.php");

    $connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DBNAME);
    if (mysqli_connect_errno())
        echo "Failed to connect to MySQL: " . mysqli_connect_error();

    $result = mysqli_query($connect ,"SELECT password FROM servers WHERE address='".$a."' and port='".$port."'");

    mysqli_close($connect);

    $user = $result->fetch_array(MYSQLI_ASSOC);

    $enc = sha1($p);

    if (substr($enc, 0, strlen($enc)-8) == $user['password']) {
        $_SESSION["address"] = $a;
        $_SESSION["password"] = $p;
        $_SESSION["port"] = $port;
        header('Location: dashboard.php');
        die();
    }
    else
    {
        header('Location: index.php');
        die();
    }

}

mysqli_close($connect);

?>

    <head>
        <title>Pangu dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

        <link rel="stylesheet" type="text/css" href="login.css">
    </head>


        <div class="container" style="margin-top: 10%;">
            <div class="row">
                <h1 class="text-center">Pangu mobile dashboard</h1>
                <div class="col-sm-6 col-md-4 col-md-offset-4">
                    <div class="account-wall">
                        <form class="form-signin" role="form" method="post" action="index.php">
                            <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="Pangu server" id="address" name="address">
                            </div>
                            <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="Port" id="port" name="port">
                            </div>
                            <div class="col-sm-12" style="margin-top: 5px;">
                            <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                            </div>
                            <button class="btn btn-lg btn-primary btn-block" type="submit">
                                Sign in</button>
                        </form>
                    </div>
                    <a href="registration.php" class="text-center new-account">Register new server</a>
                </div>
            </div>
        </div>



