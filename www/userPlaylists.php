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

        $query = "SELECT playlistId, listName, playlistDesc from playlist WHERE userId = '$uId'";
        $result = mysqli_query($link, $query) or die("Query error: " . mysqli_error($link)."\n");
        if(mysqli_num_rows($result) == 0){
            echo "You have no playlists.<br>";
        }  




        //want playlist to give information about files on it.
        echo "<h4>Playlists</h4>";
        echo"<table class='table w-50'>\n
        <tr class='table-dark'>
            <th>Playlist Name</th>
            <th>Playlist Description</th>
            <th>View Playlist</th>
            <th>Rename Playlist</th>
            <th>Remove Playlist</th></tr>";
        while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            echo "\t<tr>\n";
            foreach($line as $col_value){
                if($col_value == $line["playlistId"]){
                    $playlistId=$col_value;
                }else{
                    echo"\t\t<td>$col_value</td>\n";
                }
            }
            echo"<td>";
            echo "<a href=viewList.php?id=$playlistId class='btn btn-secondary'>View Playlist</a>";
            echo"</td>";
            echo"<td>";
            echo "<a href=renameList.php?id=$playlistId class='btn btn-secondary'>Rename Playlist</a>";
            echo"</td>";
            echo"<td>";
            echo "<a href=removeList.php?id=$playlistId class='btn btn-secondary'>Remove Playlist</a>";
            echo"</td>";
            echo"\t</tr>\n";
        }
        echo "</table>";
        mysqli_close($link);

?>
<FORM action="addPlaylist.php" method="get">
    <P>
        <INPUT type="submit" value="Add a Playlist">
    </P>
</FORM>
<FORM action="userpage.php" method="get">
    <P>
        <INPUT type="submit" value="Go to My Page">
    </P>
</FORM>

</html>