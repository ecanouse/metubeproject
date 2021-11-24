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
        $keyword = $_GET["keyword"];

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


        $query = "SELECT displayName, fileUrl, fileDesc, category, filelocation.fileId 
        FROM filelocation 
        INNER JOIN keywordList ON filelocation.fileId = keywordList.fileId 
        WHERE keyword = '$keyword'";            
        $result = mysqli_query($link, $query) or die("1Query error: " . mysqli_error($link)."\n");



        echo"<table class='table w-50'>\n
        <tr class='table-dark'>
            <th>File Name</th>
            <th>File URL</th>
            <th>Description</th>
            <th>Category</th>
            <th>View File</th></tr>";


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


        }
        echo"</table>\n";




        // echo"<table class='table w-50'>\n
        // <tr class='table-dark'>
        //     <th>File Name</th>
        //     <th>File URL</th>
        //     <th>Description</th>
        //     <th>Category</th></tr>";


        // $fileId = 0;
        // while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        //     echo "\t<tr>\n";
        //     foreach($line as $col_value){
        //         if($col_value == $line["fileId"]){
        //             $fileId=$col_value;
        //         }else{
        //             echo"\t\t<td>$col_value</td>\n";
        //         }
        //     }

        //     echo "\t</tr>\n";
        // }
        // echo"</table>\n";


    ?>


<FORM action='searchKey.php' method='GET'>
    <P>
    <div class='mb-3'>
        <label for='keyword' class='form-label'>Keyword:</label>
            <input type='text' class='form-control w-25' id='keyword' name='keyword'>
        <input type='submit' class='btn btn-primary' value='Search'>
    </div>
    </P>
</FORM>

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