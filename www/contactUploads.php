<html>
<head>
<title>View Another User's Page</title>
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
        $contactId = $_GET['id'];
        $cemail = "ERROR";
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

        $query = "SELECT * from user WHERE userId='$contactId'";
        $result = mysqli_query($link, $query) or die("Query error: " . mysqli_error($link)."\n");
        if(mysqli_num_rows($result) == 0){
            echo "Account error";
            header("Location: userError.php");
        }else{
            while($row = mysqli_fetch_assoc($result)){
                $cemail = $row["email"];
            }        
        }

        echo "Welcome to ".$cemail."'s account!";

        $query = "SELECT * from filelocation WHERE userId = '$contactId'";
        $result = mysqli_query($link, $query) or die("Query error: " . mysqli_error($link)."\n");
        if(mysqli_num_rows($result) == 0){
            echo "This account has no uploads";
        }    


        echo"<table class='table w-50'>\n
        <tr class='table-dark'>
            <th>userid</th>
            <th>fileid</th>
            <th>filename</th>
            <th>filelink</th>
            <th>description</th>
            <th>category</th>
            <th>Add to a Playlist</th>";


        $fileId = 0;
        while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $fileId=$line["fileId"];
            echo "\t<tr>\n";
            foreach($line as $col_value){
                echo"\t\t<td>$col_value</td>\n";
            }
            echo"<td>";
            echo "<a href=addFileToList.php?id=$fileId class='btn btn-secondary'>Add to Playlist</a>";
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