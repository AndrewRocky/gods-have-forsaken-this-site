<?php
include_once ".".DIRECTORY_SEPARATOR."backend_templates".DIRECTORY_SEPARATOR."db_config.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // POST - delete article
    if(isset($_POST["article_delete"])){
        $user_id = $_POST["article_delete"];
        $query = "DELETE FROM article WHERE id = ?";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "i", $article_id);
        mysqli_stmt_execute($stmt);
        //mysqli_stmt_close($stmt);
    }
}
    $max_articles = 23;
    $art_on_page = 3;
    //require_once 'db_config.php';
    if (isset($_GET["start"])) {
        $start = $_GET["start"];
    } else $start = 0;

    $end = $start + $art_on_page - 1;
    $end = min($end, $max_articles);

    //articles list
    
    $query = "SELECT id, name, author_id, description FROM article limit $start, $art_on_page";
    $result = mysqli_query($link, $query);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    foreach($rows as $row) {
        $art_id = $row["id"];
        $name = $row["name"];
        $author_id = $row["author_id"];
        $description = $row["description"];
        echo "<div class='article'>
                    <header>
                        <div class='time'>
                            <div class='year'>2020</div>
                            <div class='date'>26<span>sep</span></div>
                        </div>
                        <h1> ",$name, "#",$art_id,"</h1>
                        <div class='comments'>69</div>
                    </header>";
        if(($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
            
            $is_admin = false;
            // check if ADMIN
            $id = trim($_SESSION["id"]);
            $hash = trim($_SESSION["secret"]);
            $sql = "SELECT id, password FROM users WHERE id in (SELECT user_id from admin) AND id = ?";
            echo "ADMIN YES";

            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "i", $param_id);
                $param_id = $id;
                echo "ADMIN YEES";
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    //check if username exists
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        mysqli_stmt_bind_result($stmt, $db_id, $db_hash);
                        
                        if(mysqli_stmt_fetch($stmt)){
                            if($db_id == $id && $db_hash == $hash){
                                //then user is admin
                                echo "ADMIN YES";
                                $is_admin = true;
                            }
                        }
                    }
                }
            }

            if(($_SESSION["id"] == $author_id) || $is_admin){
                echo "
                <form method='post'>
                    <button name='article_delete' type='submit' class='form-btn form-btn-sml' value='$art_id'>[REMOVE ARTICLE]</button>
                </form>
                ";
            }
        }
        echo
                    "<p>",$description,"</p>
                    <footer>
                        <em>Written by: </em><strong>",$author_id,"</strong>
                        <span class='newLine'><em>Tags:</em><a class=tags href='http://'>cool</a><a class=tags href='http://'>modern</a><a class=tags href='http://'>hype</a></span>
                        <a class=button href='http://'>Continue Reading</a>
                    </footer>
                </div>";
    }

    $query = "SELECT count(*) from article";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result, MYSQLI_BOTH);
    $articles_count = $row[0];
    // for ($i=$start; $i <= $end; $i++) { 
    //     echo '<div class="article">
    //             <header>
    //                 <div class="time">
    //                     <div class="year">2020</div>
    //                     <div class="date">26<span>sep</span></div>
    //                 </div>
    //                 <h1>Sample Post ',$i,'</h1>
    //                 <div class="comments">69</div>
    //             </header>
    //             <p>lorem blablabla</p>
    //             <footer>
    //                 <em>Written by: </em><strong>Author Name</strong>
    //                 <span class="newLine"><em>Tags:</em><a class=tags href="http://">cool</a><a class=tags href="http://">modern</a><a class=tags href="http://">hype</a></span>
    //                 <a class=button href="http://">Continue Reading</a>
    //             </footer>
    //         </div>';
    // }
    

    $number_of_pages = $articles_count/$art_on_page;
    echo $number_of_pages;

    //pagination
    echo '<nav class="pagination">';
    for ($i=1; $i <= $number_of_pages; $i++) { 
        $start_i = ($i-1)*$art_on_page;
        echo '<a href="?page=articles&start=',$start_i,'">',$i,'</a>';
    }
    echo '</nav>';
