<!DOCTYPE html>
<html>
<head>
<title>Metube User Home</title>
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


        $query = "SELECT * from user WHERE email = '$email'";
        $result = mysqli_query($link, $query) or die("Query error: " . mysqli_error($link)."\n");
        if(mysqli_num_rows($result) == 0){
            echo "Account error";
            header("Location: wrongInfo.php");
            //want to send them back to home page
        }
        else{
            while($row = mysqli_fetch_assoc($result)){
                echo "Welcome back to Metube " . $row["firstName"] . " " . $row["lastName"]. "<br><br>";
                $uId = $row["userId"];
            }
        }

        $query = "SELECT * FROM filelocation WHERE userId = '$uId' ORDER BY fileid DESC";
        $result = mysqli_query($link, $query) or die("Query error: ".mysqli_error($link)."\n");

        echo"<table class='table w-50'>\n
        <tr class='table-dark'>
            <th>filename</th>
            <th>filelink</th>
            <th>description</th>
            <th>category</th>
            <th>Keywords</th></tr>";

        $fileId = 0;
        while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            echo "\t<tr>\n";
            foreach($line as $col_value){
                if($line["fileId"] == $col_value){
                    $fileId=$col_value;
                }elseif($line["fileUrl"] == $col_value){
                    echo"\t\t<td><iframe style='height:100px;width:100px;' src='$col_value'/></iframe></td>\n";
                }elseif($line["userId"] != $col_value){
                    echo"\t\t<td>$col_value</td>\n";
                }
            }

            echo"<td>";
            echo "<a href=fileKeys.php?fileId=$fileId class='btn btn-secondary'>View Keywords</a>";
            echo "</td>";
            echo "\t</tr>\n";
        }
        echo"</table>\n";

    ?>



    <FORM action="home.php" method="GET">
    <P>
        <INPUT type="submit"  class="btn btn-info text-white" value="Go to Metube Home">
    </P>
    </FORM>

    <FORM action="updateProfile.php" method="GET">
    <P>
        <INPUT type="submit" value="Update My Profile" class="btn btn-info text-white">
        <INPUT type="submit" value="Upload a File" formaction="uploadFile.php" class="btn btn-info text-white">
    </P>
    </FORM>

    
    <FORM action="userPlaylists.php" method="GET">
    <P>
        <INPUT type="submit" value="View My Playlists" class="btn btn-info text-white">
        <INPUT type="submit" value="View my Inbox" formaction="inbox.php" class="btn btn-info text-white">
    </P>
    </FORM>

    <?php echo "Contact List! <br>"; 
        $email = $_SESSION["email"];
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

        $query = "SELECT contactId FROM contact WHERE userId='$uId'";
        $result = mysqli_query($link, $query) or die("Query error: ".mysqli_error($link)."\n");

        echo"<table class='table w-25'>\n
        <tr class='table-dark'>
            <th>Contact</th>
            <th>View their uploads!</th>
            <th>Remove Contact</th></tr>";

        while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            echo "\t<tr>\n";
            foreach($line as $col_value){
                echo"\t\t<td>$col_value</td>\n";
            }
            echo"<td>";
            echo "<a href=contactUploads.php?id=$col_value class='btn btn-secondary'>View</a>";
            echo "</td>";
            echo"<td>";
            echo "<a href=checkRemoveContact.php?id=$col_value class='btn btn-secondary'>Remove</a>";
            echo "</td>";
            echo "\t</tr>\n";
        }
        echo"</table>\n";

    ?>
    <FORM action="addContact.php" method="GET">
    <P>
        <INPUT type="submit" value="Add Contact" class="btn btn-info text-white">
    </P>
    </FORM>


    <FORM action="endSession.php" method="GET">
        <P>
            <INPUT type="submit" value="Sign Out" class="btn btn-info text-white">
        </P>
    </FORM>

</html>
