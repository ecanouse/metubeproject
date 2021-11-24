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
<?php  
    session_start();
    $email = $_SESSION["email"];
    $fileId= $_GET["fileId"];
    $_SESSION["file"] = $fileId;

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
                // echo "Welcome back to Metube " . $row["firstName"] . " " . $row["lastName"]. "<br><br>";
                $uId = $row["userId"];
            }
        }

        $query = "UPDATE filedata SET numViews = numViews + 1 WHERE fileId='$fileId' LIMIT 1";
        $result = mysqli_query($link, $query) or die("1Query error: ".mysqli_error($link)."\n");



        $query = "SELECT displayName, fileUrl, fileDesc, category, fileId FROM filelocation WHERE fileId = '$fileId'";            
        $result = mysqli_query($link, $query) or die("1Query error: " . mysqli_error($link)."\n");

        echo"<table class='table w-50'>\n
        <tr class='table-dark'>
            <th>File Name</th>
            <th>File URL</th>
            <th>Description</th>
            <th>Category</th>
            <th>Add to a Playlist</th>
            <th>Download</th></tr>";


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
            echo "<a href=addFileToList.php?id=$fileId class='btn btn-secondary'>Add to Playlist</a>";
            echo "</td>";
            echo"<td>";
            echo "<a href=$furl download=$furl class='btn btn-secondary'>Download</a>";
            echo "</td>";
            echo "\t</tr>\n";
        }
        echo"</table>\n";


      


        //List comments
        echo"<br><h3>Comments: </h3>";






        $query = "SELECT fromId, commentText, firstInThread, comment.thread from comment 
        INNER JOIN commentThreads ON comment.thread = commentThreads.commentThread
        WHERE fileId = $fileId
        ORDER BY timeSent DESC";
        $result = mysqli_query($link, $query) or die("2Query error: " . mysqli_error($link)."\n");
        if(mysqli_num_rows($result) == 0){
            echo "This file does not have any comments.";
        }  


        echo"<table class='table w-50'>\n
        <tr class='table-dark'>
            <th>User</th>
            <th>Comment</th>
            <th>View Thread</th>
            <th>Reply</th></tr>";

            $thread = 0;
            while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                if($line["firstInThread"] == 1){
                    $thread = $line["thread"];
                    $fromId = $line["fromId"];
                    $query = "SELECT * from user WHERE userId=$uId LIMIT 1";
                    $res = mysqli_query($link, $query) or die("2Query error: " . mysqli_error($link)."\n");
                    $row = mysqli_fetch_array($res);
                    $femail = $row["email"];
                    $comment = $line["commentText"];
                    echo "\t<tr>\n";
                    echo "\t\t<td>$femail</td>\n";
                    echo "\t\t<td>$comment</td>\n";
        
                    echo"<td>";
                    echo "<a href=viewCommentThread.php?thread=$thread class='btn btn-secondary'>View</a>";
                    echo "</td>";
                    echo"<td>";
                    echo "<a href=replyToComment.php?thread=$thread class='btn btn-secondary'>Reply</a>";
                    echo "</td>";
                    echo "\t</tr>\n";
                }

            }
            echo"</table>\n";








?>

<FORM action="comment.php" method="get">
    <P>
        <div>
        <label for="commentText" class="form-label">New Comment</label>
            <textarea class="form-control w-25" id="commentText" name="commentText" rows="3"></textarea>
        </div>
        <INPUT type="submit" value="Comment">
    </P>
</FORM>


<FORM action="userpage.php" method="get">
    <P>
        <INPUT type="submit" value="Go to My Page">
        <INPUT type="submit" value="Go to Metube Home" formaction="home.php">
    </P>
</FORM>

</html>