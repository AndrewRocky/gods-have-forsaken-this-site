<?php
// Initialize the session
session_start();
if (isset($_GET["page"])) {
    $page = $_GET["page"];
}
if ($page == "logout"){
    session_unset();
    session_destroy();
    header("Location: ?page=articles");
    exit();
}
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && ($page == 'signup' || $page == 'login')){
    header("location: ?page=articles");
    exit;
}

include "templates/head.php";
include "templates/header.php";
echo '<div>';
include "templates/aside.php";

include "content/handler.php";
echo '</div>';
include "templates/footer.php";

?>