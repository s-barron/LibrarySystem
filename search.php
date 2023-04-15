<?php
    require_once "index.php";

    //clear variables
    unset($_SESSION["titlesearch"]);
    unset($_SESSION["authorsearch"]);
    unset($_SESSION["catsearch"]);
    unset($_SESSION["Categories"]);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Search</title>
    </head>
    <body>
        <br  />
        <div class="container">
            <h1>Search</h1>
            <hr>
            <!--Search by Title -->
            <form action="showSearch.php">
                <p><input type="text" placeholder="Search by Title..." name="titlesearch"></p>
                <p><input type="submit" class="btn" value="Search"></p>
            </form>
            <!--Search by Author -->
            <form action="showSearch.php">
                <p><input type="text" placeholder="Search by Author..." name="authorsearch"></p>
                <p><input type="submit" class="btn" value="Search"></p>
            </form>   
            <!--Search by Category --> 
            <form action="showSearch.php">
            <select name="Categories" id="cat">
                <option value="1">Health</option>
                <option value="2">Business</option>
                <option value="3">Biography</option>
                <option value="4">Technology</option>
                <option value="5">Travel</option>
                <option value="6">Self-Help</option>
                <option value="7">Cookery</option>
                <option value="8">Fiction</option>
            </select>
            <p><input type="submit" class="btn" name="catsearch" value="Search"/></p>
            </form>
        </div>
        <br  />
    </body>
    <footer>
        <h6>Site by: Sarah Barron</h6>
    </footer>
</html>