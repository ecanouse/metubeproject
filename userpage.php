<!DOCTYPE html>
<html>
<head>
<title>Metube User Home</title>
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

        echo"<table>\n
        <tr>
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

    ?>



    <FORM action="home.php" method="GET">
    <P>
        <INPUT type="submit" value="Go to Metube Home">
    </P>
    </FORM>

    <FORM action="updateProfile.php" method="GET">
    <P>
        <INPUT type="submit" value="Update My Profile">
        <INPUT type="submit" value="Upload a File" formaction="uploadFile.php">
    </P>
    </FORM>

    
    <FORM action="userPlaylists.php" method="GET">
    <P>
        <INPUT type="submit" value="View My Playlists">
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

        echo"<table>\n
        <tr>
            <th>Contact</th>
            <th>View their uploads!</th>";

        while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            echo "\t<tr>\n";
            foreach($line as $col_value){
                echo"\t\t<td>$col_value</td>\n";
            }
            echo"<td><button type='submit' formaction='contactUploads.php'>View</button></td>";
            echo "\t</tr>\n";
        }
        echo"</table>\n";

    ?>
    <?php echo "THIS IS WHERE CONTACT LIST WILL BE"; ?>
    <FORM action="addContact.php" method="GET">
    <P>
        <INPUT type="submit" value="Add Contact">
        <INPUT type="submit" value="Remove Contact" formaction="removeContact.php">
    </P>
    </FORM>


    <FORM action="endSession.php" method="GET">
        <P>
            <INPUT type="submit" value="Sign Out">
        </P>
    </FORM>

</html>
