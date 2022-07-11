<?php

if (isset($_POST['Submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $email = $_POST["email"];

    if ($password == $confirmpassword) {
        $file = fopen('registrations.txt', 'a+');
        fwrite($file, "\n" . $username . "," . $password . "," . $email);
        header('Location: ./signin.php');
    } else {
        header('Location: ./signup.php?signup=invalidPassword');
    }
} else {
    header('Location: ' . './signup.php');
}

?>

<html>

<body>
    Registration confirmed
</body>

</html>