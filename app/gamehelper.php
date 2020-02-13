<?php

// Nyelvi beállítások

$languages = [
    'de' => [
        'title' => 'Die wunderschöne Quiz!',
        'questionText' => 'Frage',
        'helpText' => 'Hilfe',
        'phone' => 'Telefonjoker',
        'split' => '50:50-Joker',
        'audience' => 'Publikumsjoker',
        'phone-easy' => 'Ich bin mir ziemlich sicher, dass die Antwort %OPTION% ist...',
        'phone-medium' => 'Ich denke, die Antwort ist %OPTION%.',
        'phone-hard' => 'Ich bin nicht sicher, aber es ist vielleicht %OPTION%.',
        'game-over-easy' => 'Es hat nicht so lang gedauert...',
        'game-over-medium' => 'Ganz gut gemacht!',
        'game-over-hard' => 'Wow! Ich gratuliere!',
        'game-over-prize' => 'Du hast %MONEY% gewonnen!',
        'jackpot-text' => ['Ich gratuliere!', 'Du hast das Spiel gewonnen!', 'Dein Gewinn']
    ],
    'en' => [
        'title' => 'The wonderful Quiz!',
        'questionText' => 'Question',
        'helpText' => 'Help',
        'phone' => 'Phone a Friend',
        'split' => '50:50',
        'audience' => 'Ask the Audience',
        'phone-easy' => 'I am pretty sure it is %OPTION%...',
        'phone-medium' => 'I think, the answer is %OPTION%.',
        'phone-hard' => 'I am not sure... it might be %OPTION%.',
        'game-over-easy' => 'It did not really take long...',
        'game-over-medium' => 'Well done!',
        'game-over-hard' => 'Wow! Congratulations!',
        'game-over-prize' => 'You won %MONEY%',
        'jackpot-text' => ['Congratulations!', 'You\'ve won the game!', 'Your prize']
    ],
    'hu' => [
        'title' => 'A mindentudó kvíz',
        'questionText' => 'Kérdés',
        'helpText' => 'Segítség',
        'phone' => 'Telefonos segítség',
        'split' => 'Lehetőségek felezése',
        'audience' => 'Közönségszavazás',
        'phone-easy' => 'Elég biztos vagyok benne hogy a válasz a(z) %OPTION%.',
        'phone-medium' => 'Szerintem a helyes válasz a(z) %OPTION%.',
        'phone-hard' => 'Nem igazán tudom... talán a(z) %OPTION% a helyes.',
        'game-over-easy' => 'Legközelebb jobban megy majd!',
        'game-over-medium' => 'Szép teljesítmény!',
        'game-over-hard' => 'Wow! Gratulálok!',
        'game-over-prize' => '%MONEY%-t nyertél!',
        'jackpot-text' => ['Gratulálok!', 'Megnyerted a játékot!', 'Nyereményed']
    ]
];

// Munkamenetváltozók inicializálása

$_SESSION["money"] = isset($_SESSION["money"]) ? $_SESSION["money"] : 0;
$_SESSION["jokers"] = isset($_SESSION["jokers"]) ? $_SESSION["jokers"] : ["phone" => true, "split" => true, "audience" => true];


if(!isset($_SESSION["currentQuestionNr"]) || empty($_SESSION["currentQuestionNr"])){
    $_SESSION["currentQuestionNr"] = 0;
}

$_SESSION["pastQuestions"] = isset($_SESSION["pastQuestions"])? $_SESSION["pastQuestions"] : [];
$_SESSION["currentDifficulty"] = isset($_SESSION["currentDifficulty"]) ? $_SESSION["currentDifficulty"] : 1;

$pastQuestions = [];

$difficultyText = [
    'de' => [
        1 => 'Einfach',
        2 => 'Mittelschwer',
        3 => 'Schwer'
    ],
    'en' => [
        1 => 'Easy',
        2 => 'Medium',
        3 => 'Hard'
    ],
    'hu' => [
        1 => 'Könnyű',
        2 => 'Közepes',
        3 => 'Nehéz'
    ]
];

?>