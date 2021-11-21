<html>
<head>
<title>File Added Successfully</title>
</head>
<?php echo "My Playlist\n"; 
    session_start();
    echo $_SESSION["currentPlaylist"];
    $playlistId = $_SESSION["currentPlaylist"];
?>
<!-- <FORM action="renameList.php?" method="get">
    <P>
        <LABEL for="pname">Change Playlist Name: </LABEL>
            <INPUT type="text" id="pname" name="pname"><BR>
        <INPUT type="submit" value="Rename Playlist">
    </P>
</FORM> -->
<FORM action="userpage.php" method="get">
    <P>
        <INPUT type="submit" value="Go to My Page">
    </P>
</FORM>

</html>