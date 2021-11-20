<html>
<head>
<title>My Playlists</title>
</head>
<?php echo "My Playlists \n\n"; 
    session_start();
    $email = $_SESSION["email"];
    echo "This is where playlists will be listed";
?>
<FORM action="addPlaylist.php" method="get">
    <P>
        <INPUT type="submit" value="Add a Playlist">
    </P>
</FORM>
<FORM action="userpage.php" method="get">
    <P>
        <INPUT type="submit" value="Go to My Page">
    </P>
</FORM>

</html>