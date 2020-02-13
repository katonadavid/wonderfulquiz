<?php
require 'ajaxloader.php';
require 'gamehelper.php';

// Kérdésszámláló növelése
$_SESSION["currentQuestionNr"]++;

$gamedata["money"] = $_SESSION["money"];
$gamedata["currentQuestion"] = $_SESSION["currentQuestionNr"];

// Nehézség beállítása

$pastQuestionCount = sizeof($_SESSION["pastQuestions"]);

if($pastQuestionCount < EASY_BREAKPOINT){
    $gamedata["difficulty"] = 1;
    $_SESSION["currentDifficulty"] = 1;
}elseif($pastQuestionCount < MEDIUM_BREAKPOINT){
    $gamedata["difficulty"] = 2;
    $_SESSION["currentDifficulty"] = 2;
}elseif($pastQuestionCount < HARD_BREAKPOINT){
    $gamedata["difficulty"] = 3;
    $_SESSION["currentDifficulty"] = 3;
}

// Nehézség szövegének tárolása
$gamedata["difficultyText"] = $difficultyText[LANG][$_SESSION["currentDifficulty"]];
// A kérdés díjának tárolása
$gamedata["currentPrize"] = PRIZES[$_SESSION["currentQuestionNr"]-1];
// A segítségek tömb tárolása
$gamedata["jokers"] = $_SESSION["jokers"];


// Hibakereséshez. A getinfo.php futtatásával képet kaphatunk a futó munkamenetről
$_SESSION['gameData'] = $gamedata;

// JSON továbbítása
echo json_encode($gamedata, JSON_UNESCAPED_UNICODE);
?>