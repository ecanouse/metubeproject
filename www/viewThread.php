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


        
        //get subject
        $query = "SELECT * from messageThreads WHERE thread ='$threadId'";
        $result = mysqli_query($link, $query) or die("1Query error: " . mysqli_error($link)."\n");
        $sub ="";
        while($row = mysqli_fetch_assoc($result)){
            $sub=$row["sub"];
        }
        echo"<h3>Subject: '$sub'</h3>";

        //get other user's email
        $cId = 0;
        $cemail = "";
        $query = "SELECT fromId, toId from messages WHERE thread = '$threadId' LIMIT 1";
        $result = mysqli_query($link, $query) or die("2Query error: " . mysqli_error($link)."\n");
        $row = mysqli_fetch_assoc($result);
        if($row["fromId"]=='$uId'){
            $cId=$row["toId"];
        }else{
            $cId=$row["fromId"];
        }
        $query = "SELECT * from user WHERE userId = '$cId'";
        $result = mysqli_query($link, $query) or die("3Query error: " . mysqli_error($link)."\n");
        if(mysqli_num_rows($result) == 0){
            echo "Account error";
            header("Location: messageUserError.php");
            //want to send them back to home page
        }else{
            while($row = mysqli_fetch_assoc($result)){
                $cemail = $row["email"];
            } 
        }


        $query = "SELECT fromId, messageText from messages 
        INNER JOIN messageThreads ON messages.thread = messageThreads.thread
        WHERE messages.thread = '$threadId'
        ORDER BY timeSent ";
        $result = mysqli_query($link, $query) or die("2Query error: " . mysqli_error($link)."\n");
        if(mysqli_num_rows($result) == 0){
            echo "No messages in this thread.";
        }



        echo"<table class='table w-50'>\n
        <tr class='table-dark'>
            <th>From</th>
            <th>Message</th></tr>";


        $thread = 0;
        while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            echo "\t<tr>\n";
            foreach($line as $col_value){
                if($col_value==$line["fromId"]){
                    if($col_value==$uId){
                        echo"\t\t<td>You</td>\n";
                    }else{
                        echo"\t\t<td>$cemail</td>\n";
                    }
                }else{
                    echo"\t\t<td>$col_value</td>\n";
                }
            }

            echo "\t</tr>\n";
        }
        echo"<tr><td>";
        echo "<a href=replyToThread.php?thread=$threadId class='btn btn-secondary'>Reply</a>";
        echo "</td></tr>";
        echo"</table>\n";





    ?>

    <FORM action="userpage.php" method="get">
        <P>
            <INPUT type="submit" value="Go to My Page">
        </P>
    </FORM>

</html>