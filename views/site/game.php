<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Game';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php

    if (isset($_POST[" submitButton" ]) and isset($_POST[" guess" ])) {
        processForm();
    } else {
        displayForm(rand(1, 100));
    }

    function processForm() {
        $number = (int)$_POST[" number" ];
        $guessesLeft = (int)$_POST[" guessesLeft" ]-1;
        $guess = (int)$_POST[" guess" ];

        if ($guess == $number) {
            displaySuccess($number);
        } elseif ($guessesLeft == 0) {
            displayFailure($number);
        } elseif ($guess <$number) {
            displayForm($number, $guessesLeft," Too low-try again!" );
        } else {
            displayForm($number, $guessesLeft," Too high-try again!" );
        }
    }

    function displayForm($number, $guessesLeft=5, $message="" ) {
        ?>
        <form action="" method="post">
            <div>
                <input type="hidden" name="number" value="<?php echo $number?>" />
                <input type="hidden" name="guessesLeft" value="<?php echo $guessesLeft?>" />
                <?php if ($message) echo " <p>$message</p>" ?>
                <p>I'm thinking of a number. You have <?php echo $guessesLeft?> <?php echo ($guessesLeft == 1) ?" try" :" tries" ?> left to guess it!</p>
                <p>What's your guess? <input type="text" name="guess" value=""/>
                    <input type="submit" name="submitButton" value="Guess"/></p>
            </div>
        </form>
        <?php
    }

    function displaySuccess($number) {
        ?>
        <h2>Congratulations!</h2>
        <p>You guessed my number: <?php echo $number?>!</p>

        <form action="" method="post">
            <p><input type="submit" name="tryAgain" value="Try Again"/></p>
        </form>
        <?php
    }

    function displayFailure($number) {
        ?>
        <h2>Bad luck!</h2>
        <p>You ran out of guesses. My number was <?php echo $number?>!</p>

        <form action="" method="post">
            <p><input type="submit" name="tryAgain" value="Try Again"/></p>
        </form>
        <?php
    }
    ?>

</div>
