<?php
require_once '../Core/init.php';
init_session();
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Décrivez-moi !</title>
        <link rel="stylesheet" type="text/css" href="../Style/style.css"> -->
    </head>

    <body>
<h2>Score: <b id='score'>0</b> points</h2>
     <div id="jeu">

         <div>Il reste <b id="time">10</b> secondes!</div>
            <img id="photo" src="">
            <input type="text" placeholder="Décrivez l'image" id="reponse">
            <ul id="tags"></ul>

        </div>



    </body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
    let photos;
    $.post('SqlAction.php', {action: 'getPhotos'}, function(response) {photos = JSON.parse(response); showRandomPhoto();});
    let tags;$.post('SqlAction.php', {action: 'getTags'}, function(response) {tags = JSON.parse(response)});
    let currentPhoto;
    let score = 0;
    let photosRestantes = 10;
    let username=document.getElementById('username');
    // Nombre de photo à faire analyser pour une partie

    let display = document.getElementById('time');
    let input = document.getElementById('reponse');
    let ul = document.getElementById('tags');

    startTimer(10, display); // Temps de jeu = 10 secondes pour chaque image

    input.addEventListener('keyup', function(event) {
        if (event.keyCode === 13 && input.value.length) { //Touche entrée
            let photoTags = tags.filter(tag => tag.photoid==currentPhoto['id']);
            let li = document.createElement('li');
            if(photoTags.find(tag => tag.name.toLowerCase() === input.value.toLowerCase()) == undefined) {
               //Mauvaise réponse
           li.appendChild(document.createTextNode(input.value.toLowerCase()+" +0 points !"));
               $.post('false_tag.php', { name: input.value.toLowerCase(),photoid: currentPhoto['id']});
              }else { // Bonne réponse
                li.appendChild(document.createTextNode(input.value.toLowerCase()+" +2 points !"));
            updateScore(2);

            }
            ul.appendChild(li);
            input.value="";
        }
    });

    function updateScore(points) {
        let h1 = document.getElementById('score');
        score+=points;
        $.post('SqlAction.php',{scores:points}, function(){
          h1.textContent = score;
        });

    }

    function showRandomPhoto() {
        let photo = document.getElementById('photo');
        currentPhoto = photos[Math.floor(Math.random() *  Math.floor(photos.length))];
        photo.setAttribute("src", currentPhoto['url']);
    }

    function startTimer(duration, display) {
        let timeLeft = duration;
        let timer = setInterval(function () {
            timeLeft--;
            display.textContent = timeLeft;
            if(timeLeft==0){
                timeLeft = duration;
                photosRestantes--;
                while (ul.firstChild) { //On vide la liste des réponses du joueur à l'écran
                    ul.removeChild(ul.lastChild);
                }

                if(photosRestantes>0) { //La prochaine image est affichée
                    showRandomPhoto();
                } else { //La partie est terminée
                    let jeu = document.getElementById('jeu');
                    while (jeu.firstChild) {
                        jeu.removeChild(jeu.lastChild);
                    }
                    jeu.appendChild(document.createElement('p').appendChild(document.createTextNode('La partie est terminée')));
                    clearInterval(timer);
                }
            }
        }, 1000);
    }
</script>
