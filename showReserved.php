<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form.css">
    <title>Show Reservations</title>
</head> 
</html>

<?php
    require_once "index.php";

    echo "<br  />";

    if (isset($_SESSION['account']))
    {
        //get the current page number
        if(isset($_GET['page']))
        {
            $page_num = $_GET['page'];
        }//end if
        else
        {
            $page_num = 1;
        }//end else

        //set row limit to 5
        $row_limit = 5;

        //how many rows have been shown
        $rows_shown = ($page_num-1)*$row_limit;

        $acc = $_SESSION['account'];
        $sql = "SELECT * FROM Reservations JOIN Books ON Reservations.ISBN = Books.ISBN WHERE Username = '$acc'";
        $result = $conn->query($sql);
        
        //count how many rows are returned by the query
        $total_rows = mysqli_num_rows($result);

        //calculate the number of pages needed to display the amount of rows
        $total_pages = ceil ($total_rows / $row_limit);  

        //get results from database
        $sql = $sql. "LIMIT $rows_shown, $row_limit";

        $result = $conn->query($sql); 
        
        echo "<h1>$acc's Reservations</h1>";

        //if query returned more than 0 rows
        if ($result->num_rows > 0)
        {
            echo "<table id ='search'>";
            echo "<tr>
                <th>ISBN</th>
                <th>Title</th>
                <th>Author</th>
                <th>Year</th>
                <th>Category ID</th>
                <th>Reserved</th>
                <th>Remove Reservation</th>
            </tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) 
            {
                echo"<tr><td>";
                echo(htmlentities ($row["ISBN"]));
                echo"</td><td>";

                echo(htmlentities ($row["BookTitle"]));
                echo"</td><td>";

                echo(htmlentities ($row["Author"]));
                echo"</td><td>";

                echo(htmlentities ($row["BookYear"]));
                echo"</td><td>";

                echo(htmlentities ($row["CategoryID"]));
                echo"</td><td>";

                echo(htmlentities ($row["Reserved"]));
                echo"</td><td>";

                echo('<a href = "unreserve.php?id='.htmlentities($row["ISBN"]).'">Unreserve</a>');
                echo"</td></tr>\n";
            }//end while
            echo"</table>";            
        }//end if 
        else 
        {
            echo "0 results";
        }//end else
        echo "<br  />";

        //show links to page numbers
        echo "<div class='page'>";       
        for($page_num = 1; $page_num <= $total_pages; $page_num++) 
        { 
            echo '<a href="showReserved.php?page=' . $page_num . '">' . $page_num . ' </a>';  
        }//end for
        echo "</div>";
    }//end if
?>
<html>
    <footer>
        <h6>Site by: Sarah Barron</h6>
    </footer>
</html>
