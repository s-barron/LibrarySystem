<?php
    require_once "index.php";
    
    if (isset($_POST['ISBN']) && isset($_SESSION["account"]))
    {
        $i = $conn -> real_escape_string($_POST['ISBN']);    

        //delete reservation of book with corresponding isbn
        $sql1 = "DELETE FROM reservations WHERE ISBN = '$i'";
        $conn->query($sql1);

        //update reserved column in table books to no
        $sql2 = "UPDATE Books SET Reserved = 'N' WHERE ISBN = '$i'";
        $conn->query($sql2);

        //return to showReserved
        header("Location: showReserved.php");

    }

    //get isbn of book in row selected
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
        <p>Are you sure you want to remove your reservation?</p>
        <form method = "post">
            <input type="hidden" name="ISBN" value="$isbn">
            <p><input type="submit" class="btn" value="Remove"/></p>
            <div class="btn">
                <a href="showReserved.php"><center>Cancel</center></a>
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