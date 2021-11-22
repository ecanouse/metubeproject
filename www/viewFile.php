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
<?php  
    session_start();
    $email = $_SESSION["email"];
    $fileId= $_GET["fileId"];

    //connecting, selecting database
    $link = mysqli_connect('mysql1.cs.clemson.edu', 'metube_bbec_eqrn', 'metubepass89', 'metube_bbec') 
    or die('Could not connect: ' . mysqli_error($link));


        $query = "SELECT * from user WHERE email = '$email'";
        $result = mysqli_query($link, $query) or die("Query error: " . mysqli_error($link)."\n");
        if(mysqli_num_rows($result) == 0){
            echo "Account error";
            header("Location: wrongInfo.php");
            //want to send them back to home page
        }
        else{
            while($row = mysqli_fetch_assoc($result)){
                // echo "Welcome back to Metube " . $row["firstName"] . " " . $row["lastName"]. "<br><br>";
                $uId = $row["userId"];
            }
        }

        $query = "SELECT * FROM filelocation WHERE fileId='$fileId'";
        $result = mysqli_query($link, $query) or die("Query error: ".mysqli_error($link)."\n");

        echo"<table class='table w-50'>\n
        <tr class='table-dark'>
            <th>filename</th>
            <th>file</th>
            <th>description</th>
            <th>category</th>
            <th>download</th></tr>";

        $fileId = 0;
        $filesrc = "";
        while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            echo "\t<tr>\n";
            foreach($line as $col_value){
                if($line["fileId"] == $col_value){
                    $fileId=$col_value;
                }elseif($line["fileUrl"] == $col_value){
                    echo"\t\t<td><iframe style='height:500px;' src='$col_value'/></iframe></td>\n";
                    $filesrc = $col_value;
                }elseif($line["userId"] != $col_value){
                    echo"\t\t<td>$col_value</td>\n";
                }
            }
            echo"<td>";
            echo "<a href=$filesrc download=$filesrc class='btn btn-secondary'>Download</a>";
            echo "</td>";
            echo "\t</tr>\n";
        }
        echo"</table>\n";

?>



<FORM action="userpage.php" method="get">
    <P>
        <INPUT type="submit" value="Go to My Page">
        <INPUT type="submit" value="Go to Metube Home" formaction="home.php">
    </P>
</FORM>

</html>