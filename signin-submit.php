<?php
if (isset($_POST['Submit'])) {
    session_start();
    print_r($_POST);
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userfound = false;
    $invalidUser = false;
    $registrations = file('./registrations.txt', FILE_IGNORE_NEW_LINES);

    for ($i = 0; $i < count($registrations); $i++) {
        $registration = explode(",", $registrations[$i]);
        print_r($registration);
        if ($registration[0] == $username) {
            if ($registration[1] == $password) {
                $userfound = true;
                $_SESSION['userData']['username'] = $username;
                $_SESSION['userData']['fifty-fifty'] = false;
                header('Location: ./start-game-button.php');
            } else {
                $invalidUser = true;
                header('Location: ./signin.php?signin=invalid');
            }
        }
    }

    if ($userfound == false && $invalidUser == false)
        header('Location: ./signin.php?signin=nouserfound');
}
