<html>
<head>
<title>Login to Metube</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<FORM action="checkLogin.php" method="get">
    <P>
    <div class="mb-3">
        <label for="email" class="form-label">Email: </label>
        <input type="email" class="form-control w-25" id="email" name="email">
    </div>
    <div class="mb-3">
        <label for="pass" class="form-label">Password: </label>
        <input type="password" class="form-control w-25" id="pass" name="pass">
    </div>
        <INPUT type="submit" class="btn btn-primary" value="Sign In"> <INPUT type="reset" class="btn btn-primary">
    </P>
</FORM>
<FORM action="register.php" method="get">
    <P>
        <INPUT type="submit" value="I Don't Have an Account" class="btn btn-primary">
    </P>
</FORM>

</html>