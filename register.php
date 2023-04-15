<?php
    require_once "index.php"; //shows nav bar with appropriate links
    
    if ( isset($_POST['Username']) && isset($_POST['PWord']) && isset($_POST['ConfirmPWord']) && isset($_POST['FirstName']) && isset($_POST['Surname']) && isset($_POST['AddressLine1'])&& isset($_POST['AddressLine2'])&& isset($_POST['City'])&& isset($_POST['Telephone'])&& isset($_POST['Mobile']))
    {
        $un = $conn -> real_escape_string($_POST['Username']);
        $pw = $conn -> real_escape_string($_POST['PWord']);     
        $cpw = $_POST['ConfirmPWord'];
        $fn = $conn -> real_escape_string($_POST['FirstName']);
        $sn = $conn -> real_escape_string($_POST['Surname']);
        $ad1 = $conn -> real_escape_string($_POST['AddressLine1']);
        $ad2 = $conn -> real_escape_string($_POST['AddressLine2']);
        $ct = $conn -> real_escape_string($_POST['City']);
        $tp = $conn -> real_escape_string($_POST['Telephone']);
        $mb = $conn -> real_escape_string($_POST['Mobile']);

        //get and count rows where the username is the same as the user input - used to error check for duplicate usernames
        $sql = "SELECT * FROM USERS WHERE username = '$un'";
        $result = $conn->query($sql);
        $count = mysqli_num_rows($result);
        
        //check if the number of form fields is equal to the number of POST variables
        if(count(array_filter($_POST))==count($_POST))
        {
            //if username is not taken, and passwords match, and password and mobile number are correct lengths
            if ($count == 0 && $pw == $cpw && strlen($pw) == 6 && strlen((string)$mb) == 10)
            {
                //insert values into database
                $sql = "INSERT INTO Users (Username, PWord, FirstName, Surname, AddressLine1, AddressLine2, City, Telephone, Mobile) VALUES ('$un', '$pw', '$fn', '$sn', '$ad1', '$ad2', '$ct', '$tp', '$mb')";
            
                //if the query is valid, go to login page
                if ($conn->query($sql) === TRUE) 
                {
                    header("Location: login.php");
                } 
                //else display error
                else 
                {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                
            }//end if
            else
            {
                //error messages
                if($count == 1)
                {
                    echo "Username Taken";
                }
                else if(strlen($pw) > 0 && strlen($cpw) > 0 && $pw != $cpw)
                {
                    echo "Passwords do not match";
                }
                else if(strlen($pw)>0 && strlen($pw)!=6)
                {
                    echo "Password must be 6 exactly characters";
                }
                else if(strlen((string)$mb)!=10)
                {
                    echo "Mobile number must be 10 exactly digits";
                }
            }//end else
        }
        else
        {
            echo "Please fill in all form fields";
        }//end else
        $conn->close();
        
    }//end if
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form.css">
    <title>Registration Form</title>
</head>

<body>
    <br  />
    <form method="post">
        <div class="container">
            <h1>Register</h1>
            <p>Please fill in this form to create an account.</p>

            <hr>
            <label for="Username"><b>Username</b></label>
            <input type="text" placeholder="Username" name="Username">

            <label for="PWord"><b>Password</b></label>
            <input type="password" placeholder="Password" name="PWord">

            <label for="ConfirmPWord"><b>Confirm Password</b></label>
            <input type="password" placeholder="Confirm Password" name="ConfirmPWord">

            <label for="FirstName"><b>First Name</b></label>
            <input type="text"placeholder= "First Name" name="FirstName">

            <label for="Surname"><b>Surname</b></label>
            <input type="text" placeholder="Surname" name="Surname">

            <label for="AddressLine1"><b>Address Line 1</b></label>
            <input type="text" placeholder="Address Line 1" name="AddressLine1">

            <label for="AddressLine2"><b>Address Line 2</b></label>
            <input type="text" placeholder= "Address Line 2" name="AddressLine2">

            <label for="City"><b>City</b></label>
            <input type="text" placeholder= "City" name="City">

            <label for="Telephone"><b>Telephone</b></label>
            <input type="number" placeholder="Telephone" name="Telephone">

            <label for="Mobile"><b>Mobile</b></label>
            <input type="number" placeholder="Mobile" name="Mobile">

            <hr>

            <p><input type="submit" class = "btn" value="Register"/></p>
            <div class="container login">
                <p>Already have an account? <a href="login.php">Sign in</a></p>
            </div>
        </div>

    </form>       
</body>
<footer>
    <h6>Site by: Sarah Barron</h6>
</footer>
</html>
