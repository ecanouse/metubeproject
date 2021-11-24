<html>
<head>
<title>Send a Message</title>
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
        $cemail = $_REQUEST["cemail"];
        $sub = $_REQUEST["sub"];
        $messageText = $_REQUEST["messageText"];

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

        //Get Contact's Id
        $cId = -1;
        $query = "SELECT * from user WHERE email = '$cemail'";
        $result = mysqli_query($link, $query) or die("Query error: " . mysqli_error($link)."\n");
        if(mysqli_num_rows($result) == 0){
            echo "The User that you want to send a message to does not exist.";
            header("Location: messageUserError.php");
            //want to send them back to home page
        }else{
            while($row = mysqli_fetch_assoc($result)){
                $cId = $row["userId"];
            } 
            $query = "INSERT INTO messageThreads (sub) VALUES ('$sub')";
            $result = mysqli_query($link, $query) or die("Query error: " . mysqli_error($link)."\n");
    
            $query = "SELECT * from messageThreads WHERE sub = '$sub' ORDER BY thread DESC LIMIT 1";
            $result = mysqli_query($link, $query) or die("Query error: " . mysqli_error($link)."\n");
            $row = mysqli_fetch_assoc($result);
            $threadId = $row["thread"];
    
            $query = "INSERT INTO messages (thread, fromId, toId, messageText, firstInThread)
            VALUES ('$threadId', '$uId', '$cId', '$messageText', 1)";
            $result = mysqli_query($link, $query) or die("Query error: " . mysqli_error($link)."\n");
    
            
            header("Location: inbox.php");
        }

        mysqli_close($link);


    ?>
</html>