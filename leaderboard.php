<?php
$scores = file('./leaderboard.txt', FILE_IGNORE_NEW_LINES);
$scoresArray = array();
for ($i = 0; $i < count($scores); $i++) {
    array_push($scoresArray, explode(",", $scores[$i]));
}

$columns = array_column($scoresArray, 1);
array_multisort($columns, SORT_DESC, $scoresArray);

?>
<html>

<head>
    <title>
        Who wants to be a millionaire
    </title>
    <link rel="stylesheet" href="./styles/leaderboard-styles.css">
</head>

<body>
    <img class="logo-image" src="./images/logo.png">

    <div class="leaderboard">
        <table style="border-collapse: collapse;">
            <caption class="table-caption">Leaderboard</caption>
            <tr class="table-row">
                <th class="table-head">Contestant Name</th>
                <th class="table-head">Amount won</th>
            </tr>
            <?php foreach ($scoresArray as $score) {
            ?>
                <tr class="table-row">
                    <td class="table-data"><?php echo $score[0] ?></td>
                    <td class="table-data"><?php echo "$" . $score[1]; ?></td>
                </tr>
            <?php } ?>
        </table>
        <form action="./start-game-button.php">
            <input class="back" type="submit" name="Back" value="Home"></td>
        </form>
        <form action="./signout.php">
            <input class="sign-out" type="submit" name="Signout" value="Sign Out"></td>
        </form>
    </div>
</body>

</html>