<?php

$host = "localhost"; /* Host name */
$user = "sadness_jellyworld"; /* User */
$password = ""; /* Password */
$dbname = "sadness_jellyworld"; /* Database name */

$con = mysqli_connect($host, $user, $password, $dbname);
// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}