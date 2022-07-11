<?php
session_start();
if (!isset($_SESSION['userData']['username'])) {
    header('location: ./signin.php');
}
?>
<html>

<head>
    <title>
        Who wants to be a millionaire
    </title>
    <link rel="stylesheet" href="./styles/start-game-button-styles.css">
</head>

<body>
    <img class="logo-image" src="./images/logo.png">

    <div>
        <form action="./start-game.php">
            <input class="input-style" type="submit" name="Submit" value="Start Game!"></td>
        </form>
        <form action="./leaderboard.php">
            <input class="input-style" type="submit" name="Leaderboard" value="Leaderboard"></td>
        </form>
        <form action="./signout.php">
            <input class="sign-out" type="submit" name="Signout" value="Sign Out"></td>
        </form>
    </div>

</body>

</html>