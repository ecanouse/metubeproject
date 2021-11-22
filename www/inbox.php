<html>
<head>
<title>My Messages</title>
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


   

        echo"<h3>Inbox</h3>";

        echo"<FORM action='compose.php' method='get'>
        <P>
            <INPUT type='submit' value='Compose' class='btn btn-primary'>
        </P>
        </FORM>";
        

        $query = "SELECT sub, fromId, messageText, firstInThread, messages.thread from messages 
        INNER JOIN messageThreads ON messages.thread = messageThreads.thread
        WHERE messages.toId = $uId
        ORDER BY timeSent DESC";
        $result = mysqli_query($link, $query) or die("2Query error: " . mysqli_error($link)."\n");
        if(mysqli_num_rows($result) == 0){
            echo "You have not received any messages.";
        }  


        echo"<table class='table w-50'>\n
        <tr class='table-dark'>
            <th>Subject</th>
            <th>From</th>
            <th>Message</th>
            <th>View Thread</th></tr>";

        $thread = 0;
        while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $thread = $line["thread"];
            $sub = $line["sub"];
            $fromId = $line["fromId"];
            $msg = $line["messageText"];
            echo "\t<tr>\n";
            if($line["firstInThread"] == 0){
                echo "\t\t<td>Re: $sub</td>\n";
            }else{
                echo "\t\t<td>$sub</td>\n";
            }
            echo "\t\t<td>$fromId</td>\n";
            echo "\t\t<td>$msg</td>\n";

            echo"<td>";
            echo "<a href=viewThread.php?thread=$thread class='btn btn-secondary'>View</a>";
            echo "</td>";
            echo "\t</tr>\n";
        }
        echo"</table>\n";




        echo"<h3>Outbox</h3>";
        $query = "SELECT sub, toId, messageText, firstInThread, messages.thread from messages 
        INNER JOIN messageThreads ON messages.thread = messageThreads.thread
        WHERE messages.fromId = $uId
        ORDER BY timeSent DESC";
        $result = mysqli_query($link, $query) or die("2Query error: " . mysqli_error($link)."\n");
        if(mysqli_num_rows($result) == 0){
            echo "You have not sent any messages.";
        }  


        echo"<table class='table w-50'>\n
        <tr class='table-dark'>
            <th>Subject</th>
            <th>To</th>
            <th>Message</th>
            <th>View Thread</th></tr>";

            $thread = 0;
            while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $thread = $line["thread"];
                $sub = $line["sub"];
                $toId = $line["toId"];
                $msg = $line["messageText"];
                echo "\t<tr>\n";
                if($line["firstInThread"] == 0){
                    echo "\t\t<td>Re: $sub</td>\n";
                }else{
                    echo "\t\t<td>$sub</td>\n";
                }
                echo "\t\t<td>$toId</td>\n";
                echo "\t\t<td>$msg</td>\n";
    
                echo"<td>";
                echo "<a href=viewThread.php?thread=$thread class='btn btn-secondary'>View</a>";
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