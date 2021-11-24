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
        $playlistId = $_GET['id'];
        $_SESSION["playlistId"] = $playlistId;

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

        $query = "SELECT * from playlist WHERE playlistId='$playlistId'";
        $result = mysqli_query($link, $query) or die("3Query error: " . mysqli_error($link)."\n");

        $row = mysqli_fetch_assoc($result);
        $oldName = $row["listName"];
        echo"<h2>Current Name: ".$oldName."</h2>";

        echo "<FORM action='checkListRename.php' method='get'>
                <P>
                <div class='mb-3'>
                    <label for='title' class='form-label'>New Playlist Title: </label>
                    <input type='title' class='form-control w-25' id='title' name='title'>
                </div>
                <INPUT type='submit' value='Update Information'>
                </P>
            </FORM>";

            mysqli_close($link);


    ?>

    <FORM action="userpage.php" method="get">
        <P>
        <INPUT type='submit' value='Go to My Page'>
        </P>
    </FORM>

</html>