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
<?php echo "Browse here! <br><br>"; 
    session_start();
    $email = $_SESSION["email"];

    //connecting, selecting database
    $link = mysqli_connect('mysql1.cs.clemson.edu', 'metube_bbec_eqrn', 'metubepass89', 'metube_bbec') 
    or die('Could not connect: ' . mysqli_error($link));

    $query = 'SELECT * FROM filelocation ORDER BY fileid DESC';
    $result = mysqli_query($link, $query) or die("Query error: ".mysqli_error($link)."\n");

    echo "<FORM action='search.php' method='get'>
        <P>
            <INPUT type='submit' value='Search by Keyword'>
        </P>
        </FORM>";


    echo"<table class='table w-75'>\n
    <tr class='table-dark'>
        <th>userid</th>
        <th>fileid</th>
        <th>filename</th>
        <th>filelink</th>
        <th>description</th>
        <th>category</th>";

    while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        echo "\t<tr>\n";
        foreach($line as $col_value){
            echo"\t\t<td>$col_value</td>\n";
        }
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