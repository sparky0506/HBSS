<?php
session_start();
include "../../core/config.php";
if (isset ($_GET["previous"]) && !empty($_GET["previous"])){
    $location=$_GET["previous"];
}
else $location=$config["root"];
$query = "SELECT * FROM users WHERE name='" . $_SESSION['post_data'] . "' LIMIT 1";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($result)) {
    if(password_verify($_POST["password"], $row["password"])){
        $_SESSION['session'] = array('ip' => $_SERVER['REMOTE_ADDR'], 'name' => $_SESSION["post_data"]);
        unset ($_SESSION['post_data']);
        header( 'Location: '. $location );
    }
    else echo "Wrong password";
}