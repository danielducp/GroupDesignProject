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

                <input name="staffid" type="text" placeholder="please enter a user name"><br>
                <input name="stafftitle" type="text" placeholder="please enter a user name"><br>
                <input name="staffname" type="text" placeholder="please enter a user name"><br>

                <input name="staffrole" type="text" placeholder="please enter a user name"><br>
                <input name="storeid" type="number" placeholder="please enter a user name"><br>
                <input name="departmentid" type="number" placeholder="please enter a user name"><br>

                <input name="upassword" type="password" placeholder="please enter a password or passphrase"><br>
                <input name="submit" type="submit">
            </form>
        </fieldset>
    </div>
    <div class="form">
        <fieldset>
            <legend> LOGIN </legend>
            <form name="login" action="login.php" method="post">
                <input name="staffid" type="text" placeholder="please enter your user name"><br>
                <input name="departmentid" type="number" placeholder="please enter a user name"><br>

                <input name="upassword" type="password" placeholder="please enter your password or passphrase"><br>
                <input name="submit" type="submit">
            </form>
        </fieldset>
    </div>
</body>
</html> <script>
function goBack() {
  window.history.back();
}
</script>