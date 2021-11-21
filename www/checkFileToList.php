<html>
<head>
<title>Adding file to a playlist</title>
</head>
    <?php
        session_start();
        $email = $_SESSION["email"];
        $uId = -1;
        $fileId = $_GET['fileId'];
        $playlistId = $_GET['id'];

        //connecting, selecting database
        $link = mysqli_connect('mysql1.cs.clemson.edu', 'metube_bbec_eqrn', 'metubepass89', 'metube_bbec') 
        or die('Could not connect: ' . mysqli_error($link));

        //TODO: ADD FILE TO LIST
        $query = "INSERT INTO fileList VALUES ('$fileId', '$playlistId')";
        $result = mysqli_query($link, $query) or die("Query error: " . mysqli_error($link)."\n");

        header("Location: addedFileToListSuccessfully.php?id=$playlistId&fileId=$fileId");

    ?>

</html>