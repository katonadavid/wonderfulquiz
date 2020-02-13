const api_url = game_url + '/app/';
const body = document.querySelector('body');
const startBtn = document.querySelector('.startbutton');
const gameHolder = document.querySelector('#game-holder');
const gameCenter = document.querySelector('#game-center');
const gameContent = document.querySelector('#game-content');
const gameHeader = document.querySelector('#game-header');
const question = gameContent.querySelector('#question');
const optionElements = document.getElementsByClassName('option');
const walletDiv = document.querySelector('#wallet');
const walletMoney = walletDiv.querySelector('h3');
const walletAmount = walletDiv.querySelector('span');
const questionNr = document.querySelector('#question-number');
const questionInfo = document.querySelector('#question-info');
const jokersDiv = document.querySelector('#help-options');
const jokerElements = Array.from(jokersDiv.querySelectorAll('.helpholder'));
const difficultySpan = questionInfo.querySelector('#difficulty-text');
const questionPrize = questionInfo.getElementsByTagName('span')[2];
let questionData;
let gameData;
let optionListeners = [];
let jokerListeners = ["phone", "split", "audience"];

document.addEventListener('keyup', startWithSpace);

startBtn.addEventListener('click', startGame);

 
async function startGame(){

    document.removeEventListener('keyup', startWithSpace);
    // Prevent running of this function twice
    startBtn.removeEventListener('click', startGame);

    fadeOut(startBtn, 800);

    await renderData();
    await renderQuestion();

    fadeIn(questionInfo);
    fadeIn(jokersDiv);
    fadeIn(walletDiv);

    document.addEventListener('keyup', keyboardControl);

}

async function renderQuestion(){
    
    questionData = await fetchQuestion();

    // If we have no questions left in DB, we get false
    if(questionData){
        
        let options = questionData.options;
    
        let elementArray = Array.of(...optionElements);
        elementArray.forEach((element, i) => {
            if(optionListeners[options[i][0]]){
                element.removeEventListener('click', optionListeners[options[i][0]]);
            }
            optionListeners[options[i][0]] = evaluateAnswer.bind(null, questionData.options[i][1], element);
            element.addEventListener('click', optionListeners[options[i][0]]);
            let span = element.querySelector('span');
            span.innerText = options[i][1];
            span.classList.remove('fadeOut');
            element.classList.remove('correct', 'wrong', 'unavailable', 'phone-tip');
            element.letter = options[i][0];
        });
        document.addEventListener('keyup', keyboardControl);
        question.innerText = questionData.question;
        renderDifficulty(questionData.difficulty);
        renderJokers(gameData.jokers);
        fadeIn(gameContent);
    }else{
        alert('Something terrible happened, there are no more questions!');
    }
    
}

async function renderData(){

    gameData = await fetchData();
    rollUp(questionNr);
    questionPrize.innerHTML = ' &euro;' + gameData.currentPrize;

}

function renderDifficulty(difficulty){

    difficultySpan.innerText = gameData.difficultyText;


    switch(parseInt(difficulty)){
        case 1 : difficultySpan.classList.add('easy');
        break;
        case 2 : difficultySpan.classList.add('medium');
        break;
        case 3 : difficultySpan.classList.add('hard');
        break;
    }
}

function renderJokers(jokers){

    for (const joker in jokers) {
            let element = jokerElements.find(element => element.getAttribute('id') == joker);
            element.removeEventListener('click',jokerListeners[joker]);
            if(jokers[joker]){
                // If the joker is available
                jokerListeners[joker] = () => useJoker(element);
                element.addEventListener('click',jokerListeners[joker]);
            }else{
                element.classList.add('unavailable');
            }
    }
}

async function fetchQuestion(){
    
    try{
        let questionRequest = await fetch(api_url + 'getquestion');
        let question = await questionRequest.json();
        return question;
    }catch(error){
        alert('Something went wrong while fetching question. Check the console');
        console.log(error);
    }
}

async function fetchData(){

    try{
        let gameDataRequest = await fetch(api_url + 'getgamedata');
        let gameData = await gameDataRequest.json();
        return gameData;
    }catch(error){
        alert('Something went wrong while fetching gamedata. Check the console');
        console.log(error);
    }
}

async function evaluateAnswer(givenAnswer, optionElement){

    optionElement.removeEventListener('click', optionListeners[optionElement.letter]);
    document.removeEventListener('keyup', keyboardControl);
    
    const postData = new FormData();
    postData.append('answer', givenAnswer);

    const resultObject = await fetch(
        api_url + 'checkanswer',
        {
            method : 'POST',
            body : postData
        }
        ).then( response => response.json()).then( result => result );
        
    if(resultObject.jackpot){
        blink(optionElement, 'correct');
        setTimeout(async function() {
            updateWallet(resultObject.money);
            firework(resultObject.endText, resultObject.money);
        }, 1000);
        await clearSession();
    }else if(resultObject.result){
        blink(optionElement, 'correct');
        setTimeout(async function() {
            await renderData();
            await renderQuestion();
            updateWallet(resultObject.money);
        }, 1000);
    }else{
        blink(optionElement, 'wrong');
        setTimeout(() => {
            gameOver(resultObject.endText, resultObject.endWallet);
        }, 1000);
        await clearSession();
    }   
}

async function useJoker(joker){
    
    const jokerUsed = joker.getAttribute('id');

    let jokerResult = await fetch(api_url + '/joker/' +jokerUsed)
    .then(
        response => response.json())
    .then(result => result);

    joker.removeEventListener('click', jokerListeners[jokerUsed]);
    joker.classList.add('unavailable');

    switch(jokerUsed){
        case 'phone':
            renderPhoneJoker(jokerResult);
            break;
        case 'split':
            renderSplitJoker(jokerResult);
            break;
        case 'audience':
            renderAudienceJoker(jokerResult);
            break;
    }
}

function renderPhoneJoker(result){

    let i = 0;
    while(optionElements[i].innerText != result.answer[1] && i < optionElements.length){
        i++;
    }
    let answerLetter = optionElements[i].letter;
    
    const backdrop = showBackdrop();
    
    const helpTextFrame = document.createElement('div');
    helpTextFrame.classList.add('help-modal');
    helpTextFrame.addEventListener('click', () => {
        hideBackdrop();
    });

    document.addEventListener('keyup', backdropListener);
    const helpText = result.text.replace('%OPTION%', answerLetter);
    helpTextFrame.innerHTML=`
    <h1>${helpText}</h1>
    `;
    
    optionElements[i].classList.add('phone-tip');

    backdrop.append(helpTextFrame);
}

function renderSplitJoker(result){

    document.addEventListener('keyup', backdropListener);

    for(let i = 0; i < optionElements.length; i++){
        if(optionElements[i].innerText.trim() == result[0][1].trim() || optionElements[i].innerText.trim() == result[1][1].trim()){
            optionListeners[optionElements[i].letter] = null;
            optionElements[i].classList.add('unavailable');
            optionElements[i].querySelector('span').classList.add('fadeOut');
        }
    }

}

function renderAudienceJoker(result){
    
    document.addEventListener('keyup', backdropListener);

    const backdrop = showBackdrop();

    const audienceFrame = document.createElement('div');
    audienceFrame.classList.add('help-modal');
    const chartFrame = document.createElement('div');
    chartFrame.classList.add('help-modal', 'chart');
    const chartLetters = document.createElement('div');
    chartLetters.classList.add('chart-letters');
    
    for(const option of result){
        let barLetter = document.createElement('span');
        barLetter.innerText = option[0];
        chartLetters.append(barLetter);
        let chartBar = document.createElement('div');
        chartBar.classList.add('chart-bar');
        chartBar.style.height = `${option[2]}%`;
        chartFrame.append(chartBar);
    }

    audienceFrame.append(chartFrame, chartLetters);

    audienceFrame.addEventListener('click', () => {
        hideBackdrop();
    });

    backdrop.append(audienceFrame);

}

async function clearSession(){

    try{
        await fetch(api_url + 'clearsession');
    }catch(error){
        alert('Something went wrong while clearing session. Please try again.');
        console.log(error);
    }
}

function gameOver(endText, endWallet, jackpot = false){

    setTimeout(() => {
        fadeOut(walletDiv,600);
        fadeOut(gameHolder,600);
    }, 600);

    endWallet = endWallet.replace('%MONEY%', '&euro;' + gameData.money);

    setTimeout(() => {
        gameHolder.innerHTML='';
        const gameOverDiv = document.createElement('div');
        gameOverDiv.setAttribute('id', 'game-over');
        gameOverDiv.innerHTML=`
        <h1>Game Over</h1>
        <h3>${endText}</h3>
        <h4><img src="img/wallet.svg">${endWallet}<h4>
        `;
        gameHolder.append(gameOverDiv);
        fadeIn(gameHolder);
        showFlex(gameHolder);
    }, 1500);
    
}

// EFFECTS

function startWithSpace(event){
    if (event.keyCode === 32) {
        startGame();
    }
}

function backdropListener(e){
    if(e.keyCode == 13){
        hideBackdrop();
    }
}

function keyboardControl(e){
    
    const options = ['a', 'b', 'c', 'd'];
    if(options.includes(e.key)){
        try{
            switch(e.key){
                case 'a': optionListeners['A']();
                break;
                case 'b': optionListeners['B']();
                break;
                case 'c': optionListeners['C']();
                break;
                case 'd': optionListeners['D']();
                break;
            }
        }catch(e){
            alert('Ez az opció már nem elérhető!');
        }
    }else if(e.altKey){
        
        switch(e.key){
            case '1' : jokerListeners["phone"]();
            break;
            case '2' : jokerListeners["split"]();
            break;
            case '3' : jokerListeners["audience"]();
            break;
        }
    }
}
 
function fadeOut(element, timeout){
    element.classList.remove('fadeIn');
    element.classList.add('fadeOut');
    setTimeout(() => {
        element.style.display='none';
    }, timeout);
}

function fadeIn(element){
    element.classList.remove('fadeOut');
    element.classList.remove('d-none');
    element.classList.add('fadeIn');
}

function showFlex(element){
    element.style.display='flex';
}

function blink(elem, answerType){
    elem.classList.add(answerType);
}

function rollUp(elem){
    let top = elem.style.top;

    if(top.length > 0){
        top = parseInt(top.substr(0, top.length-2)) - 35;
        top = top + 'px';
        elem.style.top = top;
    }else{
        top = '-35px';
        elem.style.top = top;
    }
}

function showBackdrop(){
    const backdrop = document.createElement('div');
    backdrop.className = 'backdrop';
    fadeIn(backdrop,200);
    body.append(backdrop);

    return backdrop;
}

function hideBackdrop(){
    document.removeEventListener('keyup', backdropListener);
    let backdrop = document.querySelector('.backdrop');
    fadeOut(backdrop,200);
    setTimeout(() => {
        backdrop.remove();
    }, 200);
    document.removeEventListener
}

function updateWallet(money){
    walletAmount.innerHTML=money;
    walletMoney.classList.add('bounce');
    setTimeout(() => {
        walletMoney.classList.remove('bounce');
    }, 1500);
}

function firework(text, prize){
    const backdrop = showBackdrop();

    const message1 = document.createElement('div');
    message1.className = 'jackpot-msg h-25 w-100';
    message1.innerHTML = `<span class="display-3">${text[0]}</span>`;

    const message2 = document.createElement('div');
    message2.className = 'jackpot-msg';
    message2.innerHTML = `<h3>${text[1]}</h3>`;

    const message3 = document.createElement('div');
    message3.className = 'jackpot-msg';
    message3.innerHTML = `
    <h1>${text[2]}: &euro; ${prize}</h1>
    `;

    const background = document.createElement('div');
    background.className = 'jackpot-bg';

    message3.append(background);
    
    backdrop.append(message1, message2, message3);
}