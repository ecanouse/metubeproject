<html>
<head>
<title>Metube</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
</style>
<?php echo "Browse here! <br><br>"; 
    session_start();
    $email = $_SESSION["email"];

    //connecting, selecting database
    $link = mysqli_connect('mysql1.cs.clemson.edu', 'metube_bbec_eqrn', 'metubepass89', 'metube_bbec') 
    or die('Could not connect: ' . mysqli_error($link));


    echo "<FORM action='search.php' method='get'>
        <P>
            <INPUT type='submit' value='Search by Keyword'>
        </P>
        </FORM>";





        $query = "SELECT * from user WHERE email = '$email'";
        $result = mysqli_query($link, $query) or die("Query error: " . mysqli_error($link)."\n");
        if(mysqli_num_rows($result) == 0){
            echo "Account error";
            header("Location: wrongInfo.php");
            //want to send them back to home page
        }
        else{
            while($row = mysqli_fetch_assoc($result)){
                // echo "Welcome back to Metube " . $row["firstName"] . " " . $row["lastName"]. "<br><br>";
                $uId = $row["userId"];
            }
        }


        //show by most views
        $query = "SELECT userId, filelocation.fileId, displayName, fileUrl, fileDesc, category FROM filelocation 
        INNER JOIN filedata ON filelocation.fileId = filedata.fileId ORDER BY numViews DESC LIMIT 5";
        $result = mysqli_query($link, $query) or die("Query error: ".mysqli_error($link)."\n");

        echo"<table class='table w-50'>\n
        <tr class='table-secondary'>
            <th>Most Viewed Uploads</th></tr>
        <tr class='table-dark'>
            <th>filename</th>
            <th>preview</th>
            <th>description</th>
            <th>category</th>
            <th>View File</th></tr>";

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
            echo "<a href=viewFile.php?fileId=$fileId class='btn btn-secondary'>View File</a>";
            echo "</td>";
            echo "\t</tr>\n";
        }
        echo"</table>\n";



        //show by recent upload
        $query = "SELECT * FROM filelocation ORDER BY fileid DESC LIMIT 5";
        $result = mysqli_query($link, $query) or die("Query error: ".mysqli_error($link)."\n");

        echo"<table class='table w-50'>\n
        <tr class='table-secondary'>
            <th>Recent Uploads</th></tr>
        <tr class='table-dark'>
            <th>filename</th>
            <th>preview</th>
            <th>description</th>
            <th>category</th>
            <th>View File</th></tr>";

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
            echo "<a href=viewFile.php?fileId=$fileId class='btn btn-secondary'>View File</a>";
            echo "</td>";
            echo "\t</tr>\n";
        }
        echo"</table>\n";





?>

<FORM action='browseCategory.php' method='get'>
    <P>
    <LABEL for="category">Browse by Category: </LABEL>
        <select class="form-select w-25" name="category" id="category">
            <option value="humor">Humor</option>
            <option value="educational">Educational</option>
            <option value="entertainment">Entertainment</option>
            <option value="news">News</option>
            <option value="sports">Sports</option>
        </select>   
    <INPUT type="submit" value="Browse">
    </P>
</FORM>


<FORM action="userpage.php" method="get">
    <P>
        <INPUT type="submit" value="Go to My Page">
    </P>
</FORM>

</html>