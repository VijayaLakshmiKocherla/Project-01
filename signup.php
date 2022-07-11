<?php
$msg = '';
if (isset($_GET['signup'])) {
    if ($_GET['signup'] == "invalidPassword") {
        $msg = 'Passwords don\'t match';
    }
}
?>

<html>

<head>
    <title>
        Registration Page
    </title>
    <link rel="stylesheet" href="./styles/signup-styles.css">
</head>

<body>
    <img class="logo-image" src="./images/logo.png">
    <div class="registration-form">
        <form action="./signup-submit.php" method="post">
            <table class="registration-table">
                <caption class="registration-caption">Registration</caption>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" maxlength="15" placeholder="Enter your username"></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email" maxlength="30" pattern=".+@example\.com" required placeholder="Enter your emailId (name@example.com)"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" maxlength="15" placeholder="Enter your password"></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="confirmpassword" maxlength="15" placeholder="Confirm your password"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="Submit" value="Register" maxlength="15"> <a href="./signin.php" style="margin-left: 15px;  color: #6d8cd3; text-decoration: none;">Already have an account? Login here</a></td>
                </tr>

            </table>
        </form>

        <form action="./signin.php">
            <table>
                <tr>
                    <td></td>
                    <td>
                        <p><?php if ($msg != '') echo $msg; ?></p>
                    </td>
                </tr>
            </table>
        </form>
    </div>

</body>

</html>