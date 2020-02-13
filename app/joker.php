<?php

require_once 'ajaxloader.php';
require_once 'gamehelper.php';

// A használni kívánt segítség kinyerése az URL-ből
$urlArray = explode('/', $_SERVER["REQUEST_URI"]);
$jokerUsed = end($urlArray);

// Joker példányosítása
$joker = new Joker(
    $_SESSION["options"],
    LANG,
    $languages,
    $_SESSION["currentDifficulty"]);

// A kívánt metódus futtatása
$response = call_user_func([$joker, $jokerUsed]);
// A joker törlése a munkamenetben tárolt elérhető segítségek közül
$_SESSION["jokers"][$jokerUsed] = false;
// JSON továbbítása
echo json_encode($response, JSON_UNESCAPED_UNICODE);

class Joker {

    private $options = [];
    private $lang;
    private $languageTexts;
    private $difficulty;

    function __construct($options, $lang, $languageTexts, $diff){

        $this->options = $options;
        $this->lang = $lang;
        $this->languageTexts = $languageTexts;
        $this->difficulty = $diff;
    }
    // Telefonos segítség
    function phone(){
        // Válasz beszerzése
        $answer = $this->getAnswer()['answer'];

        $answerIndex = -1;
        
        for($i = 0; $i < 4; $i++){
            if(isset($this->options[$i])){
                // A válasz indexének tárolása
                if($this->options[$i][1] == $answer){
                    $answerIndex = $i;
                }
                // Véletlenszerű szám rendelése az opcióhoz
                $this->options[$i] = [$this->options[$i], rand(0,50)];
            }
        }
        // A helyes válasz tippjének felerősítése, szöveg inicializálása
        switch($this->difficulty){
            case 1:
                $this->options[$answerIndex][1] *= 6;
                $response["text"] = $this->languageTexts[$this->lang]["phone-easy"];
            break;
            case 2:
                $this->options[$answerIndex][1] *= 4;
                $response["text"] = $this->languageTexts[$this->lang]["phone-medium"];
            break;
            case 3:
                $this->options[$answerIndex][1] *= 2;
                $response["text"] = $this->languageTexts[$this->lang]["phone-hard"];
            break;
        }
        // A legnagyobb számot elért tipp kiszűrése
        $response["answer"] = array_reduce($this->options, function($previous, $current){
            return $previous[1] > $current[1] ? $previous : $current;
        })[0];
        // Visszatérés a tippel
        return $response;
    }

    function split(){
        // Válasz beszerzése
        $answer = $this->getAnswer()['answer'];
        
        // Helytelen válaszok kiválasztása
        $splitOptions = array_filter($this->options, function($option) use($answer){
            return $option[1] != $answer;
        });

        // Helytelen válaszok randomizálása
        $randomNum = str_shuffle("012");
        $r1 = (int) $randomNum[0];
        $r2 = (int) $randomNum[1];

        $keys = array_keys($splitOptions);
        // A két kiválasztott helytelen opció törlése a session-ből
        for($i = 0; $i < 4; $i++){
            if(isset($_SESSION["options"][$i]) && trim($_SESSION["options"][$i][1]) == trim($splitOptions[ $keys[$r1] ][1])
             ||isset($_SESSION["options"][$i]) && trim($_SESSION["options"][$i][1]) == trim($splitOptions[ $keys[$r2] ][1])){
                unset($_SESSION["options"][$i]);
            }
        }
        // A két kiválasztott helytelen opció visszaadása
        return [$splitOptions[ $keys[$r1] ], $splitOptions[ $keys[$r2] ] ];

    }

    function audience(){
        // Válasz beszerzése
        $answer = $this->getAnswer()['answer'];

        for($i = 0; $i < 4; $i++){
            for($i = 0; $i < 4; $i++){
                if(isset($this->options[$i])){
                    // A válasz indexének tárolása
                    if($this->options[$i][1] == $answer){
                        $answerIndex = $i;
                    }
                    // Véletlenszerű szám rendelése az opcióhoz
                    $this->options[$i][] = rand(1,4);
                }
            }
        }

        // A helyes válasz tippjének felerősítése
        switch($this->difficulty){
            case 1: $this->options[$answerIndex][2] *= 6.5;
            break;
            case 2: $this->options[$answerIndex][2] *= 4;
            break;
            case 3: $this->options[$answerIndex][2] *= 2.5;
            break;
        }
        // Százalékszámítás
        $pointSum = array_reduce($this->options, function($previous, $current){
            return $current[2] + $previous;
        });

        for ($i = 0; $i < 4; $i++){ 
            if(isset($this->options[$i])){
                $this->options[$i][2] = round($this->options[$i][2] / $pointSum * 100, 2);
            }
        }
        // A 4 opcióra érkezett tippek visszaadása
        return array_values($this->options);
    }

    function getAnswer(){
        
        // A helyes válasz kinyerése adatbázisból
        require_once 'ajaxloader.php';

        $database = new Database();

        $currentQuestionId = $_SESSION["currentQuestionId"];

        $queryCommand = "SELECT answer FROM question_$this->lang WHERE id = $currentQuestionId";
        
        $database->query($queryCommand);

        return $database->single();
    }

}

?>