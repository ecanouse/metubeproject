<html>
<head>
<title>Add a Contact</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<FORM action="checkFile.php" method="post" enctype="multipart/form-data">
    <P>
        <LABEL for="dname">Display Name: </LABEL>
            <INPUT type="text" id="dname" name="dname"><BR>
            <div class="input-group mb-3 w-25">
                <input type="file" class="form-control" id="uploadFile" name="uploadFile">
            </div>
        <LABEL for="desc">Description: </LABEL>
            <INPUT type="text" id="desc" name="desc"><BR>
        <LABEL for="category">Category: </LABEL>
            <select class="form-select w-25" name="category" id="category">
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