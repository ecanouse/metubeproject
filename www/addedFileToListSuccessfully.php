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
        $fileId = $_GET['fileId'];
        $playlistId = $_GET['id'];

        //connecting, selecting database
        $link = mysqli_connect('mysql1.cs.clemson.edu', 'metube_bbec_eqrn', 'metubepass89', 'metube_bbec') 
        or die('Could not connect: ' . mysqli_error($link));

        //Get UserId
        $query = "SELECT * from user WHERE email = '$email'";
        $result = mysqli_query($link, $query) or die("3Query error: " . mysqli_error($link)."\n");
        if(mysqli_num_rows($result) == 0){
            echo "Account error";
            header("Location: wrongInfo.php");
            //want to send them back to home page
        }else{
            while($row = mysqli_fetch_assoc($result)){
                $uId = $row["userId"];
            } 
        }

        echo "<h3>File was added to Playlist</h3><br>";

        $query = "SELECT * from playlist WHERE playlistId = '$playlistId'";
        $result = mysqli_query($link, $query) or die("2Query error: " . mysqli_error($link)."\n");
        if(mysqli_num_rows($result) == 0){
            echo "This playlist does not exist.";
        }  

        $row = mysqli_fetch_assoc($result);
        $listName = $row["listName"];
        $listDesc = $row["playlistDesc"];


        //want playlist to give information about files on it.
        echo "<h4>Updated Playlist</h4>";
        echo"<table class='table w-50'>\n
        <tr class='table-dark'>
            <th>Playlist Name</th>
            <th>Playlist Description</th></tr>
        <tr class='table-secondary'>
            <th>$listName</th>
            <th>$listDesc</th></tr>
            </table>";

        $query = "SELECT displayName, fileUrl, fileDesc, category, filelocation.fileId FROM filelocation INNER JOIN fileList ON filelocation.fileId = fileList.fileId WHERE playlistId = '$playlistId'";            
        $result = mysqli_query($link, $query) or die("1Query error: " . mysqli_error($link)."\n");

        echo"<table class='table w-50'>\n
        <tr class='table-dark'>
            <th>File Name</th>
            <th>File URL</th>
            <th>Description</th>
            <th>Category</th>
            <th>Remove from List</tr>";


        $fileId = 0;
        while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            echo "\t<tr>\n";
            foreach($line as $col_value){
                if($col_value == $line["fileId"]){
                    $fileId=$col_value;
                }else{
                    echo"\t\t<td>$col_value</td>\n";
                }
            }
            echo"<td>";
            echo "<a href=removeFileFromList.php?id=$playlistId&fileId=$fileId class='btn btn-secondary'>Remove From Playlist</a>";
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