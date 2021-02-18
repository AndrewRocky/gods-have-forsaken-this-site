<?php
require_once "db_config.php";

$id = trim($_SESSION["id"]);
$hash = trim($_SESSION["secret"]);

$sql = "SELECT id, password FROM users WHERE id in (SELECT user_id from admins) AND id = ?";

if($stmt = mysqli_prepare($link,$sql)){
    mysqli_stmt_bind_param($stmt, "i", $param_id);
    $param_id = $id;
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        //check if username exists
        if(mysqli_stmt_num_rows($stmt) == 1){
            mysqli_stmt_bind_result($stmt, $db_id, $db_hash);
            
            if(mysqli_stmt_fetch($stmt)){
                if($db_id == $id && $db_hash == $hash){
                    echo $db_id, $id;
                    //then user is admin
                    echo "<a href='?page=admin' class='button'>Admin</a>";
                }
            }
        }
    }
}
//mysqli_stmt_close($stmt);

?>