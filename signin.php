<?php
$msg = '';
if(isset($_GET['signin'])){
if($_GET['signin'] == "nouserfound"){
    $msg = 'no user found';
} else if($_GET['signin'] == "invalid"){
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
    <div class="registration-form">
        <form action="./signin-submit.php" method="post">
            <table class="registration-table">
                <caption class="registration-caption">Login</caption>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" maxlength="15" placeholder="Enter your username"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" maxlength="15" placeholder="Enter your password"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="Submit" value="Login" maxlength="15"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><p><?php if($msg != '') echo $msg; ?></p></td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>