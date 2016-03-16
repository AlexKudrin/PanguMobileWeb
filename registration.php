<?php
/**
 * Created by PhpStorm.
 * User: Aleksejs
 * Date: 03/03/2016
 * Time: 02:50
 */

if ($_POST['address'] && $_POST['password']) {

    $a = $_POST['address'];
    $p = $_POST['password'];
    $s = $_POST['name'];

    include ("db.php");

    $connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DBNAME);
    if (mysqli_connect_errno())
        echo "Failed to connect to MySQL: " . mysqli_connect_error();

    $password = sha1($p);

    mysqli_query($connect ,"INSERT INTO servers (address, password, name) VALUES ('".$a."', '".$password."', '".$s."');");
    mysqli_close($connect);
    header('Location: index.php');
    die();
}

?>

<head>
    <title>Pangu dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="login.css">
</head>


<div class="container" style="margin-top: 10%;">
    <div class="row">
        <h1 class="text-center">Pangu mobile dashboard</h1>
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="account-wall">
                <form class="form-signin" role="form" method="post" action="registration.php">
                    <input type="text" class="form-control" placeholder="Server adress" id="address" name="address">
                    <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                    <br>
                    <input type="name" class="form-control" placeholder="Server name" id="name" name="name">
                    <br>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">
                        Register</button>
                </form>
            </div>
            <a href="index.php" class="text-center new-account">Back</a>
        </div>
    </div>
</div>



