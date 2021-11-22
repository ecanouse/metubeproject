<html>
<head>
<title>Compose a New Message</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<?php
    session_start();
    $_SESSION["thread"] = $_GET["thread"];
?>
<FORM action="sendReply.php" method="get">
    <P>
        <div>
        <label for="messageText" class="form-label">Message</label>
            <textarea class="form-control w-25" id="messageText" name="messageText" rows="3"></textarea>
        </div>
        <INPUT type="submit" value="Reply"> <INPUT type="reset">
        <INPUT type="submit" value="Go to My Page" formaction="userpage.php">

    </P>
</FORM>


</html>