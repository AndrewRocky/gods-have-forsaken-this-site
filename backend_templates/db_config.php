<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'db_admin');
define('DB_PASSWORD', '12345');
define('DB_NAME', 'php_5sem');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link == false){
    die("ERROR: Couldn't connect to the database".mysqli_connect_error());
}
?>