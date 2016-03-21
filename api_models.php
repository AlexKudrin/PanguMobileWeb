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

// check for post data
if ($a) {


    // get a product from products table
    $result = mysqli_query($connect ,"SELECT * FROM models WHERE server_name='".$a."'");

        while($row = mysqli_fetch_array($result)) {
            array_push($response,
                array('id' => $row[0],
                    'model_name' => $row[1],
                    'model_description' => $row[4]
                ));

        }

        echo json_encode(array("result"=>$response));


}

?>

<h1>pangu api</h1>
