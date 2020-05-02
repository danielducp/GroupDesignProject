<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Register / Login</title>
    <style type="text/css">
        .form {
            width: 30%;
        }
        input[type="text"], input[type="password"] {
            width: 99%;
            height: 1.5em;
            padding-bottom: 5px;
            margin-bottom: 3px;
        }
    </style>
</head>
<body>
    <div class="form">
        <fieldset>
            <legend> REGISTER </legend>
            <form name="register" action="register.php" method="post">
                <input name="fname" type="text" placeholder="please enter your first name"><br>
                <input name="lname" type="text" placeholder="please enter your last name"><br>
                <input name="uname" type="text" placeholder="please enter a user name"><br>
                <input name="upassword" type="password" placeholder="please enter a password or passphrase"><br>
                <input name="submit" type="submit">
            </form>
        </fieldset>
    </div>
    <div class="form">
        <fieldset>
            <legend> LOGIN </legend>
            <form name="login" action="login3.php" method="post">
                <input name="uname" type="text" placeholder="please enter your user name"><br>
                <input name="upassword" type="password" placeholder="please enter your password or passphrase"><br>
                <input name="submit" type="submit">
            </form>
        </fieldset>
    </div>
</body>
</html>