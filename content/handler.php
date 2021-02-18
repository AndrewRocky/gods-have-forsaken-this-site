<?php
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    }
    else $page="articles";

    if (isset($_GET["index"])) {
        $index = $_GET["index"];
    }
    else $index=1;
    
    if ($page == "articles") {
        include "articles.php";
    } elseif ($page == 'about') {
        include "about.php";
    } elseif ($page == 'signup') {
        echo '<iframe class="main_form article" src="backend_templates'.DIRECTORY_SEPARATOR.'sign_up.php"></iframe>';
    } elseif ($page == "login") {
        // echo '<iframe class="main_form article" src="backend_templates'.DIRECTORY_SEPARATOR.'login.php"></iframe>';
        include "backend_templates".DIRECTORY_SEPARATOR."login.php";
    } elseif ($page == 'logout') {
        include 'backend_templates'.DIRECTORY_SEPARATOR.'logout.php';
        // include 'articles.php';
    } elseif ($page == "admin") {
        include 'backend_templates'.DIRECTORY_SEPARATOR.'admin.php';
    }
    else {
        echo 'EMPTY PAGE. page: $page';
    }
    

?>