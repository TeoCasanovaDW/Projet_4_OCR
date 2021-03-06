<!DOCTYPE html>
<html lang="fr">
<head> 
    <meta charset="utf-8" />
    <title> <?= $title ?> </title>
    <link <?= $style ?> />
    <link rel="stylesheet" type="text/css" href="public/css/styleTemplate.css">
    <script src="https://kit.fontawesome.com/30f5d53ec1.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tiny.cloud/1/xict65hzv8qup3ek8t0uilw1r3riiktuxpuzw11v3hy7o295/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <meta name="viewport" content="width=device-width, initial-scale = 1">
    <script>
        tinymce.init({
            selector: '.mytextarea'
        });
    </script>

</head>
    
<body>
    <nav>
        <ul>
            <li><a href="index.php?action=listPosts">Lecture</a></li>

            <li><a href="index.php?action=<?php
            if(isset($_SESSION['isLoggedIn'])){
                if($_SESSION['isLoggedIn']){
                    echo 'adminPage';
                }
                else{
                    echo 'connexionPage';
                }
            }
            else{
                echo 'connexionPage';
            }
                ?>"><?php
            if (isset($_SESSION['isLoggedIn'])) {
                if (!$_SESSION['isLoggedIn']) {
                    echo 'Connexion';
                }
                else{
                    echo 'Admin';
                }
            }
            else{
                echo 'Connexion';
            }
            ?></a></li>

            <li><a href="index.php?action=deconnexion" style="display:<?php
            if (isset($_SESSION['isLoggedIn'])) {
                if ($_SESSION['isLoggedIn']) {
                    echo "flex";
                }
                else{
                    echo "none";
                }
            }
            else{
                echo "none";
            }
            ?>">Déconnexion</a></li>
            <li><img src="public/images/JeanForteroche.png" alt="logo"></li>
        </ul>
    </nav>

    <header>
        <div>               
            <h1>Jean Forteroche</h1>
            <div id="flex">
                <i class="fas fa-quote-right"></i>
                <p>Billet simple pour l'Alaska</p>
                <i class="fas fa-quote-left"></i>
            </div>
        </div>
    </header>
    <?= $content ?>
</body>
</html>