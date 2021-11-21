<!DOCTYPE html>
<html>
<head>
<title>Welcome to Metube!</title>
</head>
<?php
    $fname = $_REQUEST["firstname"];
    $lname = $_REQUEST["lastname"];
    $email = $_REQUEST["email"];
    $pass = $_REQUEST["pass"];

    //connecting, selecting database

    $link = mysqli_connect('mysql1.cs.clemson.edu', 'metube_bbec_eqrn', 'metubepass89', 'metube_bbec') 
    or die('Could not connect: ' . mysqli_error($link));

    if(strpos($email, '@') == false  || strpos($email, '.') ==  false){
        header('Location: emailInvalid.php');
        exit;
    }else{
        //add user to table
        $query = "SELECT * from user WHERE email = '$email'";
        $result = mysqli_query($link, $query) or die("Query error: " . mysqli_error($link)."\n");
        if(mysqli_num_rows($result) > 0){
            echo "an account with this email already exists";
            header('Location: dupAccount.php');
        }
        else{
            $query = "INSERT INTO user (firstname, lastname, email, pass) VALUES ('$fname', '$lname', '$email', '$pass')";
            $result = mysqli_query($link, $query) or die("Query error: " . mysqli_error($link)."\n");
            session_start();
            $_SESSION["email"] = $email;
            echo "Welcome to Metube " . $fname . " " . $lname . "!";
        }
    }

        //get user id
        $query = "SELECT * from user WHERE email = '$email' ";
        $result = mysqli_query($link, $query) or die("1Query error: " . mysqli_error($link)."\n");
        if(mysqli_num_rows($result) == 0){
            header("Location: wrongInfo.php");
        }else{
            while($row = mysqli_fetch_assoc($result)){
                $uId = $row["userId"];

            }
        }

    $query = "INSERT INTO playlist (userId, listName, playlistDesc) VALUES ('$uId', 'Favorites', 'Keep your favorite Files Here!')";
    $result = mysqli_query($link, $query) or die("Query error: " . mysqli_error($link)."\n");


?>
<FORM action="userpage.php" method="GET">
    <P>
        <INPUT type="submit" value="Go to my page">
    </P>
</FORM>
</html>

