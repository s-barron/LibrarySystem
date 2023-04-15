<?php
    require_once "index.php";

    if (isset($_POST['ISBN']) && isset($_SESSION["account"]))
    {
        $i = $conn -> real_escape_string($_POST['ISBN']); //isbn of row
        $acc = $_SESSION['account']; //current account name 
        $date = date('y/m/d'); //get the current date        

        //insert values into reservations table
        $sql1 = "INSERT INTO Reservations(ISBN, Username, ReservedDate) VALUES('$i','$acc','$date')";
        $conn->query($sql1);
        
        //update reserved column in table books to yes
        $sql2 = "UPDATE Books SET Reserved = 'Y' WHERE ISBN = '$i'";
        $conn->query($sql2);

        //return to search page
        header("Location: search.php");

    }

    //get row with correct isbn
    $isbn = $conn -> real_escape_string($_GET['id']);
    $sql = "SELECT ISBN FROM Books WHERE ISBN = '$isbn'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $isbn = htmlentities ($row["ISBN"]);

    echo <<< _END
    <head>
        <link rel="stylesheet" href="form.css">
    </head>
    <br  />
    <div class="container">
        <form method = "post">  
            <p>Are you sure you want to reserve?</p>
            <input type="hidden" name="ISBN" value="$isbn">
            <p><input type="submit" class="btn" value="Reserve"/></p>
            <div class="btn">
                <a href="search.php"><center>Cancel</center></a>
            </div>
        </form>
    </div>
    _END;
    $conn->close();
?>

<html>
    <footer>
        <h6>Site by: Sarah Barron</h6>
    </footer>
</html>