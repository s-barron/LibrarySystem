<html>
<head>
    <link rel="stylesheet" href="form.css">
</head>
    <header>
    <center><h1>Library System</h1></center>
        <nav>
            <a href="search.php">Search</a>
            <div class = topnav-right>
                <a href="login.php">Log In</a>
            </div>

            <?php
                require_once "LibDb.php";
                session_start();

                //if there's an error, display the error message
                if ( isset($_SESSION["error"]) )
                {
                    echo('<p style="color:red">Error: '.$_SESSION["error"]."</p>\n");
                    unset($_SESSION["error"]);
                }
                //if user successfully logged in, display log out button in nav bar and allow user to view their reservations
                else if ( isset($_SESSION["success"]) ) 
                {
                    echo "<a href='showReserved.php'>My Reservations</a>";   
                    echo "<div class = topnav-right>";
                    echo "<a href='logout.php'>Log Out</a>";     
                    echo "</div>";                     
                }
            ?>
        </nav>
    </header>
<html> 