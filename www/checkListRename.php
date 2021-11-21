<!DOCTYPE html>
<html>
<head>
<title>Checking Rename Playlist Info</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
</style>
    <?php
        session_start();
        $email = $_SESSION["email"];
        $newName = $_REQUEST["title"];
        $playlistId = $_SESSION["playlistId"];
        $uId = -1;

        //connecting, selecting database
        $link = mysqli_connect('mysql1.cs.clemson.edu', 'metube_bbec_eqrn', 'metubepass89', 'metube_bbec') 
        or die('Could not connect: ' . mysqli_error($link));


        $query = "UPDATE playlist SET listName = '$newName' WHERE playlistId = '$playlistId' ";
        $result = mysqli_query($link, $query) or die("2Query error: " . mysqli_error($link)."\n");

        header("Location: userPlaylists.php");

        ?>


</html>