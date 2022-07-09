<?php
if(isset($_POST['Submit'])){
$username = $_POST['username'];
$password = $_POST['password'];
$file = fopen('registrations.txt', 'a+');
fwrite($file, "\n".$username.",".$password);
} else {
    header('Location: ' . './signup.php');
}
?>

<html>
    <body>
        Registration confirmed
    </body>
</html>