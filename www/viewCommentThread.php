<html>
<head>
<title>My Messages</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<style>
/* table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
} */
</style>
    <?php
        session_start();
        $email = $_SESSION["email"];
        $uId = -1;
        $threadId = $_GET["thread"];
        $fileId = $_SESSION["file"];

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


        
        $query = "SELECT * FROM filelocation WHERE fileId='$fileId'";
        $result = mysqli_query($link, $query) or die("2Query error: ".mysqli_error($link)."\n");
        

        echo"<table class='table w-50'>\n
        <tr class='table-dark'>
            <th>filename</th>
            <th>file</th>
            <th>description</th>
            <th>category</th>
            <th>download</th></tr>";


            // TODO fix this table too, description could be same as fileId or smth
        $filesrc = "";
        while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            echo "\t<tr>\n";
            foreach($line as $col_value){
                if($line["fileId"] == $col_value){
                    $fileId=$col_value;
                }elseif($line["fileUrl"] == $col_value){
                    echo"\t\t<td><iframe style='height:100px;' src='$col_value'/></iframe></td>\n";
                    $filesrc = $col_value;
                }elseif($line["userId"] != $col_value){
                    echo"\t\t<td>$col_value</td>\n";
                }
            }
            echo"<td>";
            echo "<a href=$filesrc download=$filesrc class='btn btn-secondary'>Download</a>";
            echo "</td>";
            echo "\t</tr>\n";
        }
        echo"</table>\n";





        $query = "SELECT fromId, commentText from comment WHERE thread = '$threadId' ORDER BY timeSent ";
        $result = mysqli_query($link, $query) or die("2Query error: " . mysqli_error($link)."\n");
        if(mysqli_num_rows($result) == 0){
            echo "No messages in this thread.";
        }



        echo"<table class='table w-50'>\n
        <tr class='table-dark'>
            <th>From</th>
            <th>Content</th></tr>";


        $thread = 0;
        while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            echo "\t<tr>\n";
            $fromId = $line["fromId"];
            $txt = $line["commentText"];
            echo "\t\t<td>$fromId</td>\n";
            echo "\t\t<td>$txt</td>\n";


            echo "\t</tr>\n";
        }
        echo"</table>\n";

        echo "<a href=viewFile.php?fileId=$fileId class='btn btn-secondary'>Go Back to File</a>";



    ?>


    <FORM action="userpage.php" method="get">
        <P>
            <INPUT type="submit" value="Go to My Page">
        </P>
    </FORM>

</html>