<?php
    require_once "index.php";

    //if account and pw aren't null
    if ( isset($_POST["account"]) && isset($_POST["pw"]) )
    {
        $account = $conn -> real_escape_string($_POST['account']);  
        $pw = $conn -> real_escape_string($_POST['pw']);   

        //get and count rows with matching username and password, 
        $sql = "SELECT * FROM USERS WHERE username = '$account' and pword = '$pw'";
        $result = $conn->query($sql);
        $count = mysqli_num_rows($result);

        //if there's one row with matching username and password
        if($count == 1)
        {
            //set session variable to account name
            $_SESSION["account"] = $account;
            $_SESSION["success"] = "Logged in";
            header( 'Location: login.php' );
            return;
        }//end if
        else
        {
            $_SESSION["error"] = "Invalid username or password.";
            header( 'Location: login.php' ) ;
            return;
        }//end else

    }//end if
    else if ( count($_POST) > 0 )
    {
        $_SESSION["error"] = "Missing Required Information"; 
        header( 'Location: login.php' ) ;
        return;

    }//end else if
?>

<html>
    <head>
    </head>
    <body style="font-family: sans-serif;">
        <br  />
        <?php
            //print error
            if ( isset($_SESSION["error"]) )
            {
                echo('<p style="color:red">Error: '.
                $_SESSION["error"]."</p>\n");
                unset($_SESSION["error"]);
            }//end if

        ?>
        <form method="post">
            <div class="container">
                <h1>Log In</h1>
                <p>Please fill in this form to log in.</p>
                <hr>

                <p><input type="text" placeholder="Username" name="account" value=""></p>
                <p><input type="password" placeholder="Password" name="pw" value=""></p>

                <hr>

                <?php
                    //Show Log In button if not logged in                
                    if (!isset($_SESSION["account"]) )
                    { 
                ?>
                <input type="submit" class = "btn" value="Log In">
                
                <?php
                    }//end if
                    //Show Log Out button if logged in
                    if (isset($_SESSION["account"]) )
                    { 

                ?>
                <input type="button" class="btn" value="Logout" onclick="location.href='logout.php'; return false ">

                <?php
                    }//end if
                    if (!isset($_SESSION["account"]) )
                    { 
                ?>
                <div class="container login">
                    <p>Dont have an account? <a href="register.php">Register</a></p>
                </div>

                <?php
                    } // end if
                ?>


            </div>
        </form>
    </body>
    <footer>
        <h6>Site by: Sarah Barron</h6>
    </footer>
</html>
