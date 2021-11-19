<!DOCTYPE html>
<html>
<head>
<title>Register for Metube</title>
</head>
<FORM action="infoChanged.php" method="get">
    <P>
        <LABEL for="firstname">Change First name: </LABEL>
                <INPUT type="text" id="firstname" name="firstname"><BR>
        <LABEL for="lastname">Change Last name: </LABEL>
                <INPUT type="text" id="lastname" name="lastname"><BR>
        <LABEL for="curpass">Current Password: </LABEL>
                <INPUT type="password" id="curpass" name="curpass"><BR>
        <LABEL for="pass">New Password: </LABEL>
                <INPUT type="password" id="pass" name="pass"><BR>
        <INPUT type="submit" value="Update Info"> <INPUT type="reset">
    </P>
</FORM>
<FORM action="userpage.php" method="get">
    <P>
        <INPUT type="submit" value="Go back to my page">
    </P>
</FORM>

</html>