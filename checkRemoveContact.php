<!DOCTYPE html>
<html>
<head>
<title>Metube User Home</title>
</head>
    <?php
        session_start();
        $email = $_SESSION["email"];
        $cemail = $_REQUEST["cemail"];
        $cId = -1;
        $uId = -1;

        //connecting, selecting database

        $link = mysqli_connect('mysql1.cs.clemson.edu', 'metube_bbec_eqrn', 'metubepass89', 'metube_bbec') 
        or die('Could not connect: ' . mysqli_error($link));


        $query = "SELECT * from user WHERE email = '$cemail' ";
        $result = mysqli_query($link, $query) or die("Query error: " . mysqli_error($link)."\n");
        if(mysqli_num_rows($result) == 0){
            echo "No user with that email exists";
            header("Location: wrongContact.php");
            //want to send them back to home page
        }
        else{
            while($row = mysqli_fetch_assoc($result)){
                $cId = $row["userId"];
            }
        }

        $query = "SELECT * from user WHERE email = '$email' ";
        $result = mysqli_query($link, $query) or die("Query error: " . mysqli_error($link)."\n");
        if(mysqli_num_rows($result) == 0){
            header("Location: wrongInfo.php");
        }else{
            while($row = mysqli_fetch_assoc($result)){
                $uId = $row["userId"];
            }
        }

        //this doesn't check if they were actually contacts before
        if($uId != -1 || $cId != -1){
            $query = "DELETE FROM contact WHERE userId = '$uId' AND contactId = '$cId'";
            $result = mysqli_query($link, $query) or die("Query error: " . mysqli_error($link)."\n");
            header("Location: contactRemoveSuccessful.php");
        }else{
            echo "Error removing contact";
        }

    ?>
<FORM action="userpage.php" method="GET">
    <P>
        <INPUT type="submit" value="Go to my page">
    </P>
</FORM>

</html>
