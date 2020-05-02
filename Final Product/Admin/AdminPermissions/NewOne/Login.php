<?php
require 'connection.php';

/*
 * ================================
 * Operations upon form submission.
 * ================================
 */
if (isset($_POST['submit'])) {
    /*
     * =======================
     * Read the posted values.
     * =======================
     */
    $StaffID = $_POST['StaffID'] ?? '';
    $Password = $_POST['Password'] ?? '';

    /*
     * ===========================
     * Validate the posted values.
     * ===========================
     */
    // Validate the username.
    if (empty($StaffID)) {
        $errors[] = 'Please provide a StaffID.';
    } /* Other validations here using elseif statements */

    // Validate the password.
    if (empty($Password)) {
        $errors[] = 'Please provide a password.';
    } /* Other validations here using elseif statements */

    /*
     * ======================
     * Check the credentials.
     * ======================
     */
    if (!isset($errors)) { // No errors yet.
        $sql = 'SELECT StaffID, Password
                FROM staff
                WHERE StaffID = :StaffID
                LIMIT 1';

        $statement = $connection->prepare($sql);

        $statement->execute([
            ':StaffID' => $StaffID,
        ]);

        /*
         * Fetch the credentials into an associative array.
         * If no record is found, the operation returns FALSE.
         */
        $credentials = $statement->fetch(PDO::FETCH_ASSOC);

        if ($credentials) { // Record found.
            $fetchedStaffID = $credentials['StaffID'];
            $fetchedPasswordHash = $credentials['Password'];

            /*
             * Compare the posted username with the one saved in db and the posted
             * password with the password hash saved in db using password_hash.
             *
             * @link https://secure.php.net/manual/en/function.password-verify.php
             * @link https://secure.php.net/manual/en/function.password-hash.php
             */
            if (
                    $StaffID === $fetchedStaffID &&
                    password_verify($Password, $fetchedPasswordHash)
            ) {
                header('Location: welcome.html');
                exit();
            } else {
                $errors[] = 'Invalid credentials. Please try again.';
            }
        } else {
            $errors[] = 'No credentials found for the given user.';
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />
        <meta charset="UTF-8" />
        <!-- The above 3 meta tags must come first in the head -->

        <title>Demo - Login</title>

        <script type="text/javascript">
            function validateForm() {
                // ...Some form validation, if needed...
                return true;
            }
        </script>

        <style type="text/css">
            .messages { margin-bottom: 10px; }
            .error { margin-bottom: 5px; color: #ff0000; }
            .form-group { margin-bottom: 10px; }
            .form-group label { display: inline-block; min-width: 90px; }
        </style>
    </head>
    <body>

        <h3>
            Login
        </h3>

        <div class="messages">
            <?php
            if (isset($errors)) {
                foreach ($errors as $error) {
                    ?>
                    <div class="error">
                        <?php echo $error; ?>
                    </div>
                    <?php
                }
            }
            ?>
        </div>

        <form action="" method="post" onsubmit="return validateForm();">

            <div class="form-group">
                <label for="StaffID">StaffID</label>
                <input type="text" id="StaffID" name="StaffID" value="<?php echo $StaffID ?? ''; ?>" placeholder="Username">
            </div>

            <div class="form-group">
                <label for="Password">Password</label>
                <input type="Password" id="Password" name="Password" value="<?php echo $Password ?? ''; ?>" placeholder="Password">
            </div>

            <button type="submit" id="loginButton" name="submit" value="login">
                Login
            </button>
        </form>

    </body>
</html>