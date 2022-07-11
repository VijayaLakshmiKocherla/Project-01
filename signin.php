<?php
$msg = '';
if (isset($_GET['signin'])) {
    if ($_GET['signin'] == "nouserfound") {
        $msg = 'no user found';
    } else if ($_GET['signin'] == "invalid") {
        $msg = "invalid username/password";
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
        <form action="./signin-submit.php" method="post">
            <table class="registration-table">
                <caption class="registration-caption">Login</caption>
                <tr>
                    <td>Username:</td>
                    <td><input style="width:350px;" type="text" name="username" required maxlength="15" placeholder="Enter your username"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input style="width:350px;" type="password" name="password" required maxlength="15" placeholder="Enter your password"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="Submit" value="Login" maxlength="15">
                        <a href="./signup.php" style="margin-left: 15px;  color: #6d8cd3; text-decoration: none;">Don't have an account? Register here</a>
                    </td>
                </tr>
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