<?php
    require_once "index.php";

    //change variables to session variables 
    if(isset($_GET['titlesearch']))
    {
        $_SESSION['titlesearch'] = $_GET['titlesearch'];
    }
    else if(isset($_GET['authorsearch']))
    {
        $_SESSION['authorsearch'] = $_GET['authorsearch'];
    }
    else if(isset($_GET['catsearch']))
    {
        $_SESSION['catsearch'] = $_GET['catsearch'];
        if(!empty($_GET['Categories'])) 
        {
            $_SESSION['Categories'] = $_GET['Categories'];            
        }
        
    }
     
    //if one of the searches has been submitted
    if (isset($_SESSION['titlesearch']) || isset($_SESSION['authorsearch']) || isset($_SESSION['catsearch']))
    {
        //get the current page number
        if(isset($_GET['page']))
        {
            $page_num = $_GET['page'];
        }
        else
        {
            $page_num = 1;
        }

        //set row limit to 5
        $row_limit = 5;

        //how many rows have been shown
        $rows_shown = ($page_num-1)*$row_limit;

        //if user searched by title
        if(isset($_SESSION['titlesearch']))
        {
            $search = $conn -> real_escape_string($_SESSION['titlesearch']);
            $sql = "SELECT * FROM BOOKS WHERE BookTitle LIKE '%$search%'";
        }
        //if user searched by author
        else if(isset($_SESSION['authorsearch']))
        {
            $search = $conn -> real_escape_string($_SESSION['authorsearch']);  
            $sql = "SELECT * FROM BOOKS WHERE Author LIKE '%$search%'";
        }
        //if user searched by category
        else if(isset($_SESSION['catsearch']))
        {
            if(!empty($_SESSION['Categories'])) 
            {
                $search = $_SESSION['Categories'];
                $sql = "SELECT * FROM BOOKS WHERE CategoryID = '$search'";
            }
        }        

        $result = $conn->query($sql);
        
        //count how many rows are returned by the query
        $total_rows = mysqli_num_rows($result);

        //calculate the number of pages needed to display the amount of rows
        $total_pages = ceil ($total_rows / $row_limit);  

        //get results from database
        $sql = $sql. "LIMIT $rows_shown, $row_limit";

        $result = $conn->query($sql); 

        echo "<br  />";
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
                <th>Want to reserve?</th>
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

                //If the book has been reserved
                if($row["Reserved"] == 'Y')
                {
                    echo"Book already reserved";
                }//end if
                //if not logged in   
                else if (!isset($_SESSION["account"]) )
                { 
                    echo('<a href = "login.php">Log in to reserve</a>');
                    echo"</td></tr>\n";
                }//end else if
                //otherwise, user can reserve
                else
                {
                    echo('<a href = "reserve.php?id='.htmlentities($row["ISBN"]).'">Reserve</a>');
                    echo"</td></tr>\n";
                }// end else         
            } // end while
            echo"</table>";        
        } // end if
        else 
        {
            echo "0 results";
        }//end else
        
        echo "<br  />";

        //show links to page numbers
        echo "<div class='page'>";       
        for($page_num = 1; $page_num <= $total_pages; $page_num++) 
        { 
            echo '<a href="showSearch.php?page=' . $page_num . '">' . $page_num . ' </a>';  
        }//end for    
        echo "</div>";
    } // end if

?>

<html>
    <footer>
        <h6>Site by: Sarah Barron</h6>
    </footer>
</html>