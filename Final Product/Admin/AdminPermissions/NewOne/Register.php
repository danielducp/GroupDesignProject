<?php
require 'connection.php';

// Signalize if a new account could be created, or not.
$accountCreated = FALSE;

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
    $StaffTitle = $_POST['StaffTitle'] ?? '';
    $StaffName = $_POST['StaffName'] ?? '';
    $StaffRole = $_POST['StaffRole'] ?? '';
    $StoreID = $_POST['StoreID'] ?? '';

    $DepartmentID = $_POST['StaffID'] ?? '';

    $password = $_POST['password'] ?? '';

    /*
     * ===========================
     * Validate the posted values.
     * ===========================
     */
    // Validate the username.
    if (empty($StaffID)) {
        $errors[] = 'Please provide a username.';
    } /* Other validations here using elseif statements */

    // Validate the password.
    if (empty($password)) {
        $errors[] = 'Please provide a password.';
    } /* Other validations here using elseif statements */

    /*
     * ==================================
     * Check if user exists. Save if not.
     * ==================================
     */
    if (!isset($errors)) {
        /*
         * =============================
         * Check if user already exists.
         * =============================
         */

        /*
         * The SQL statement to be prepared. Notice the so-called named markers.
         * They will be replaced later with the corresponding values from the
         * bindings array when using PDOStatement::bindValue.
         *
         * When using named markers, the bindings array will be an associative
         * array, with the key names corresponding to the named markers from
         * the sql statement.
         *
         * You can also use question mark markers. In this case, the bindings
         * array will be an indexed array, with keys beginning from 1 (not 0).
         * Each array key corresponds to the position of the marker in the sql
         * statement.
         *
         * @link http://php.net/manual/en/mysqli.prepare.php
         */
        $sql = 'SELECT COUNT(*)
                FROM staff
                WHERE StaffID = :StaffID';

        /*
         * The bindings array, mapping the named markers from the sql
         * statement to the corresponding values. It will be directly
         * passed as argument to the PDOStatement::execute method.
         *
         * @link http://php.net/manual/en/pdostatement.execute.php
         */
        $bindings = [
            ':StaffID' => $StaffID,
        ];

        /*
         * Prepare the sql statement for execution and return a statement object.
         *
         * @link http://php.net/manual/en/pdo.prepare.php
         */
        $statement = $connection->prepare($sql);

        /*
         * Execute the prepared statement. Because the bindings array
         * is directly passed as argument, there is no need to use any
         * binding method for each sql statement's marker (like
         * PDOStatement::bindParam or PDOStatement::bindValue).
         *
         * @link http://php.net/manual/en/pdostatement.execute.php
         */
        $statement->execute($bindings);

        /*
         * Fetch the data and save it into a variable.
         *
         * @link https://secure.php.net/manual/en/pdostatement.fetchcolumn.php
         */
        $numberOfFoundUsers = $statement->fetchColumn(0);

        if ($numberOfFoundUsers > 0) {
            $errors[] = 'The given username already exists. Please choose another one.';
        } else {
            /*
             * ========================
             * Save a new user account.
             * ========================
             */
            // Create a password hash.
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            $sql = 'INSERT INTO staff (
                        StaffID, StaffTitle, StaffName, StaffRole, StoreID, DepartmentID,
                        password
                    ) VALUES (
                        :StaffID, :StaffTitle, :StaffName, :StaffRole, :StoreID, :DepartmentID,
                        :password
                    )';

            $bindings = [
                ':StaffID' => $StaffID,
                ':StaffTitle' => $StaffTitle,
                ':StaffName' => $StaffName,
                ':StaffRole' => $StaffRole,
                ':StoreID' => $StoreID,
                ':DepartmentID' => $DepartmentID,
                ':password' => $passwordHash,
            ];

            $statement = $connection->prepare($sql);
            $statement->execute($bindings);

            // Signalize that a new account was successfully created.
            $accountCreated = TRUE;

            // Reset all values so that they are not shown in the form anymore.
            $username = $password = NULL;
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

        <title>Demo - Register</title>

        <style type="text/css">
            .messages { margin-bottom: 10px; }
            .messages a { text-transform: uppercase; font-weight: 700;}
            .error, .success { margin-bottom: 5px; }
            .error { color: #ff0000; }
            .success { color: #32cd32; }
            .form-group { margin-bottom: 10px; }
            .form-group label { display: inline-block; min-width: 90px; }
        </style>
    </head>
    <body>

        <h3>
            Register
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
            } elseif ($accountCreated) {
                ?>
                <div class="success">
                    You have successfully created your account.
                    <br/>Would you like to <a href="login.php">login</a> now?
                </div>
                <?php
            }
            ?>
        </div>

        <form action="" method="post">

            <div class="form-group">
                <label for="StaffID">StaffID</label>
                <input type="text" id="StaffID" name="StaffID" value="<?php echo $StaffID ?? ''; ?>" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="StaffTitle">StaffTitle</label>
                <input type="text" id="StaffTitle" name="StaffTitle" value="<?php echo $StaffTitle ?? ''; ?>" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="StaffName">StaffName</label>
                <input type="text" id="StaffName" name="StaffName" value="<?php echo $StaffName ?? ''; ?>" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="StaffRole">StaffRole</label>
                <input type="text" id="StaffRole" name="StaffRole" value="<?php echo $StaffRole ?? ''; ?>" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="StoreID">StoreID</label>
                <input type="text" id="StoreID" name="StoreID" value="<?php echo $StoreID ?? ''; ?>" placeholder="Username">
            </div>

            <div class="form-group">
                <label for="DepartmentID">DepartmentID</label>
                <input type="text" id="DepartmentID" name="DepartmentID" value="<?php echo $DepartmentID ?? ''; ?>" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" value="<?php echo $password ?? ''; ?>" placeholder="Password">
            </div>

            <button type="submit" id="registerButton" name="submit" value="register">
                Register
            </button>
        </form>

    </body>
</html>