<!DOCTYPE html>
<html>
<head>
<title>Checking File Info</title>
</head>
    <?php
        session_start();
        $email = $_SESSION["email"];
        $dname = $_REQUEST["dname"];
        $desc = $_REQUEST["desc"];
        $category = $_REQUEST["category"];
        $uId = -1;

        //connecting, selecting database
        $link = mysqli_connect('mysql1.cs.clemson.edu', 'metube_bbec_eqrn', 'metubepass89', 'metube_bbec') 
        or die('Could not connect: ' . mysqli_error($link));

        //get user id
        $query = "SELECT * from user WHERE email = '$email' ";
        $result = mysqli_query($link, $query) or die("1Query error: " . mysqli_error($link)."\n");
        if(mysqli_num_rows($result) == 0){
            header("Location: wrongInfo.php");
        }else{
            while($row = mysqli_fetch_assoc($result)){
                $uId = $row["userId"];

            }
        }


        if($uId != -1){
            $query = "INSERT INTO filedata (numViews, numRatings) VALUES (0, 0)";
            $result = mysqli_query($link, $query) or die("4Query error: " . mysqli_error($link)."\n");
            $query = "SELECT * from filedata ORDER BY timeUploaded DESC LIMIT 1";
            $result = mysqli_query($link, $query) or die("3Query error: " . mysqli_error($link)."\n");
            $fileId = -1;
            while($row = mysqli_fetch_assoc($result)){
                $fileId = $row["fileId"];
            }

            $fileName = $_FILES['uploadFile']['name'];
            $fileName =  'id'.$fileId.'id'.$fileName;
            $temporal = $_FILES['uploadFile']['tmp_name']; 
            $folder = './uploads'; 

            $path = $folder . '/'. $fileName;
            move_uploaded_file($temporal, $folder . '/' . $fileName);


            $query = "INSERT INTO filelocation (fileId, userId, displayName, fileUrl, fileDesc, category) 
                VALUES ('$fileId','$uId', '$dname', '$path', '$desc', '$category')";
            $result = mysqli_query($link, $query) or die("2Query error: " . mysqli_error($link)."\n");


            header("Location: uploadSuccessful.php");
        }else{
            echo "Error Uploading File";
        }

    ?>
<FORM action="userpage.php" method="GET">
    <P>
        <INPUT type="submit" value="Go to my page">
    </P>
</FORM>

</html>




