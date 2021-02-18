        <div class="aside">

            <section>
                <h1>User Area</h1>
                <ul id="userarea">
                <?php if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
                    echo 
                        '<li><a href="?page=signup">Sign Up</a></li>
                        <li><a href="?page=login">Login</a></li>';
                    
                } else {
                    $username = htmlspecialchars($_SESSION["username"]);
                    echo 
                        "<p>Hi, $username!</p>
                        <a href='?page=logout' class='button'>Logout</a>";
                    include 'backend_templates'.DIRECTORY_SEPARATOR.'admin_button.php';
                    }?>
                </ul>
            </section>

            <section>
                <h1>Stay in Touch</h1>
                <ul id="inTouch">
                    <li><span class="twitter">12345</span><a href="http://">Twitter</a> followers</li>
                    <li><span class="rss">4321</span><a href="http://">RSS feed</a> subscribers</li>
                </ul>
            </section>

            <nav>
                <h1>Blogroll</h1>
                <ul class="links">
                    <li><a href="http://">A list of</a></li>
                    <li><a href="http://">Friendly blogs</a></li>
                    <li><a href="http://">That have exchanged</a></li>
                    <li><a href="http://">links with us</a></li>
                </ul>
            </nav>
            
            <section>
                <blockquote>whats tis?</blockquote>
                <a class="twitterHandle" href="http://">@dikkitydikkitydik</a>
            </section>
    </div>
        
