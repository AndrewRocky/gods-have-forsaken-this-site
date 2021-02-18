<?php
require_once "db_config.php";

$id = trim($_SESSION["id"]);
$hash = trim($_SESSION["secret"]);

$sql = "SELECT id, password FROM users WHERE id in (SELECT user_id from admins) AND id = ?";

$valid = false;

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
                    //then user is admin
                    $valid = true; 
                }
            }
        }
    }
}
mysqli_stmt_close($stmt);


if($_SERVER["REQUEST_METHOD"] == "POST"){
    // POST - delete user
    if(isset($_POST["user_delete"])){
        $user_id = $_POST["user_delete"];
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}


// if not admin - reedirect to articles
if ($valid == false) {
    echo "<script type='text/javascript'>location.href = '?page=articles';</script>";
    exit;
}

echo "<div class='article admin_zone'>";
echo "<h1 class='main'>Admin Area</h1>
    </br>
    <h1>User management</h1>
    <table>
    <tr>
        <th>id</th>
        <th>username</th>
        <th>created_at</th>
        <th>DELETE</th>
    </tr>";
$query = "SELECT id, username, created_at from users";
$result = mysqli_query($link, $query);
$rows = mysqli_fetch_all($result, MYSQLI_BOTH);
foreach($rows as $row) {
    $id = $row['id'];
    $username = $row['username'];
    $date = $row['created_at'];
    echo "
    <tr>
        <th>$id</th>
        <th>$username</th>
        <th>$date</th>
        <th style='text-align: center; color: red; font-weight:bold'>
            <form method='post'>
                <button name='user_delete' type='submit' class='form-btn form-btn-sml' value='$id'>[X]</button>
            </form>
        </th>
    </tr>";
}
echo "</table>";
echo "</div>";
mysqli_close($link);
?>