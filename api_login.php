<?php
/**
 * Created by PhpStorm.
 * User: Aleksejs
 * Date: 12/03/2016
 * Time: 15:16
 */

// array for JSON response
$response = array();

include ("db.php");

$connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DBNAME);
if (mysqli_connect_errno())
    echo "Failed to connect to MySQL: " . mysqli_connect_error();

$a = $_GET["address"];
$p = $_GET["password"];
$port = $_GET["port"];

// check for post data
if ($a && $p) {

    $enc = sha1($p);

    $password =  substr($enc, 0, strlen($enc)-8);

    // get a product from products table
    $result = mysqli_query($connect ,"SELECT * FROM servers WHERE address='".$a."' AND password='".$password."' and port='".$port."'");

    if (mysqli_fetch_assoc($result)!==null){
        // check for empty result

        $response["success"] = 1;

        // echoing JSON response
        echo json_encode($response);

    } else {
        // required field is missing
        $response["success"] = 0;

        // echoing JSON response
        echo json_encode($response);
    }
}

?>

<h1>pangu api</h1>
