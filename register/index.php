<!DOCTYPE html>
<html>

<head>
    <title>Registration</title>
    <link rel="stylesheet" href="../style.css" media="all">
</head>

<body>
    <div class="topbar"></div>
        <div class="form">
            <form method="post" action="register.php" name="">
                <div id="div_login">
                    <h1>Register for an Account</h1>

                    <div class="form-group">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" name="email" id="email" required="required"
                                maxlength="80">
                        </div>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" name="name" id="name" required="required"
                                maxlength="80">
                        </div>
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" name="username" id="username" required="required"
                                maxlength="80">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password" id="password"
                                required="required" maxlength="80">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Confirm Password:</label>
                            <input type="password" class="form-control" name="confirmpassword" id="confirmpassword"
                                onkeyup='' required="required" maxlength="80">
                        </div>

                        <input type="submit" name="btnsignup" value="Register"></input>
            </form>
        </div>
    </div>
    </div>
    </div>


</body>

</html>
