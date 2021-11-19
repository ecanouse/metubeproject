<html>
<head>
<title>Add a Contact</title>
</head>

<FORM action="checkFile.php" method="get">
    <P>
        <LABEL for="dname">Display Name: </LABEL>
            <INPUT type="text" id="dname" name="dname"><BR>
        <LABEL for="furl">File URL: </LABEL>
            <INPUT type="text" id="furl" name="furl"><BR>
        <LABEL for="desc">Description: </LABEL>
            <INPUT type="text" id="desc" name="desc"><BR>
        <LABEL for="category">Category: </LABEL>
            <select name="category" id="category">
                <option value="humor">Humor</option>
                <option value="educational">Educational</option>
                <option value="entertainment">Entertainment</option>
                <option value="news">News</option>
                <option value="sports">Sports</option>
            </select>    
        <INPUT type="submit" value="Add File"> <INPUT type="reset">
        <INPUT type="submit" value="Go to my Page" formaction="userpage.php">

    </P>
</FORM>


</html>