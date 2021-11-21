<html>
<head>
<title>Add to Playlist</title>
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
        $uId = -1;
        $fileId = $_GET['id'];
        $playlistId = 0;

        //connecting, selecting database
        $link = mysqli_connect('mysql1.cs.clemson.edu', 'metube_bbec_eqrn', 'metubepass89', 'metube_bbec') 
        or die('Could not connect: ' . mysqli_error($link));

        //Get UserId
        $query = "SELECT * from user WHERE email = '$email'";
        $result = mysqli_query($link, $query) or die("Query error: " . mysqli_error($link)."\n");
        if(mysqli_num_rows($result) == 0){
            echo "Account error";
            header("Location: wrongInfo.php");
            //want to send them back to home page
        }else{
            while($row = mysqli_fetch_assoc($result)){
                $uId = $row["userId"];
            } 
        }

        $query = "SELECT * from filelocation WHERE fileId = '$fileId'";
        $result = mysqli_query($link, $query) or die("Query error: " . mysqli_error($link)."\n");
        if(mysqli_num_rows($result) == 0){
            echo "This file doesn't exist.";
        }    

        //give information about the file you are on
        echo "<h2>File information</h2><br>";
        echo"<table class='table w-50'>\n
        <tr class='table-dark'>
            <th>userid</th>
            <th>fileid</th>
            <th>filename</th>
            <th>filelink</th>
            <th>description</th>
            <th>category</th>";


        while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            echo "\t<tr>\n";
            foreach($line as $col_value){
                echo"\t\t<td>$col_value</td>\n";
            }

            echo "\t</tr>\n";
        }
        echo"</table>\n";

        echo "My Playlists<br>";
        //List all playlists that the user has

        $query = "SELECT * from playlist WHERE userId = '$uId'";
        $result = mysqli_query($link, $query) or die("Query error: " . mysqli_error($link)."\n");
        if(mysqli_num_rows($result) == 0){
            echo "You do not have any playlists.";
        }  

        //give information about the file you are on
        echo "<h2>Choose Playlist</h2><br>";
        echo"<table class='table w-50'>\n
        <tr class='table-dark'>
            <th>userid</th>
            <th>playlistid</th>
            <th>Playlist Name</th>
            <th>Playlist Description</th>
            <th>Add to this Playlist</th>";


        while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $playlistId = $line["playlistId"];
            echo "\t<tr>\n";
            foreach($line as $col_value){
                echo"\t\t<td>$col_value</td>\n";
            }
            echo"<td>";
            echo "<a href=checkFileToList.php?id=$playlistId&fileId=$fileId class='btn btn-secondary'>Add to Playlist</a>";
            echo "</td>";
            echo "\t</tr>\n";
        }
        echo"</table>\n";

    ?>

    <FORM action="userpage.php" method="get">
        <P>
            <INPUT type="submit" value="Go to My Page">
        </P>
    </FORM>


</html>