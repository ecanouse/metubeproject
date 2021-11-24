<!DOCTYPE html>
<html>
<head>
<title>Information Changed</title>
</head>
<?php
    session_start();
    $email = $_SESSION["email"];
    $playlistId = $_SESSION["currentPlaylist"];
    $name = $_REQUEST["pname"];
    $uId = -1;

    //connecting, selecting database
    $link = mysqli_connect('mysql1.cs.clemson.edu', 'metube_bbec_eqrn', 'metubepass89', 'metube_bbec') 
    or die('Could not connect: ' . mysqli_error($link));

    //get user id
    $query = "SELECT * from user WHERE email = '$email' ";
    $result = mysqli_query($link, $query) or die("Query error: " . mysqli_error($link)."\n");
    if(mysqli_num_rows($result) == 0){
        header("Location: wrongInfo.php");
    }else{
        while($row = mysqli_fetch_assoc($result)){
            $uId = $row["userId"];
        }
    }


    if($uId != -1){
        $query = "UPDATE playlist SET listName = '$name' WHERE playlistId = '$playlistId'";
        $result = mysqli_query($link, $query) or die("Query error: " . mysqli_error($link)."\n");
        echo "Information changed Successfully!";
    }else{
        echo "Error Changing Playlist Name";
    }

    mysqli_close($link);

?>
<FORM action="userpage.php" method="GET">
    <P>
        <INPUT type="submit" value="Go to my page">
    </P>
</FORM>
</html>

