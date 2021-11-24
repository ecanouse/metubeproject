<!DOCTYPE html>
<html>
<head>
<title>Checking File Info</title>
</head>
    <?php
        session_start();
        $email = $_SESSION["email"];
        $title = $_REQUEST["title"];
        $playlistDesc = $_REQUEST["playlistDesc"];
        $uId = -1;
        $playlistId = -1;

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
            $query = "INSERT INTO playlist (userId, listName, playlistDesc) VALUES ('$uId', '$title', '$playlistDesc')";
            $result = mysqli_query($link, $query) or die("Query error: " . mysqli_error($link)."\n");

            $query = "SELECT * from playlist WHERE listName = '$title' AND userId = '$uId'";
            $result = mysqli_query($link, $query) or die("Query error: " . mysqli_error($link)."\n");
            $fileId = -1;
            while($row = mysqli_fetch_assoc($result)){
                $playlistId = $row["playlistId"];
            }

            $_SESSION["currentPlaylist"] = $playlistId;
            header("Location: addPlaylistSuccessful.php");
        }else{
            echo "Error Adding Playlist";
        }
        mysqli_close($link);

    ?>
<FORM action="userpage.php" method="GET">
    <P>
        <INPUT type="submit" value="Go to my page">
    </P>
</FORM>

</html>
