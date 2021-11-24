<!DOCTYPE html>
<html>
<head>
<title>Information Changed</title>
</head>
<?php
    session_start();
    $email = $_SESSION["email"];
    $fname = $_REQUEST["firstname"];
    $lname = $_REQUEST["lastname"];
    $curpass = $_REQUEST["curpass"];
    $newpass = $_REQUEST["pass"];

    //connecting, selecting database

    $link = mysqli_connect('mysql1.cs.clemson.edu', 'metube_bbec_eqrn', 'metubepass89', 'metube_bbec') 
    or die('Could not connect: ' . mysqli_error($link));
    $query = "SELECT * from user WHERE email = '$email'";
    $result = mysqli_query($link, $query) or die("Query error: " . mysqli_error($link)."\n");
    $row = mysqli_fetch_assoc($result);

    if($curpass != $row["pass"]){
        echo "Password is incorrect";
        //header('Location: incorrectPass.php');
        //exit;
    }else{
        //add user to table
        if($fname != ""){
            $query = "UPDATE user SET firstname = '$fname' WHERE email = '$email'";
            $result = mysqli_query($link, $query) or die("Query error: " . mysqli_error($link)."\n");
        }
        if($lname != ""){
            $query = "UPDATE user SET lastname = '$lname' WHERE email = '$email'";
            $result = mysqli_query($link, $query) or die("Query error: " . mysqli_error($link)."\n");
        }
        if($newpass != ""){
            $query = "UPDATE user SET pass = '$newpass' WHERE email = '$email'";
            $result = mysqli_query($link, $query) or die("Query error: " . mysqli_error($link)."\n");
        }
        echo "Information changed Successfully!";
    }
    mysqli_close($link);


?>
<FORM action="userpage.php" method="GET">
    <P>
        <INPUT type="submit" value="Go to my page">
    </P>
</FORM>
</html>

