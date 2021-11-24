<!DOCTYPE html>
<html>
<head>
<title>Register for Metube</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<FORM action="welcome.php" method="get">
    <P>
    <div class="mb-3">
        <label for="firstname" class="form-label">First Name: </label>
        <input type="text" class="form-control w-25" id="firstname" name="firstname">
    </div>
    <div class="mb-3">
        <label for="lastname" class="form-label">Last Name: </label>
        <input type="text" class="form-control w-25" id="lastname" name="lastname">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email: </label>
        <input type="email" class="form-control w-25" id="email" name="email">
    </div>
    <div class="mb-3">
        <label for="pass" class="form-label">Password: </label>
        <input type="password" class="form-control w-25" id="pass" name="pass">
    </div>
    <div class="mb-3">
        <label for="passConf" class="form-label">Confirm Password: </label>
        <input type="password" class="form-control w-25" id="passConf" name="passConf">
    </div>

        <INPUT type="submit" value="Sign Up" class="btn btn-primary"> <INPUT type="reset" class="btn btn-primary">
    </P>
</FORM>
<FORM action="login.php" method="get">
    <P>
        <INPUT type="submit" value="I Already Have an Account" class="btn btn-primary">
    </P>
</FORM>

</html>