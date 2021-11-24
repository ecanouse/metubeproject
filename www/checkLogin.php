<!DOCTYPE html>
<html>
<head>
<title>Metube User Home</title>
</head>
    <?php
        $email = $_REQUEST["email"];
        $pass = $_REQUEST["pass"];

        //connecting, selecting database

        $link = mysqli_connect('mysql1.cs.clemson.edu', 'metube_bbec_eqrn', 'metubepass89', 'metube_bbec') 
        or die('Could not connect: ' . mysqli_error($link));


        $query = "SELECT * from user WHERE email = '$email' AND pass = '$pass'";
        $result = mysqli_query($link, $query) or die("Query error: " . mysqli_error($link)."\n");
        if(mysqli_num_rows($result) == 0){
            echo "Incorrect sign-in information, please try again";
            header("Location: wrongInfo.php");
            //want to send them back to home page
        }
        else{
            while($row = mysqli_fetch_assoc($result)){
                session_start();
                $_SESSION["email"]=$email;
                header("Location: userpage.php");
            }
        }
        mysqli_close($link);

    ?>


</html>
