<?php

require 'ajaxloader.php';
require 'gamehelper.php';

$database = new Database();

// Null értékek szűrése
$pastQuestions = array_filter($_SESSION['pastQuestions']);

// A már feltett kérdések kiszűrése
$pastQuestionQuery = empty($pastQuestions) ? '' : 'id NOT IN (' . implode(',',$pastQuestions) .') AND';
// A jelenlegi nehézség mentése
$currentDifficulty = $_SESSION["currentDifficulty"];

$lang = LANG;

// A lekérdezés
$queryCommand = <<<SQL
SELECT id, question, option1, option2, option3, option4, difficulty FROM question_$lang 
WHERE $pastQuestionQuery 
difficulty = $currentDifficulty
ORDER BY RAND() LIMIT 1
SQL;

// A lekérdezés futtatása
$database->query($queryCommand);
// A kérdés kinyerése
$question = $database->single();

// Ha van még kérdés hátra
if($question){

    // Tároljuk az azonosítóját a munkamenetben
    $_SESSION["pastQuestions"][] = $question["id"];

    // Válaszopciók randomizálása
    $options = [$question["option1"], $question["option2"], $question["option3"], $question["option4"]];

    $randomPositions = range(0,3);
    shuffle($randomPositions);

    // Betűjelek opciókhoz fűzése
    for($i = 0, $letter = 'A'; $i < sizeof($options); $i++, $letter++){
        $question["options"][] = [$letter, $options[$randomPositions[$i]]];
    }

    // Munkamenetváltozók tárolása
    $_SESSION["currentQuestionId"] = $question["id"];
    $_SESSION["options"] = $question["options"];

    // JSON továbbítása
    echo json_encode($question, JSON_UNESCAPED_UNICODE);

}else{
    // Ha nincs több kérdés ami megfelel a kritériumoknak, false érték adása
    $response = json_encode(false, JSON_UNESCAPED_UNICODE);
    echo $response;
}
?>