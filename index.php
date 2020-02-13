<?php

session_start();
$_SESSION = array();
setcookie(session_name(),'',0,'/');
session_destroy();


require 'app/game_config.php';
require 'app/gamehelper.php';

?>

<!DOCTYPE html>
<html lang="<?php echo LANG; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css?family=Mukta:400,700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="config.js" defer></script>
    <script src="js/app.js" defer></script>
    <script>
        $(function () {
          $('[data-toggle="popover"]').popover()
        })
    </script>
    <title> <?php echo $languages[LANG]["title"]; ?> </title>
</head>

<body>
    <header class="p-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-7 d-flex justify-content-center justify-content-md-start">
                    <h2 class="border-l-r-gold px-3 d-inline-block" id="title"> <?php echo $languages[LANG]["title"]; ?></h2>
                </div>
                <div class="col-12 col-sm-5 d-flex justify-content-center justify-content-md-end align-items-baseline justify-content-end">
                    <div id="wallet" class="d-none m-0 py-1 px-3 black-shadow align-items-center justify-content-between"> <img src="img/wallet.svg" alt=""><h3 class="m-0"> &euro;<span>0</span></h3></div>
                </div>
            </div>
        </div>
    </header>

    <main class="d-flex flex-fill container-fluid">
        <section class="m-0 p-0 m-md-3 p-md-3 black-shadow flex-fill d-flex flex-column justify-content-center align-items-center position-relative">
            <div id="game-holder" class="w-100">
                <div id="game-header" class="w-100">
                    <div class="row d-flex flex-column flex-md-row">
                        <div class="col-12 col-md-8 d-flex">
                            <div id="question-info" class="d-none border-left-gold h-100 p-1 flex-column flex-md-row flex-fill justify-content-center align-items-center black-shadow">
                                <span class="p-1 m-1 m-md-2 d-flex align-items-center justify-content-center">
                                    <?php echo $languages[LANG]["questionText"]; ?> # 
                                    <div class="position-relative mx-1 inset-shadow" id="question-number-frame">
                                        <ul id="question-number" class="m-0 p-0 position-absolute">
                                        <?php for($i = 0; $i <= LENGTH_OF_GAME; $i++)
                                            echo '<li class="text-center">'.$i.'</li>';  
                                        ?>
                                        </ul>
                                    </div>
                                </span>
                                    <span id="difficulty-text" class="text-center"></span>
                                <div id="question-prize" class="p-1 m-1 m-md-2 d-flex justify-content-center align-items-center">
                                    <img src="img/money.svg" alt="">
                                    <span class="m-2"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 my-3 my-md-0 d-flex align-items-center justify-content-center justify-content-md-end">
                            <div id="help-options" class="d-none justify-content-end mr-2">
                                <button class="helpholder mx-2 black-shadow" id="phone" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="<?php echo $languages[LANG]["phone"]?>">
                                    <img src="img/tel.svg" alt="">
                                </button>
                                <button class="helpholder mx-2 black-shadow" id="split" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="<?php echo $languages[LANG]["split"]?>">
                                    <img src="img/fifty.svg" alt="">
                                </button>
                                <button class="helpholder mx-2 black-shadow" id="audience" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="<?php echo $languages[LANG]["audience"]?>">
                                    <img src="img/crowd.svg" alt="">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="game-main" class="flex-fill w-100">
                    <div class="row h-100">
                        <div class="h-100 col-12 d-flex flex-column justify-content-around align-items-center" id="game-center">
                            <div id="game-content" class="w-100 d-none">
                                <h1 class="black-shadow border-left-gold p-1 p-md-4 w-100 text-center m-0 my-md-4 d-flex align-items-center justify-content-center" id="question"><span></span></h1>
                                <div class="option-holder d-flex flex-fill flex-column justify-content-evenly w-100">
                                    <div class="option-group d-flex flex-column flex-md-row">
                                        <div class="option black-shadow border-left-gold p-1 p-md-4 my-1 mx-2" id="option1"><span></span></div>
                                        <div class="option black-shadow border-left-gold p-1 p-md-4 my-1 mx-2" id="option2"><span></span></div>
                                    </div>
                                    <div class="option-group d-flex flex-column flex-md-row">
                                        <div class="option black-shadow border-left-gold p-1 p-md-4 my-1 mx-2" id="option3"><span></span></div>
                                        <div class="option black-shadow border-left-gold p-1 p-md-4 my-1 mx-2" id="option4"><span></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                    <!-- START BUTTON -->
            <button class="px-5 py-2 border-0 startbutton text-uppercase position-absolute">start</button>
        </section>
    </main>


</body>

</html>