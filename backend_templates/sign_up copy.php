<?php
//Include db config
require_once 'db_config.php';

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // check username
    if(empty(trim($_POST["username"]))){
        $username_err = "Error: Please enter a username.";
    } else {
        //Prepare SELECT statement
        $sql = "SELECT id from users WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the statement above as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            //Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                //store result
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Error: This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Something went wrong!(db usr_check)";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    //Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Error: Please enter a password";
    } elseif(strlen(trim($_POST["password"])) < 4){
        $password_err = "Error: Password must be atleast 4 characters";
    } else{
        $password = trim($_POST["password"]);
    }

    //Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $password_err = "Error: Please confirm password";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Error: 'password' and 'confirm password' are different";
        }
    }

    //Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        //Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            //Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // create a password hash

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                //Redirect to main page
                //header("location: index.php");
                echo "Success?";
            } else{
                echo "Something went wrong!(DB insert)";
            }

            //Close statement
            mysqli_stmt_close($stmt);
        }
    }

    //Close connection
    mysqli_close($link);
}

// include "content\sign_up_form.php";

?>

</body>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
    <!--<style>-->
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?page=signup" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
    </div>
</body>