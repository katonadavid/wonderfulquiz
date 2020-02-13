<?php

require 'ajaxloader.php';
require 'gamehelper.php';

// PDO példány létrehozása

$database = new Database();

// Az adott válasz tárolása
$answer = strval($_POST["answer"]);

// Az éppen futó kérdés azonosítójának tárolása
$currentQuestionId = $_SESSION["currentQuestionId"];

$lang = LANG;

$queryCommand = "SELECT * FROM question_$lang WHERE id = $currentQuestionId AND answer = :answer";

// SQL lekérdezés előkészítése
$database->query($queryCommand);
$database->bind(':answer', $answer);

// SQL lekérdezés futtatása
$result = $database->single();

// Helyes válasz esetén
if($result){

    // Nyeremény tárolása
    $_SESSION["money"] = PRIZES[$_SESSION["currentQuestionNr"]-1];

    // JSON előkészítése
    $response['result'] = true;
    $response['money'] = $_SESSION["money"];

    $pastQuestionCount = sizeof($_SESSION["pastQuestions"]);

    // Játék végének ellenőrzése
    if($pastQuestionCount == LENGTH_OF_GAME){
        $response["jackpot"] = true;
        $response["endText"] = array_values($languages[$lang]["jackpot-text"]);
    }
    // JSON továbbítása
    echo json_encode($response, JSON_UNESCAPED_UNICODE);

    // Helytelen válasz ág
}else{
    $response["result"] = false;
    $response["endWallet"] = $languages[$lang]['game-over-prize'];

    switch ($_SESSION["currentDifficulty"]){
        // Összefoglaló szöveg előkészítése
        case 1 :
            $response["endText"] = $languages[$lang]['game-over-easy'];
        break;
        case 2 :
            $response["endText"] = $languages[$lang]['game-over-medium'];
        break;
        case 3 :
            $response["endText"] = $languages[$lang]['game-over-hard'];
        break;
    }
    // JSON továbbítása
    echo json_encode($response);
}

?>