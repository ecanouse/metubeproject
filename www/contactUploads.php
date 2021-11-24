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
            <th>File Name</th>
            <th>File</th>
            <th>Description</th>
            <th>Category</th>
            <th>View File</th>
            <th>Add to Playlist</th></tr>";


        $fileId = 0;
        while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $fname = $line["displayName"];
            $furl = $line["fileUrl"];
            $desc = $line["fileDesc"];
            $cat = $line["category"];
            $fileId = $line["fileId"];
            echo "\t<tr>\n";

            echo"\t\t<td>$fname</td>\n";
            echo"\t\t<td><iframe style='height:100px;width:100px;' src='$furl'/></iframe></td>\n";
            echo"\t\t<td>$desc</td>\n";
            echo"\t\t<td>$cat</td>\n";

            echo"<td>";
            echo "<a href=viewFile.php?fileId=$fileId class='btn btn-secondary'>View File</a>";
            echo "</td>";
            echo"<td>";
            echo "<a href=addFileToList.php?id=$fileId class='btn btn-secondary'>Add a Keyword</a>";
            echo "</td>";
            echo "\t</tr>\n";
        }
        echo"</table>\n";



        mysqli_close($link);


    ?>


<FORM action="userpage.php" method="get">
    <P>
        <INPUT type="submit" value="Go to My Page">
    </P>
</FORM>

</html>