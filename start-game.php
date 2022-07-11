<?php
session_start();
if (!isset($_SESSION['userData']['username'])) {
    header('location: ./signin.php');
}
function jsonToArray($filePath)
{
    $decodedJson = file_get_contents($filePath);
    return json_decode($decodedJson, true);
}
function writeToLeaderboard($name, $question)
{
    $values = jsonToArray("./question-value.json");
    $file = fopen('./leaderboard.txt', 'a+');
    fwrite($file, "\n" . $name . ',' . $values[$question]);
}

if (!isset($_POST['phone']) && !isset($_POST['audience']) && !isset($_POST['50-50'])) {
    $currentQuestionNumber = file_get_contents("./questionNumber.json");
    $questionNumberParsed = json_decode($currentQuestionNumber, true);
    $questionNumber = $questionNumberParsed['questionNumber'];

    $fileContents = file_get_contents("./questions.json");
    $parsedQuestions = json_decode($fileContents, true);
    $submittedAnswer = "0";

    if (isset($_POST['one'])) {
        $submittedAnswer = "1";
    }
    if (isset($_POST['two'])) {
        $submittedAnswer = "2";
    }
    if (isset($_POST['three'])) {
        $submittedAnswer = "3";
    }
    if (isset($_POST['four'])) {
        $submittedAnswer = "4";
    }

    if ($submittedAnswer == "0") {
        $questionToShow = "1";
    } else {
        $answer = $parsedQuestions[$questionNumber]["answer"];
        if ($answer == $submittedAnswer) {
            if ($questionNumber == "15") {
                writeToLeaderboard($_SESSION['userData']['username'], $questionNumber);
                header('Location: ./win.php');
            }
            $questionToShow = intval($questionNumber) + 1;
            $questionToShow = strval($questionToShow);
        } else {
            $questionNumber = strval(intval($questionNumber) - 1);
            writeToLeaderboard($_SESSION['userData']['username'], $questionNumber);
            header('Location: ./gameover.php');
        }
    }
    $questionNumberParsed["questionNumber"] = $questionToShow;
    $newJsonString = json_encode($questionNumberParsed);
    file_put_contents('./questionNumber.json', $newJsonString);
    $question = $parsedQuestions[$questionToShow]["question"];
    $optionOne = $parsedQuestions[$questionToShow]["option-one"];
    $optionTwo = $parsedQuestions[$questionToShow]["option-two"];
    $optionThree = $parsedQuestions[$questionToShow]["option-three"];
    $optionFour = $parsedQuestions[$questionToShow]["option-four"];
} else if (isset($_POST['50-50'])) {
    $_SESSION['userData']['fifty-fifty'] = true;
    $currentQuestionNumber = file_get_contents("./questionNumber.json");
    $questionNumberParsed = json_decode($currentQuestionNumber, true);
    $questionNumber = $questionNumberParsed['questionNumber'];

    $fileContents = file_get_contents("./questions.json");
    $parsedQuestions = json_decode($fileContents, true);

    $answer = $parsedQuestions[$questionNumber]["answer"];

    $optionOne = $parsedQuestions[$questionNumber]["option-one"];
    $optionTwo = $parsedQuestions[$questionNumber]["option-two"];
    $optionThree = $parsedQuestions[$questionNumber]["option-three"];
    $optionFour = $parsedQuestions[$questionNumber]["option-four"];
    $questionToShow = $questionNumber;

    $option_array = array("1", "2", "3", "4");
    unset($option_array[array_search($answer, $option_array)]);
    $k = array_rand($option_array);
    $otherOption = $option_array[$k];
    $optionOne = $answer == "1" || $otherOption == "1" ? $optionOne : "";
    $optionTwo = $answer == "2" || $otherOption == "2" ? $optionTwo : "";
    $optionThree = $answer == "3" || $otherOption == "3" ? $optionThree : "";
    $optionFour = $answer == "4" || $otherOption == "4" ? $optionFour : "";
    $question = $parsedQuestions[$questionToShow]["question"];
}
$isFiftyDisabled = $_SESSION['userData']['fifty-fifty'];
?>
<html>

<head>
    <title>Game</title>
    <link rel="stylesheet" href="./styles/game-styles.css">
</head>

<body>
    <div class="logo-table">
        <div style="flex: 1;">

        </div>
        <div class="millionaire-image">
            <img class="millionaire-image-actual" src="./images/logo.png">
        </div>
        <div class="amount-table">
            <table>
                <tr class=<?php if ($questionToShow == "15") echo "current-question"; ?>>
                    <td class="amount-table-data">15</td>
                    <td class="amount-table-data">$1000000</td>
                </tr>
                <tr class=<?php if ($questionToShow == "14") echo "current-question"; ?>>
                    <td class="amount-table-data">14</td>
                    <td class="amount-table-data">$500000</td>
                </tr>
                <tr class="<?php if ($questionToShow == "13") echo "current-question"; ?>">
                    <td class="amount-table-data">13</td>
                    <td class="amount-table-data">$250000</td>
                </tr>
                <tr class="<?php if ($questionToShow == "12") echo "current-question"; ?>">
                    <td class="amount-table-data">12</td>
                    <td class="amount-table-data">$125000</td>
                </tr>
                <tr class="<?php if ($questionToShow == "11") echo "current-question"; ?>">
                    <td class="amount-table-data">11</td>
                    <td class="amount-table-data">$64000</td>
                </tr>
                <tr class="<?php if ($questionToShow == "10") echo "current-question"; ?>">
                    <td class="amount-table-data">10</td>
                    <td class="amount-table-data">$32000</td>
                </tr>
                <tr class="<?php if ($questionToShow == "9") echo "current-question"; ?>">
                    <td class="amount-table-data">9</td>
                    <td class="amount-table-data">$16000</td>
                </tr>
                <tr class="<?php if ($questionToShow == "8") echo "current-question"; ?>">
                    <td class="amount-table-data">8</td>
                    <td class="amount-table-data">$8000</td>
                </tr>
                <tr class="<?php if ($questionToShow == "7") echo "current-question"; ?>">
                    <td class="amount-table-data">7</td>
                    <td class="amount-table-data">$4000</td>
                </tr>
                <tr class="<?php if ($questionToShow == "6") echo "current-question"; ?>">
                    <td class="amount-table-data">6</td>
                    <td class="amount-table-data">$2000</td>
                </tr>
                <tr class="<?php if ($questionToShow == "5") echo "current-question"; ?>">
                    <td class="amount-table-data">5</td>
                    <td class="amount-table-data">$1000</td>
                </tr>
                <tr class="<?php if ($questionToShow == "4") echo "current-question"; ?>">
                    <td class="amount-table-data">4</td>
                    <td class="amount-table-data">$500</td>
                </tr>
                <tr class="<?php if ($questionToShow == "3") echo "current-question"; ?>">
                    <td class="amount-table-data">3</td>
                    <td class="amount-table-data">$300</td>
                </tr>
                <tr class="<?php if ($questionToShow == "2") echo "current-question"; ?>">
                    <td class="amount-table-data">2</td>
                    <td class="amount-table-data">$200</td>
                </tr>
                <tr class="<?php if ($questionToShow == "1") echo "current-question"; ?>">
                    <td class="amount-table-data">1</td>
                    <td class="amount-table-data">$100</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="question-box">
        <form action="" method="post">
            <table>
                <caption>
                    <?php echo $question; ?>
                </caption>
                <tr>
                    <td><input class="option-button" type="submit" name="one" value=<?php echo $optionOne; ?>></td>
                    <td><input class="option-button" type="submit" name="two" value=<?php echo $optionTwo; ?>></td>
                </tr>
                <tr>
                    <td> <input class="option-button" type="submit" name="three" value=<?php echo $optionThree; ?>> </td>
                    <td> <input class="option-button" type="submit" name="four" value=<?php echo $optionFour; ?>> </td>
                </tr>
            </table>
            <div class="game-options">
                <form action="" method="POST">
                    <input class="game-options-input" style="background-color: <?php if ($isFiftyDisabled) echo "grey"; ?>" type="submit" value="50-50" name="50-50" <?php if ($isFiftyDisabled) echo "disabled"; ?>>
                    <input class="game-options-input" type="submit" value="phone a friend" name="phone" disabled>
                    <input class="game-options-input" type="submit" value="audience poll" name="audience" disabled>
                </form>
            </div>
        </form>
    </div>
</body>

</html>