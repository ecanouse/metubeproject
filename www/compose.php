<html>
<head>
<title>Compose a New Message</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<FORM action="sendMessage.php" method="get">
    <P>
        <div>
        <LABEL for="cemail" class='form-label'>To: </LABEL><BR>
                <INPUT type="text" id="cemail" name="cemail"><BR>
        </div>
        <div>
        <LABEL for="sub" class='form-label'>Subject: </LABEL><BR>
                <INPUT type="text" id="sub" name="sub"><BR>
        </div>
        <div>
        <label for="messageText" class="form-label">Message</label>
            <textarea class="form-control w-25" id="messageText" name="messageText" rows="3"></textarea>
        </div>
        <INPUT type="submit" value="Send Message"> <INPUT type="reset">
        <INPUT type="submit" value="Go to My Page" formaction="userpage.php">

    </P>
</FORM>


</html>