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



        $query = "SELECT displayName, fileUrl, fileDesc, category, fileId FROM filelocation WHERE fileId = '$fileId'";            
        $result = mysqli_query($link, $query) or die("1Query error: " . mysqli_error($link)."\n");

        echo"<table class='table w-50'>\n
        <tr class='table-dark'>
            <th>File Name</th>
            <th>File URL</th>
            <th>Description</th>
            <th>Category</th>
            <th>Add a Keyword</th></tr>";


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
            echo "<a href=addKeyword.php?fileId=$fileId class='btn btn-secondary'>Add a Keyword</a>";
            echo "</td>";
            echo "\t</tr>\n";
        }
        echo"</table>\n";

        echo"<table class='table w-50'>\n
        <tr class='table-dark'>
            <th>Keyword</th>
            <th>Remove Keyword</th></tr>";

        $query = "SELECT keyword from keywordList WHERE fileId='$fileId'";
        $result = mysqli_query($link, $query) or die("1Query error: " . mysqli_error($link)."\n");

        $keyword = "";
        while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            echo "\t<tr>\n";
            foreach($line as $col_value){
                $keyword = $col_value;
                echo"\t\t<td>$col_value</td>\n";
            }
            echo"<td>";
            echo "<a href=removeKeyword.php?keyword=$keyword&fileId=$fileId class='btn btn-secondary'>Remove</a>";
            echo "</td>";
            echo "\t</tr>\n";
        }
        echo "</table>";

    ?>

    <FORM action="userpage.php" method="get">
        <P>
            <INPUT type="submit" value="Go to My Page">
        </P>
    </FORM>

</html>